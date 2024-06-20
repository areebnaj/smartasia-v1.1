
<?php
session_start();
include('includes/header.php');
include('functions/check-remember-me.php');
?>

<?php if
(isset($_SESSION['message'])) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">

        <strong>Hello <?=$_SESSION['user']['name'] ?> </strong> <?=$_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['message']);
}
?>
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="1500">
            <video class="img-fluid d-block w-100" autoplay loop muted>
                <source src="myimages/15promax.mp4" type="video/mp4">
            </video>
        </div>
        <div class="carousel-item" data-bs-interval="1000">
            <video class="img-fluid d-block w-100" autoplay loop muted>
                <source src="myimages/ipadpro.mp4" type="video/mp4">
            </video>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>







<?php
include ('displayCategories.php');
include('includes/footer.php');
?>