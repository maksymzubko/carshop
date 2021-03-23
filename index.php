<?php require "app/config.php" ?>
<html>

<head>
    <?php require_once "templates/head.php" ?>
    <title><?php echo $lang['home'] ?></title>
</head>

<body >
<?php require_once 'mail.php' ?>
    <img id="myBtn" src="images/arrow.png" class="go__top" style="display: none;">
    <?php require_once "templates/header.php" ?>

    <section class="banner">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <img src="images/bnr-1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="images/bnr-2.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    <h2><?php echo $index['about3'] ?></h2>
                        <p><?php echo $index['about3text'] ?></p>
                      </div>
                </div>
                <div class="carousel-item">
                    <img src="images/bnr-3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h2><?php echo $index['about2'] ?></h2>
                        <p><?php echo $index['about2text'] ?></p>
                  </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?php echo $lang['Prv'] ?></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?php echo $lang['Nxt'] ?></span>
            </button>
            <a href="cars.php" class="btn index w- w-lg-50"><?php echo $lang['cars'] ?><span></span></a>
        </div>
    </section>
    <section class="display-none black pt-5 pb-5"></section>
    <?php require_once "templates/footer.php" ?>
    <?php  require_once "templates/scripts.php"?>
</body>

</html>