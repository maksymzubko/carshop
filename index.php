<?php require "app/config.php" ?>
<html>

<head>
    <?php require_once "templates/head.php" ?>
    <title><?php echo $lang['home'] ?></title>
</head>

<body >
<div class="contact-with-us close unselect">
        <div class="header">
            <div><img src="/images/arrow-down.png" width="35px" height="15px"></div>
            <p><?php echo $lang['cont']?></p>
        </div>
        <div class="contact-info d-flex align-items-center justify-content-start flex-column">
            <div class="d-flex align-items-center"><img style="margin-right:10px" src="/images/phone.png" width="25px" height="18px">
                <p><a href="callto:+380992443242">+380 99 244 3242</a></h5>
            </div>
            <div class="d-flex align-items-center"><img style="margin-right:10px" src="/images/mail.png" width="25px" height="18px">
                <p><a href="mailto:makzzubko66@email.com">makzzubko66@gmail.com</a></p>
            </div>
        </div>
    </div>
    <img id="myBtn" src="images/arrow.png" class="go__top" style="display: none;">
    <?php require_once "templates/header.php" ?>
    <section class="banner pt-5 pb-5" id="bannersection">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators hide">
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
                </div>
                <div class="carousel-item">
                    <img src="images/bnr-3.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev hide" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?php echo $lang['Prv'] ?></span>
            </button>
            <button class="carousel-control-next hide" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?php echo $lang['Nxt'] ?></span>
            </button>
        </div>
        <section class="pt-2 pb-2 text-white text-center index_desc">
        <?php echo "<h1><b>".$index['ah11']."</b>, <b>".$index['ah12']."</b>, <b>".$index['ah13']."</b> - ".$index['ah14']."!</h1>
        <h3>".$index['ah2']."</h3>";?>
        <a href="cars.php" class="btn mainbtn"><?php echo $index['buttonMainText'] ?><span></span></a>
    </section>
    </section>
    <section class="display-none black pt-5 pb-5"></section>
    <?php require_once "templates/footer.php" ?>
    <?php  require_once "templates/scripts.php"?>
</body>

</html>