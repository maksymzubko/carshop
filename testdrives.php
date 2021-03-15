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

    <title><?php echo $testdrive['test'] ?></title>
</head>

<body class="body_hide">
<img id="myBtn" src="images/arrow.png" class="go__top" style="display: none;">
    <?php require_once "templates/header.php" ?>

    <!--Navigator start-->
    <div class="breadcrumb">
        <div class="container pt-3 pb-3 w-75">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><?php echo $lang['home'] ?></a></li>
                        <li class="breadcrumb-item"><a href="account.php"><?php echo $lang['footerH3'] ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $testdrive['test'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--Testdrives start-->
    <section>
        <div class="testdrives">
            <div class="container">
                <div class="top">
                    <h2><?php echo $account['hd2'] ?></h2>
                </div>
                <div class="table-div">
                    <table id="data" class="table table-striped table-bordered w-100">
                        <thead class="table-dark">
                            <th><?php echo $testdrive['c1'] ?></th>
                            <th><?php echo $testdrive['c2'] ?></th>
                            <th><?php echo $testdrive['c3'] ?></th>
                            <th><?php echo $testdrive['c4'] ?></th>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                    </table>
                    <h1 class="error" style="text-align:center"><?php $lang['ndata']?></h1>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-5 pt-5"></section>
    <section class="pb-5 pt-5"></section>
    <!--Testdrives end-->

    <?php require_once "templates/footer.php" ?>
    <?php require_once "templates/scripts.php" ?>
</body>

</html>