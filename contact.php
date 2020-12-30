<?php require_once "config.php" ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "head.php" ?>

    <title><?php echo $lang['contact'] ?></title>
</head>

<body class="body_hide">

    <?php require_once "header.php" ?>

    <!--Navigator start-->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumbs-main <?php echo $_SESSION['lang'] ?>">
                <ol class="breadcrumb">
                    <li><a href="index.php"><?php echo $lang['home'] ?></a></li>
                    <li class="active"><?php echo $lang['contact'] ?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--Contact start-->
    <div class="contact">
        <div class="container">
            <div class="contact-top heading">
                <h2 style="border-style:solid; padding: 5px;">
                   <?php echo $contact['mText'] ?>
                </h2>
            </div>
            <div class="contact-text <?php echo $_SESSION['lang'] ?>">
                <div class="col-md-4 contact-right">
                    <div class="address <?php echo $_SESSION['lang'] ?>">
                        <h5><?php echo $contact['adr'] ?></h5>
                        <p>KhCar Shop,
                            <span><?php echo $lang['fstorep1'] ?>,</span>
                            <?php echo $lang['fstorep2'] ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 contact-right">
                    <div class="address <?php echo $_SESSION['lang'] ?>">
                        <h5> <?php echo $contact['tel'] ?></h5>
                        <p><span><a href="tel:+380 99 244 3242">+380 99 244 3242</a></span></p>
                    </div>
                </div>
                <div class="col-md-4 contact-right">
                    <div class="address <?php echo $_SESSION['lang'] ?>">
                        <h5> <?php echo $contact['mail'] ?></h5>
                        <p><span><a href="mailto:makzzubko66@email.com">makzzubko66@gmail.com</a></span></p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--contact-end-->

    <!--map-start-->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d82036.56626822472!2d36.2146213!3d50.018051899999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4127a13bfc844cad%3A0xeedd5737b86a407b!2zRk9SRCDQkNCy0YLQvtGC0YDQtdC50LTRltC90LMgLSDQodGF0ZbQtCB8INC-0YTRltGG0ZbQudC90LjQuSDQtNC40LvQtdGA!5e0!3m2!1sru!2sua!4v1604812163965!5m2!1sru!2sua"
            width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
    </div>
    <!--map-end-->

    <?php require_once "footer.php" ?>
</body>

</html>