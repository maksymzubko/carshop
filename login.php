<?php require_once "config.php" ;
if(isset($_COOKIE['account']))
{
    header("Location: account.php"); exit;
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "head.php" ?>

    <title><?php echo $register['register'] ?></title>
</head>

<body class="body_hide">

    <?php require_once 'header.php' ?>

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
    <div class="register login <?php echo $_SESSION['lang'] ?>">
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
                        <label for="inputPass"><?php echo $register['pass'] ?></label>
                        <input type="password" class="form-control phone" id="pass" placeholder="<?php echo $register['pass'] ?>" name="password" required>
                        <div class="form-control-feedback"></div>
                    </div>
                </div>
                <div class="button text-center">
                    <button id="registerButton" type="submit" name=register class="btn <?php echo $_SESSION['lang'] ?> btn-block effect-button2" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $register['reg'] ?></span></button>
                </div>
            </form>
        </div>
    </div>
    <!--register-end-->

    <?php require_once 'footer.php' ?>

</body>

</html>