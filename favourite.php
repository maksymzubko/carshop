<?php require_once "app/config.php";
if (!isset($_COOKIE['acc'])) {
    header("Location: login.php");
    exit;
}
?>

<head>
    <?php require_once "templates/head.php" ?>

    <title><?php echo $lang['faccp2'] ?></title>
</head>

<body class="body_hide">
    <?php require_once "templates/header.php" ?>

    <!--Navigator start-->
    <div class="breadcrumb">
        <div class="container pt-3 pb-3 w-75">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><?php echo $lang['home'] ?></a></li>
                        <li class="breadcrumb-item"><a href="account.php"><?php echo $lang['footerH3'] ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $lang['faccp2'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--Favourite start-->
    <section class="cars">
        <div class="cars_favourite">
            <div class="container">
                <div class="row d-flex flex-column align-items-center">
                    <div class="top">
                        <h2><?php echo $lang['faccp2'] ?></h2>
                    </div>
                    <div class="filter">
                        <h3><?php echo $lang['filter'] ?></h3>
                        <div class="filter-ico"></div>
                    </div>
                    <div class="col-lg-12 d-flex  main">
                    <div class="car-profile row w-100">
                    <?php include 'app/functions.php';
                        $result = favouriteList();
                        $numrows = $result->num_rows;
                        while ($row = $result->fetch_assoc()) {
                            $secrow = getCarByID($row['auto_ID']);
                            echo'
                        <div class="car-item col-lg-4 col-12" id="' . $secrow['a_ID'] . '">
                            <div class="container-car h-100">
                                <div class="car-image overflow-hidden justify-content-center">
                                    <div style="--background:url(../' . $secrow['img'] . ')" class="background-img"></div>
                                </div>
                                <div class="bottom">
                                    <div class="car-desc">
                                        <h2>' . $secrow['mark'] . '</h2>
                                        <h3>' . $secrow['m_model'] . '</h3>
                                    </div>
                                    <div class="buttons d-flex align-items-center justify-content-between">
                                        <a class="car_btn">' . $catalog['btn'] . '<span></span></a>
                                    <div class="fav isfav"></div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                        if ($numrows < 1) {
                            echo '<h2 class="empty list text-center">' . $account['emp'] . '</h2>';
                        }
                        ?>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--Favourite end-->
<section></section>

    <?php require_once "templates/footer.php" ?>
    <?php require_once "templates/scripts.php" ?>
</body>

</html>