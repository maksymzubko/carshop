<?php require_once "app/config.php";
if (isset($_COOKIE['acc'])) {
    header("Location: cars.php");
    exit;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "templates/head.php" ?>

    <title><?php echo $register['register'] ?></title>
</head>

<body>
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
    <?php require_once 'templates/header.php' ?>

    <!--start-breadcrumbs-->
    <div class="breadcrumb">
    <div class="back align-items-center"> <img src="/images//arrow-back.png" height="15px" width="20px"> <a href="" onclick="history.back();return false;"><?php echo $lang['back'] ?></a> </div>
        <div class="container pt-3 pb-3 w-75">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><?php echo $lang['home'] ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $lang['footerH3'] ?></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $register['register'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->

    <!--register-starts-->

    <section class="register_section">
    <div class="container">
        <div class="top heading">
            <h2><?php echo $register['register'] ?></h2>
        </div>
        <form id="register" method="post">
            <div class="row">
                <div class="col-md-6">
                    <label for="inputEmail"><?php echo $register['email'] ?></label>
                    <input type="text" class="form-control" autocomplete="OFF" id="inputEmail" maxlength = 45 placeholder="<?php echo $register['email'] ?>" name="email" required="">
                    <div class="alert email hide"><p></p></div>
                    <div class="form-control-feedback"></div>
                </div>
                <div class="col-md-6">
                    <label for="inputPhone"><?php echo $register['phone'] ?></label>
                    <input type="tel" value="+380 " maxlength="16" autocomplete="OFF" class="form-control phone" id="phone" placeholder="<?php echo $register['phone'] ?>" name="phone" required="">
                    <div class="alert phone hide"><p></p></div>
                    <div class="form-control-feedback"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="inputName"><?php echo $register['name'] ?></label>
                    <input type="text" class="form-control" autocomplete="OFF" id="inputName" maxlength = 25 placeholder="<?php echo $register['name'] ?>" name="name" required="">
                    <div class="form-control-feedback"></div>
                </div>
                <div class="col-md-6">
                    <label><?php echo $register['pass'] ?></label>
                    <input type="password" class="form-control" autocomplete="OFF" id="inputPassword1" maxlength = 25 placeholder="<?php echo $register['pass'] ?>" name="password" required="">
                    <div class="form-control-feedback"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="inputSecondName"><?php echo $register['sur'] ?></label>
                    <input type="text" class="form-control" autocomplete="OFF" id="inputSecondName" maxlength = 25 placeholder="<?php echo $register['sur'] ?>" name="secondname">
                    <div class="form-control-feedback"></div>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4"><?php echo $register['apass'] ?></label>
                    <input type="password" class="form-control" autocomplete="OFF" id="inputPassword2"  maxlength = 25 placeholder="<?php echo $register['apass'] ?>" required="" name="password2">
                    <div class="alert pass hide"><p></p></div>
                    <div class="form-control-feedback"></div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" autocomplete="OFF" id="inlineradio1" name="radi1" value="Male" checked="">
                        <label class="form-check-label"><?php echo $register['m1'] ?></label>
                        <div class="form-control-feedback"></div>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" autocomplete="OFF" id="inlineradio2" name="radi1" value="Female">
                        <label class="form-check-label"><?php echo $register['m2'] ?></label>
                        <div class="form-control-feedback"></div>
                    </div>
                </div>
            </div>          
            <div class="button mt-4 text-center">
                <button id="register" type="submit" name="register" class="btn" ><?php echo $register['reg'] ?><span></span></button>
            </div>
            <span class="psw d-flex mt-3 justify-content-lg-end justify-content-center"><a href="login.php"><?php echo $register['log'] ?></a></span>
        </form>
    </div> 
</section>
<!--register-end-->

    <?php require_once 'templates/footer.php' ?>
    <?php require_once 'templates/scripts.php' ?>
</body>

</html>