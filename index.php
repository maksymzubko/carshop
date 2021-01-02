<?php require "app/config.php" ?>
<html>

<head>
   <?php require_once "templates/head.php" ?>
    <title><?php echo $lang['home'] ?></title>
</head>

<body class="body_hide">
    
<?php require_once "templates/header.php" ?>

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
                        <h4><?php echo $index['about1'] ?></h4>
                        <p><?php echo $index['about1text'] ?></p>
                    </figcaption>
                </figure>
            </div>
            <div class="col-sm-4 col-xs-4 col-md-4 about-our">
                <figure class="effect-mouse">
                    <img class="img-responsive" src="images/car1.jpg">
                    <figcaption>
                        <h2><?php echo $index['about2'] ?></h2>
                        <p><?php echo $index['about2text'] ?></p>
                    </figcaption>
                </figure>
            </div>
            <div class="col-sm-4 col-xs-4 col-md-4 about-our">
                <figure class="effect-mouse">
                    <img class="img-responsive" src="images/car-1.jpg">
                    <figcaption>
                        <h4><?php echo $index['about3'] ?></h4>
                        <p><?php echo $index['about3text'] ?></p>
                    </figcaption>
                </figure>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="block">
        <div class="container text-center">
            <a href="cars.php" class="btn <?php echo $_SESSION['lang'] ?> effect-button" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $index['buttonMainText'] ?></span></a>
        </div>
    </div>
    <br><br><br><br>
    <div class="clearfix"></div>
    <!--about-end-->

   <?php require_once "templates/footer.php" ?>

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