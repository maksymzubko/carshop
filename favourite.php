<?php require_once "config.php" ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "head.php" ?>

    <title><?php echo $lang['faccp2'] ?></title>
</head>

<body class="body_hide">
    <?php require_once "header.php" ?>

    <!--Navigator start-->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumbs-main <?php echo $_SESSION['lang'] ?>">
                <ol class="breadcrumb">
                    <li><a href="index.php"><?php echo $lang['home'] ?></a></li>
                    <li><a href="account.php"><?php echo $lang['footerH3'] ?></a></li>
                    <li class="active"><?php echo $lang['faccp2'] ?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--Cars-product start-->
    <div class="cars-catalog-favourite">
        <div class="container">
            <div class="cars-top">
                <h1 class="head <?php echo $_SESSION['lang'] ?>"><?php echo $lang['faccp2'] ?></h1>
                <div class="col-sm-12 col-md-12 cars-left">
                    <div id="change1" class="sky-form-sort">
                        <h4>
                            <span>
                                <input type="radio" id="t3" name="radio" checked><img class="img-rounded" style="width:25px; height:25px" src="images/3x3-white.png">
                            </span>
                            <span>
                                <input type="radio" id="t1" name="radio"><img class="img-rounded" style="width:25px; height:25px" src="images/grid-white.png">
                            </span>
                        </h4>
                    </div>
                    <div class="product">
                        <div class="col-xs-12 col-sm-6 col-lg-4 col-md-4 product-left p-left" id="change" style="">
                            <div class="product-main">
                                <a href="#" class="mask"><img class="img-responsive zoom-img" style="width:100%" src="/images/car1.jpg" alt="" /></a>
                                <div class="product-bottom">
                                    <h3>Toyota</h3>
                                    <p>Camry</p>
                                </div>
                                <div class="product-buttons">
                                    <a href="" class="btn <?php echo $_SESSION['lang'] ?> effect-button" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $catalog['btn'] ?></span></a>
                                    <img src="/images/favourite-is.png" class="favourite nope" tabindex="0">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-4 col-md-4 product-left p-left" id="change" style="">
                            <div class="product-main">
                                <a href="#" class="mask"><img class="img-responsive zoom-img" style="width:100%" src="/images/car1.jpg" alt="" /></a>
                                <div class="product-bottom">
                                    <h3>Toyota</h3>
                                    <p>Camry</p>
                                </div>
                                <div class="product-buttons">
                                    <a href="" class="btn <?php echo $_SESSION['lang'] ?> effect-button" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $catalog['btn'] ?></span></a>
                                    <img class="favourite is" tabindex="2">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--Cars-product end-->

    <?php require_once "footer.php" ?>
</body>

</html>