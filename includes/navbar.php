<?php
include ('config/dbcon.php');
include ('userfunction.php');
?>

    <!--boostrap cdn  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="../main.css">


    <!--font awesome cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <div class="top-header col-12 d-flex flex-row ">

            <div class="container d-flex flex-row align-content-between justify-content-around">
               <div class="contact-items col-6 d-flex flex-row align-content-center justify-content-between">
                   <div class="contact-no d-flex">
                        <i class="fa-solid fa-phone"></i>
                        <a href ="#">+11 111 111 1111</a>
                   </div>

                   <div class="contact-email d-flex">
                        <i class="fa-solid fa-envelope"></i>
                        <a href="#">lorem@email.com</a>
                   </div>

                   <div class="contact-address d-flex">
                        <i class="fa-solid fa-location-dot"></i>
                         <a href="#">Lorem ipsum dolor sit.</a>
                   </div>

               </div>

                <?php
                if (isset($_SESSION['user']))
                {
                    ?>
                    <div class="logout-session col-4 d-flex flex-row align-content-between justify-content-end mt-2 text-white text-uppercase g-4 ">
                       <?=$_SESSION['user']['name'] ?>
                        <a href="logout.php">Logout</a>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="user-defaults col-6">

                        <div class="loginEl d-flex flex-row align-content-center justify-content-end">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <a href="register.php">LOGIN / REGISTER</a>
                        </div>

                    </div>
                <?php
                }
                ?>

            </div>
        </div>
<!---navbar elements --->
        <div class="header">
            <div class="container col-12  d-flex flex-row align-item-center justify-content-evenly">

               <!--Search Bar-->

                <nav class="navbar navbar-expand-lg navbar-light mt-2">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-sharp fa-solid fa-bars"></i>
                                        Browse Categories

                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="home.php">Home</a></li>
                                        <?php
                                        $categories = getAll("categories");
                                        if (mysqli_num_rows($categories)>0){
                                            foreach ($categories as $item){
                                                ?>
                                                <li><a class="dropdown-item "href="#"><?=$item['name'];?></a></li>

                                                <?php
                                            }
                                        }
                                        else{
                                            echo "No Category Available";
                                        }
                                        ?>

                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>


                <div class="logo col-6 align-item-center justify-content-center text-center mt-3">
                    <h1>Smart <span>Asia</span></h1>

                </div>


                <!--Search Bar-->

                <div class="whishlsit d-flex flex-row col-2 align-content-center justify-content-evenly mt-2 text-white">
                    <div class="cart d-flex">
                        <a href="#"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>
                        <a href="#"><i class="fa-regular fa-heart"></i></a>
                        <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
                        <a href="login.php"><i class="fa-regular fa-user"></i></a>
                        <a href="#"><i class="fa-sharp fa-solid fa-rupee-sign"></i></a>
                    </div>
                </div>

            </div>
        </div>

    </header>




