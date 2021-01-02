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

    <title><?php echo $lang['toplabel'] ?></title>
</head>

<body class="body_hide">
    <?php require_once "templates/header.php" ?>

    <?php include 'app/functions.php';
    $row = getAboutUser();
    ?>
    <!--Navigator start-->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumbs-main <?php echo $_SESSION['lang'] ?>">
                <ol class="breadcrumb">
                    <li><a href="index.php"><?php echo $lang['home'] ?></a></li>
                    <li class="active"><?php echo $lang['toplabel'] ?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--Account start-->
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 text-center account <?php echo $_SESSION['lang'] ?>">
                <div class="profile">
                    <div class="col-sm-12">
                        <div class="col-xs-12 col-sm-8 col-md-12">
                            <h2><?php
                                    $name = $row['u_fname'] . ' ' . $row['u_name'];
                                    echo $name; ?></h2>
                            <p><strong><?php echo $account['role'] ?>: </strong>
                            <span class="tags c"><?php echo $account['r1'] ?></span>
                            <?php                       
                            if(IsUserAdmin())
                            echo '
                            <button class="link""><span class="tags c">'. $account['r2'] .'</span></button>';
                            else
                            echo '<span class="tags d">'. $account['r2'] .'</span>';
                            ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-12 divider text-center">
                        <div class="col-xs-12 col-sm-4 emphasis ">
                            <h2><strong> 23 </strong></h2>
                            <p><small><?php echo $account['hd1'] ?></small></p>
                            <button class="btn <?php echo $_SESSION['lang'] ?> btn-block effect-button2" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>" onclick="window.location.href='/favourite.php'"> <span><?php echo $lang['faccp2'] ?></span>
                            </button>
                        </div>
                        <div class="col-xs-12 col-sm-4 emphasis">
                            <h2><strong>12</strong></h2>
                            <p><small><?php echo $account['hd2'] ?></small></p>
                            <button class="btn <?php echo $_SESSION['lang'] ?> btn-block effect-button2" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>" onclick="window.location.href='/testdrives.php'"> <span> <?php echo $account['b1'] ?></span>
                            </button>
                        </div>
                        <div class="col-xs-12 col-sm-4 emphasis">
                            <h2><strong>245</strong></h2>
                            <p><small><?php echo $account['hd3'] ?></small></p>
                            <button class="btn <?php echo $_SESSION['lang'] ?> btn-block effect-button2" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>" onclick="window.location.href='/cars.php'"> <span><?php echo $account['b2'] ?></span>
                            </button>
                        </div>
                    </div>
                </div>
                <form id="logout" method="post">
                <input name=logout class="hide" value="logout">
                <button type="submit" name=logout class="log"><span class="psw"><i class="fa fa-times-circle"></i><a id="signout" name=logout><?php echo '   '. $account['exit'] ?></a></span></button>
                </form>
            </div>
        </div>
    </div>
    <!--Account end-->
    <?php require_once "templates/footer.php" ?>
</body>

</html>