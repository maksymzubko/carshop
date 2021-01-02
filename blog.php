<?php require_once "app/config.php" ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "templates/head.php" ?>

    <title><?php echo $lang['blog'] ?></title>
</head>

<body class="body_hide">

    <?php require_once "templates/header.php" ?>

    <!--Navigator start-->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumbs-main <?php echo $_SESSION['lang'] ?>">
                <ol class="breadcrumb">
                    <li><a href="index.php"><?php echo $lang['home'] ?></a></li>
                    <li class="active"><?php echo $lang['blog'] ?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--headtext-start-->
    <div class="text-center" style="height:400px">
        <br><br><br><br><br><br>
        <div class="container">
            <div>
                <h2><b><?php echo $blog['temp'] ?></b></h2>
            </div>
        </div>
    </div>
    <!--headtext-end-->

    <?php require_once "templates/footer.php" ?>
</body>

</html>