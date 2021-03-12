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
        <div class="container pt-3 pb-3 w-75">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><?php echo $lang['home'] ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $lang['toplabel'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--Account start-->
    <section class="account_page">
        <div class="container d-flex flex-column align-items-center">
            <h2 class="text-center w-75 top"><?php
                                $str =  json_decode($_COOKIE['acc'],true); echo $str['name']; ?></h2>
            <div class="account__content mb-5 text-center w-50 d-lg-flex justify-content-md-between">
                <div class="mt-2 col-12 col-lg-6">
                    <h2><strong> <?php echo $row['fav']?>  </strong></h2>
                    <p><?php echo $account['hd1'] ?></p>
                    <button class="btn" onclick="window.location.href='/favourite.php'"> <?php echo $lang['faccp2'] ?><span></span>
                    </button>
                </div>
                <div class="mt-2 col-12 col-lg-6">
                    <h2><strong> <?php echo $row['test'] ?></strong></h2>
                    <p><?php echo $account['hd2'] ?></p>
                    <button class="btn" onclick="window.location.href='/testdrives.php'"> <?php echo $account['b1'] ?><span></span>
                    </button>
                </div>
            </div>
            <div class="row align-items-center align-items-lg-start w-75 d-flex flex-column mt-5">
                <button class="btn mb-2 small" onclick="window.location.href='/cars.php'"> <?php echo $account['b2'] ?><span></span>
                </button>
                <button class="btn logout small" onclick="window.location.href='/cars.php'"> <?php echo $account['exit'] ?><span></span>
                </button>
            </div>
        </div>
    </section>
    <section></section>
    <!--Account end-->
    <?php require_once "templates/footer.php" ?>
    <?php require_once "templates/scripts.php" ?>
</body>

</html>