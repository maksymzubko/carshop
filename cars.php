<?php require_once "config.php" ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "head.php" ?>

    <title><?php echo $catalog['catalog'] ?></title>
</head>

<body class="body_hide">
    <?php require_once "header.php" ?>

    <!--Navigator start-->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumbs-main <?php echo $_SESSION['lang'] ?>">
                <ol class="breadcrumb">
                    <li><a href="index.php"><?php echo $lang['home'] ?></a></li>
                    <li class="active"><?php echo $catalog['catalog'] ?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--Cars-product start-->
    <div class="cars-catalog">
        <div class="container">
            <div class="cars-top">
                <div class="col-md-3 car-right">
                    <div class="w_sidebar">
                        <ul class="memenu <?php echo $_SESSION['lang'] ?> filters skyblue">
                            <li>
                                <section class="sky-form">
                                    <h4><?php echo $catalog['c1'] ?></h4>
                                    <div class="row1 scroll-pane">
                                        <div class="col col-4">
                                            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i><?php echo $catalog['c2'] ?></label>
                                            <label class="checkbox"><input type="checkbox"
                                                    name="checkbox"><i></i><?php echo $catalog['c3'] ?></label>
                                            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i><?php echo $catalog['c4'] ?></label>
                                        </div>
                                    </div>
                                </section>
                                <section class="sky-form">
                                    <h4><?php echo $catalog['f1'] ?></h4>
                                    <div class="row1 scroll-pane">
                                        <div class="col col-4">
                                            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i><?php echo $catalog['f2'] ?></label>
                                            <label class="checkbox"><input type="checkbox"
                                                    name="checkbox"><i></i>Toyota</label>
                                            <label class="checkbox"><input type="checkbox"
                                                    name="checkbox"><i></i>NISSAN</label>
                                            <label class="checkbox"><input type="checkbox"
                                                    name="checkbox"><i></i>Toyota</label>
                                            <label class="checkbox"><input type="checkbox"
                                                    name="checkbox"><i></i>NISSAN</label>
                                        </div>
                                    </div>
                                </section>
                                <section class="sky-form">
                                    <h4><?php echo $catalog['col'] ?></h4>
                                    <ul class="w_nav2">
                                        <li><a class="color1" href="#"></a></li>
                                        <li><a class="color2" href="#"></a></li>
                                        <li><a class="color3" href="#"></a></li>
                                    </ul>
                                </section>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-9 cars-left">
                    <div id="change1" class="sky-form-sort">
                            <h4>
                                <span>
                                    <input type="radio" id="t1" name="radio" checked><img class="img-rounded"
                                        style="width:25px; height:25px" src="images/grid-white.png">
                                </span>
                                <span>
                                    <input type="radio" id="t2" name="radio"><img class="img-rounded"
                                        style="width:25px; height:25px" src="images/list-white.png">
                                    </span>
                            </h4>
                    </div>
                    <div class="product">
                        <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6 product-left p-left" id="change" style="">
                            <div class="product-main">
                                <a href="#" class="mask"><img class="img-responsive zoom-img" style="width:100%"
                                        src="/images/car1.jpg" alt="" /></a>
                                <div class="product-bottom">
                                    <h3>Toyota</h3>
                                    <p>Camry</p>
                                </div>
                                <div class="product-buttons">
                                    <a href="cars.html" class="btn <?php echo $_SESSION['lang'] ?> effect-button" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $catalog['btn'] ?></span></a>
                                        <img src="/images/favourite-is.png" class="favourite nope" tabindex="0">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6 product-left p-left" id="change" style="">
                            <div class="product-main">
                                <a href="#" class="mask"><img class="img-responsive zoom-img" style="width:100%"
                                        src="/images/car1.jpg" alt="" /></a>
                                <div class="product-bottom">
                                    <h3>Toyota</h3>
                                    <p>Camry</p>
                                </div>
                                <div class="product-buttons">
                                    <a href="cars.html" class="btn <?php echo $_SESSION['lang'] ?> effect-button" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $catalog['btn'] ?></span></a>
                                    <img class="favourite is"  tabindex="2">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6 product-left p-left" id="change" style="">
                            <div class="product-main">
                                <a href="#" class="mask"><img class="img-responsive zoom-img" style="width:100%"
                                        src="/images/car1.jpg" alt="" /></a>
                                <div class="product-bottom">
                                    <h3>Toyota</h3>
                                    <p>Camry</p>
                                </div>
                                <div class="product-buttons">
                                    <a href="cars.html" class="btn <?php echo $_SESSION['lang'] ?> effect-button" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $catalog['btn'] ?></span></a>
                                    <img class="favourite is">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6 product-left p-left" id="change" style="">
                            <div class="product-main">
                                <a href="#" class="mask"><img class="img-responsive zoom-img" style="width:100%"
                                        src="/images/car1.jpg" alt="" /></a>
                                <div class="product-bottom">
                                    <h3>Ddd</h3>
                                    <p>Gg</p>
                                </div>
                                <div class="product-buttons">
                                    <a href="cars.html" class="btn <?php echo $_SESSION['lang'] ?> effect-button" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $catalog['btn'] ?></span></a>
                                    <img class="favourite is">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6 product-left p-left" id="change" style="">
                            <div class="product-main">
                                <a href="#" class="mask"><img class="img-responsive zoom-img" style="width:100%"
                                        src="/images/car2.jpg" alt="" /></a>
                                <div class="product-bottom">
                                    <h3>Ddd</h3>
                                    <p>Gg</p>
                                </div>
                                <div class="product-buttons">
                                    <a href="cars.html" class="btn <?php echo $_SESSION['lang'] ?> effect-button" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $catalog['btn'] ?></span></a>
                                    <img class="favourite is">
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