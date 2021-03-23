<?php require_once "app/config.php";
if (isset($_COOKIE['acc'])) {
    header("Location: account.php");
    exit;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "templates/head.php" ?>

    <title><?php echo $login['login'] ?></title>
</head>

<body>
<div class="contact-with-us close unselect">
        <div class="header">
            <div><img src="/images/arrow-down.png" width="35px" height="15px"></div>
            <p>Связаться с нами</p>
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
    <?php require_once 'templates/header.php' ?>

    <!--start-breadcrumbs-->
    <div class="breadcrumb">
    <div class="back d-flex align-items-center"> <img src="/images//arrow-back.png" height="15px" width="20px"> <a href="" onclick="history.back();return false;"><?php echo $lang['back'] ?></a> </div>
        <div class="container pt-3 pb-3 w-75">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><?php echo $lang['home'] ?></a></li>
                        <li class="breadcrumb-item" aria-current="page"><a
                                href="account.php"><?php echo $lang['footerH3'] ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $login['login'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->

    <!--login-starts-->
    <section class="login_section pb-md-5 pb-lg-5">
        <div class="container">
            <h2 class="text-center top"><?php echo $login['login'] ?></h2>
            <form id="login" method="post">
                <div class="container d-flex flex-column">
                    <div class="col-md-8 col-10 align-self-center">
                        <label for="inputEmail"><?php echo $register['email'] ?></label>
                        <input type="email" class="form-control" autocomplete="OFF" id="inputEmail"
                            placeholder="<?php echo $register['email'] ?>" name="email" maxlength="30" required>
                        <div class="form-control-feedback"></div>
                        <label for="inputPassword"><?php echo $register['pass'] ?></label>
                        <input type="password" maxlength="30" placeholder="<?php echo $register['pass'] ?>"
                            autocomplete="OFF" class="form-control pass" id="pass" name="pass" required>
                        <div class="form-control-feedback"></div>
                        <input type="checkbox" name="remember"> <?php echo $login['rem'] ?></label>
                    </div>
                    <div class="button mt-4 d-flex justify-content-center">
                        <button id="login" type="submit" name="register"
                            class="btn"><?php echo $login['log'] ?><span></span></button>
                    </div>
                    <span class="psw d-flex mt-3 justify-content-lg-end justify-content-center"><a
                            href="register.php"><?php echo $login['acc'] ?></a></span>
                </div>
            </form>
        </div>
    </section>
    <section></section>
    <!--login-end-->

    <?php require_once 'templates/footer.php' ?>
    <?php require_once 'templates/scripts.php' ?>
</body>

</html>