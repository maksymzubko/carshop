<?php require_once "app/config.php" ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "templates/head.php" ?>

    <title><?php echo $lang['contact'] ?></title>
</head>

<body>
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

    <!--Navigator start-->
    <div class="breadcrumb">
    <div class="back d-flex align-items-center"> <img src="/images//arrow-back.png" height="15px" width="20px"> <a href="" onclick="history.back();return false;"><?php echo $lang['back'] ?></a> </div>
        <div class="container pt-3 pb-3 w-75">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><?php echo $lang['home'] ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $lang['contact'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--Contact start-->

    <section>
        <div class="contact-us">
            <div class="container">
                <div class="banner w-100">
                    <h1 class="text-center text-white"> <?php echo $contact['mText'] ?></h1>
                </div>
                <div class="information">
                    <div class="row text-center">
                        <div class="col-12 col-lg-4">
                            <h2><?php echo $contact['adr'] ?></h2>
                            <p>KhCar Shop,
                                <?php echo $lang['fstorep1'] ?>,
                                <?php echo $lang['fstorep2'] ?>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4">
                            <h2> <?php echo $contact['tel'] ?></h2>
                            <p>
                                <a href="tel:+380 99 244 3242">+380 99 244 3242</a>
                            </p>
                        </div>
                        <div class="col-12 col-lg-4 mail">
                            <h2><?php echo $contact['mail'] ?></h2>
                            <p>
                                <a href="mailto:makzzubko66@email.com">makzzubko66@gmail.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d381.08366221577836!2d36.21455010550945!3d50.01856938650885!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4127a13d692e0ae7%3A0xf30e0ec6d9867d6a!2zSFlVTkRBSSDQkNCy0YLQvtGC0YDQtdC50LTRltC90LMgLSDQpdCw0YDQutGW0LIgfCDQvtGE0ZbRhtGW0LnQvdC40Lkg0LTQuNC70LXRgA!5e0!3m2!1sru!2sua!4v1615413086477!5m2!1sru!2sua" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
    <!--contact-end-->

    <?php require_once "templates/footer.php" ?>
    <?php require_once "templates/scripts.php" ?>
</body>

</html>