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
<div class="contact-with-us close unselect">
        <div class="header">
            <div><img src="/images/arrow-down.png" width="35px" height="15px"></div>
            <p><?php echo $lang['cont']?></p>
        </div>
        <div class="contact-info d-flex align-items-center justify-content-start flex-column">
            <div class="d-flex align-items-center"><img style="margin-right:10px" src="/images/phone.png" width="25px" height="18px">
                <p><a href="callto:+380992443242">+380 99 244 3242</a></h5>
            </div>
            <div class="d-flex align-items-center"><img style="margin-right:10px" src="/images/mail.png" width="25px" height="18px">
                <p><a href="mailto:makzzubko66@email.com">makzzubko66@gmail.com</a></p>
            </div>
        </div>
    </div>
<img id="myBtn" src="images/arrow.png" class="go__top" style="display: none;">
    <?php require_once "templates/header.php" ?>

    <!--Navigator start-->
    <div class="breadcrumb">
    <div class="back d-flex align-items-center"> <img src="/images//arrow-back.png" height="15px" width="20px"> <a href="" onclick="history.back();return false;"><?php echo $lang['back'] ?></a> </div>
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
                            <th><?php echo $testdrive['c32'] ?></th>
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