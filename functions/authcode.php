<?php
session_start();
include('../config/dbcon.php');

if (isset($_POST['register-btn'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $sql = "SELECT email FROM `users` WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['message'] = "Email Already Exists";
        header('Location: ../register.php');
        exit();
    } else {
        if ($password == $cpassword) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO `users` (name, phone, email, password) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssss", $name, $phone, $email, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Registered Successfully";
                header('Location: ../login.php');
                exit();
            } else {
                $_SESSION['message'] = "Something Went Wrong";
                header('Location: ../register.php');
                exit();
            }
        } else {
            $_SESSION['message'] = "Passwords do not Match";
            header('Location: ../register.php');
            exit();
        }
    }
} elseif (isset($_POST['login-btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $remember_me = isset($_POST['remember_me']);

    // First, check in the users table
    $sql = "SELECT * FROM `users` WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userdata = $result->fetch_assoc();

        if (password_verify($password, $userdata['password'])) {
            $_SESSION['user'] = [
                'name' => $userdata['name'],
                'email' => $userdata['email']
            ];

            if ($remember_me) {
                $token = bin2hex(random_bytes(16));
                $expiry = time() + (86400 * 30); // 30 days

                setcookie('remember_me_user', $token, $expiry, "/", "", false, true);

                $sql = "UPDATE `users` SET remember_token = ? WHERE email = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ss", $token, $email);
                $stmt->execute();
            }

            $_SESSION['message'] = "Logged in Successfully";
            header('Location: ../home.php');
            exit();
        } else {
            $_SESSION['message'] = "Invalid Credentials";
            header('Location: ../login.php');
            exit();
        }
    } else {
        // If not found in users, check in the admin table
        $sql = "SELECT * FROM `admin` WHERE email = '$email' AND password = '$password'";

        $admin_results = mysqli_query($con, $sql);

        if (mysqli_num_rows($admin_results) > 0){
            $_SESSION['admin'] = true;

            $adminUser = mysqli_fetch_array($admin_results);
            $name = $adminUser['name'];
            $email = $adminUser['email'];
            $password = $adminUser['password'];
            $role = $adminUser['role'];

            $_SESSION ['admin'] = [
                'name' => $name,
                'email' => $email,
                'password'=> $password,
                'role' => $role
            ];
            $_SESSION['message'] = "Welcome Admin";
            header('location: ../admin/index.php');
        }else{
            $_SESSION['message'] = "Invalid Credential";
            header('location: ../login.php');

        }


    }
}
?>
