<?php require "config.php" ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Import css -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/memenu.css">

    <!-- Import javascript -->
    <script type="text/javascript" src="javascript/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="javascript/otherFunctions.js"></script>
    <script type="text/javascript" src="javascript/memenu.js"></script>
    <script type="text/javascript" src="javascript/all.js"></script>
    <script>
        $(document).ready(function() {
            $(".memenu").memenu();
        });
    </script>

    <title>Main "Prestigious Cars"</title>
</head>

<body class="body_hide">
    <!--header-start-->
    <div class="top-header">
        <div class="container">
            <div class="top-header-main">
                <div class="top-header-left">
                    <div class="dropdown <?php echo $_SESSION['lang'] ?>">
                        <button class="dropbtn"><?php echo $lang['language'] ?>
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                            <label class="lan" id="en">English</label>
                            <label class="lan" id="ru">Русский</label>
                            <label class="lan" id="ukr">Українська</label>
                        </div>
                    </div>
                </div>
                <div class="top-header-right">
                    <div class="account-box <?php echo $_SESSION['lang'] ?>">
                        <label><?php echo $lang['toplabel'] ?></label>
                        <a href="account.html">
                            <img src="images/account.png" alt="" style="width:30px;height:30px" />
                        </a>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    </div>
    <div class="logo">
        <a href="index.html">
            <h1><b>Prestigious cars</b></h1>
        </a>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header">
                <div class="col-md-12">
                    <div class="top-nav">
                        <ul class="memenu <?php echo $_SESSION['lang'] ?> main skyblue">
                            <li class="grid active" id="first">
                                <a href="index.html"><?php echo $lang['home'] ?></a>
                            </li>
                            <li class="grid" id="second"><a href="cars.html"><?php echo $lang['cars'] ?></a>
                            </li>
                            <li class="grid" id="third"><a href="blog.html"><?php echo $lang['blog'] ?></a>
                            </li>
                            <li class="grid" id="fourh"><a href="contact.html"><?php echo $lang['contact'] ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!--header-end-->

    <!--banner-start-->
    <div class="bnr" id="home">
        <div id="top" class="callbacks_container">
            <ul class="rslides" id="slider4">
                <li>
                    <img src="images/bnr-1.jpg" alt="" />
                </li>
                <li>
                    <img src="images/bnr-2.jpg" alt="" />
                </li>
                <li>
                    <img src="images/bnr-3.jpg" alt="" />
                </li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
    <!--banner-end-->

    <!--about-start-->
    <div class="about">
        <div class="container">
            <div class="col-sm-4 col-xs-4 col-md-4 about-our">
                <figure class="effect-mouse">
                    <img class="img-responsive" src="images/car2.jpg">
                    <figcaption>
                        <h4><?php echo $lang['about1'] ?></h4>
                        <p><?php echo $lang['about1text'] ?></p>
                    </figcaption>
                </figure>
            </div>
            <div class="col-sm-4 col-xs-4 col-md-4 about-our">
                <figure class="effect-mouse">
                    <img class="img-responsive" src="images/car1.jpg">
                    <figcaption>
                        <h2><?php echo $lang['about2'] ?></h2>
                        <p><?php echo $lang['about2text'] ?></p>
                    </figcaption>
                </figure>
            </div>
            <div class="col-sm-4 col-xs-4 col-md-4 about-our">
                <figure class="effect-mouse">
                    <img class="img-responsive" src="images/car-1.jpg">
                    <figcaption>
                        <h4><?php echo $lang['about3'] ?></h4>
                        <p><?php echo $lang['about3text'] ?></p>
                    </figcaption>
                </figure>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="block">
        <div class="container text-center">
            <a href="cars.html" class="btn <?php echo $_SESSION['lang'] ?> effect-button" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $lang['buttonMainText'] ?></span></a>
        </div>
    </div>
    <br><br><br><br>
    <div class="clearfix"></div>
    <!--about-end-->

    <!--information-start-->
    <div class="information <?php echo $_SESSION['lang'] ?>">
        <div class="container">
            <div class="infor-top">
                <div class="col-xxs-12 col-xs-3 col-md-3 infor-left">
                    <h3 class="<?php echo $_SESSION['lang'] ?>"><?php echo $lang['footerH1'] ?></h3>
                    <ul>
                        <li><a href="https://www.facebook.com/profile.php?id=100007769135894"><span class="fb"></span>
                                <h6>Facebook</h6>
                            </a></li>
                        <li><a href="https://twitter.com/Maksimilan0"><span class="twit"></span>
                                <h6>Twitter</h6>
                            </a></li>
                        <li><a href="https://www.instagram.com/piaceofrice"><span class="google"></span>
                                <h6>Instagram</h6>
                            </a></li>
                    </ul>
                </div>
                <div class="col-xxs-12 col-xs-3 col-md-3 infor-left">
                    <h3 class="<?php echo $_SESSION['lang'] ?>"><?php echo $lang['footerH2'] ?></h3>
                    <ul>
                        <li><a href="cars.html">
                                <p><?php echo $lang['finfp1'] ?></p>
                            </a></li>
                        <li><a href="contact.html">
                                <p><?php echo $lang['finfp2'] ?></p>
                            </a></li>
                    </ul>
                </div>
                <div class="col-xxs-12 col-xs-3  col-md-3 infor-left">
                    <h3 class="<?php echo $_SESSION['lang'] ?>"><?php echo $lang['footerH3'] ?></h3>
                    <ul>
                        <li><a href="account.html">
                                <p><?php echo $lang['faccp1'] ?></p>
                            </a></li>
                        <li><a href="#">
                                <p><?php echo $lang['faccp2'] ?></p>
                            </a></li>
                    </ul>
                </div>
                <div class="col-xxs-12 col-xs-3 col-md-3 infor-left">
                    <h3 class="<?php echo $_SESSION['lang'] ?>"><?php echo $lang['footerH4'] ?></h3>
                    <h4>KhCar Shop,
                        <span><?php echo $lang['fstorep1'] ?>,</span>
                        <?php echo $lang['fstorep2'] ?>.
                    </h4>
                    <h5><a href="callto:+380992443242">+380 99 244 3242</a></h5>
                    <p><a href="mailto:makzzubko66@email.com">makzzubko66@gmail.com</a></p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--information-end-->

    <!--footer-starts-->
    <div class="footer <?php echo $_SESSION['lang'] ?>">
        <div class="container">
            <div class="footer-top text-center">
                <p>© 2020 Prestigious cars. <?php echo $lang['footer'] ?></p>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    </div>
    <!--footer-end-->

    <!--Add some important scripts-->
    <script src="javascript/responsiveslides.min.js"></script>
    <script>
        $(function() {
            $("#slider4").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 500,
                namespace: "callbacks",
                before: function() {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function() {
                    $('.events').append("<li>after event fired.</li>");
                }
            });
        });
    </script>
    <!--Scripts end-->
</body>

</html>