<?php require_once "app/config.php" ;
if(isset($_COOKIE['acc']))
{
    header("Location: account.php"); exit;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "templates/head.php" ?>

    <title><?php echo $register['register'] ?></title>
</head>

<body class="body_hide">

    <?php require_once 'templates/header.php' ?>

    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main <?php echo $_SESSION['lang'] ?>">
                <ol class="breadcrumb">
                    <li><a href="index.php"><?php echo $lang['home'] ?></a></li>
                    <li><a href="account.php"><?php echo $lang['footerH3'] ?></a></li>
                    <li class="active"><?php echo $register['register'] ?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->

    <!--register-starts-->
    <div class="register <?php echo $_SESSION['lang'] ?>">
        <div class="container">
            <div class="register-top heading">
                <h2><?php echo $register['register'] ?></h2>
            </div>
            <form id="register" method="post" oninput='password2.setCustomValidity(password.value != password2.value ? "Passwords do not match." : "")'>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail"><?php echo $register['email'] ?></label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="<?php echo $register['email'] ?>"  name="email" required>
                        <div class="form-control-feedback"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPhone"><?php echo $register['phone'] ?></label>
                        <input type="tel" class="form-control phone" id="phone" placeholder="<?php echo $register['phone'] ?>" name="phone" required>
                        <div class="form-control-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName"><?php echo $register['name'] ?></label>
                        <input type="text" class="form-control" id="inputName" placeholder="<?php echo $register['name'] ?>" name="name" required>
                        <div class="form-control-feedback"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label><?php echo $register['pass'] ?></label>
                        <input type="password" class="form-control" id="inputPassword1" placeholder="<?php echo $register['pass'] ?>" name=password required>
                        <div class="form-control-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputSecondName"><?php echo $register['sur'] ?></label>
                        <input type="text" class="form-control" id="inputSecondName" placeholder="<?php echo $register['sur'] ?>"  name="secondname">
                        <div class="form-control-feedback"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4"><?php echo $register['apass'] ?></label>
                        <input type="password" class="form-control" id="inputPassword2" placeholder="<?php echo $register['apass'] ?>" required name=password2>
                        <div class="form-control-feedback"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineradio1" name="radi1" value="Male" checked>
                        <label class="form-check-label"><?php echo $register['m1'] ?></label>
                        <div class="form-control-feedback"></div>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineradio2" name="radi1" value="Female">
                        <label class="form-check-label"><?php echo $register['m2'] ?></label>
                        <div class="form-control-feedback"></div>
                    </div>
                </div>
                <div class="button text-center">
                    <button id="registerButton" type="submit" name=register class="btn <?php echo $_SESSION['lang'] ?> btn-block effect-button2" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $register['reg'] ?></span></button>
                </div>
                <span class="psw"><a href="login.php"><?php echo $register['log'] ?></a></span>
            </form>
        </div>
    </div>
    <!--register-end-->

    <?php require_once 'templates/footer.php' ?>

</body>

</html>