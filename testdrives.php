<?php require_once "app/config.php";
if (!isset($_COOKIE['acc'])) {
    header("Location: login.php");
    exit;
}
?>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "head.php" ?>

    <title><?php echo $testdrive['test'] ?></title>
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
                    <li class="active"><?php echo $testdrive['test'] ?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--Testdrives start-->
    <div class="container testdrives">
        <h1 class="head"><?php echo $testdrive['test'] ?></h1>
        <div class="row content testdrive">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="data" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th><?php echo $testdrive['c1'] ?></th>
                                        <th><?php echo $testdrive['c2'] ?></th>
                                        <th><?php echo $testdrive['c3'] ?></th>
                                        <th><?php echo $testdrive['c4'] ?></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!--Testdrives end-->

        <?php require_once "footer.php" ?>
</body>

</html>