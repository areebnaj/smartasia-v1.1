<?php
include('config/dbcon.php');
global $con;
if (isset($_COOKIE['remember_me_user'])) {
    $token = $_COOKIE['remember_me_user'];

    $sql = "SELECT * FROM `users` WHERE remember_token = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userdata = $result->fetch_assoc();
        $_SESSION['user'] = [
            'name' => $userdata['name'],
            'email' => $userdata['email']
        ];

//        $_SESSION['message'] = "Logged in via Remember Me";
//        header('Location: ../home.php');
//        exit();
    } else {
        setcookie('remember_me_user', '', time() - 3600, "/");
    }
} elseif (isset($_COOKIE['remember_me_admin'])) {
    $token = $_COOKIE['remember_me_admin'];

    $sql = "SELECT * FROM `admin` WHERE remember_token = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $adminUser = $result->fetch_assoc();
        $_SESSION['admin'] = [
            'name' => $adminUser['name'],
            'email' => $adminUser['email'],
            'role' => $adminUser['role']
        ];

        $_SESSION['message'] = "Logged in via Remember Me";
        header('Location: ../admin/index.php');
        exit();
    } else {
        setcookie('remember_me_admin', '', time() - 3600, "/");
    }
}
?>
