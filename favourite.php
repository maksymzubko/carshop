<?php require_once "app/config.php";
if (!isset($_COOKIE['acc'])) {
    header("Location: login.php");
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "templates/head.php" ?>

    <title><?php echo $lang['faccp2'] ?></title>
</head>

<body class="body_hide">
    <?php require_once "templates/header.php" ?>

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

    <!--Favourite start-->
    <div class="cars-catalog-favourite <?php echo $_SESSION['lang'] ?>">
        <div class="container">
            <div class="cars-top">
                <h1 class="head"><?php echo $lang['faccp2'] ?></h1>
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
                        <?php include 'app/functions.php';
                        $result = favouriteList();
                        $numrows = $result->num_rows;
                        while ($row = $result->fetch_assoc()) {
                            $secrow = getCarByID($row['auto_ID']);
                            echo '<div class="col-xs-12 col-sm-6 col-lg-4 col-md-4 product-left p-left" id="' . $secrow['a_ID'] . '">
                            <div class="product-main">
                                <a href="#" class="mask"><img class="img-responsive zoom-img" style="width:100%" src=" ' . $secrow['img'] . ' " alt="" /></a>
                                <div class="product-bottom">
                                    <h3>' . $secrow['mark'] . '</h3>
                                    <p>' . $secrow['m_model'] . '</p>
                                </div>
                                <div class="product-buttons">
                                    <a href="" class="btn ' . $_SESSION['lang'] . ' effect-button" data-sm-link-text=" ' . $lang['buttonHideText'] . '"><span> ' . $catalog['btn'] . '</span></a>
                                    <div class="photo" data-title="' . $catalog['alt'] . '">  
                                    <img src="/images/favourite-is.png" class="favourite is" tabindex="' . $secrow['a_ID'] . '">
                                </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>';
                        }
                        if ($numrows < 1) {
                            echo '<h2 class="empty list text-center">' . $account['emp'] . '</h2>';
                            echo "<script>$('#change1').children().css('display','none');</script>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    </div>
    <!--Favourite end-->

    <?php require_once "templates/footer.php" ?>
</body>

</html>