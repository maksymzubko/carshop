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

    <?php require_once "head.php" ?>

    <title><?php echo $login['login'] ?></title>
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
                    <li class="active"><?php echo $login['login'] ?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->

    <!--login-starts-->
<div class="login <?php echo $_SESSION['lang'] ?>">
<div class="container">
<h2 class="text-center"><?php echo $login['login'] ?></h2>
<form id="login" method="post">
  <div class="container">
    <label for="uname"><b><?php echo $register['email'] ?></b></label>
    <input type="text" placeholder="<?php echo $register['email'] ?>" name="email" maxlength="30" required>

    <label for="psw"><b><?php echo $register['pass'] ?></b></label>
    <input type="password" placeholder="<?php echo $register['pass'] ?>" name="pass" maxlength="30" required>
    <div class="text-center">
    <button type="submit" class="btn <?php echo $_SESSION['lang'] ?> btn-block effect-button2" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $login['log'] ?></span></button>
    </div>
    <label>
      <input type="checkbox" name="remember"> <?php echo $login['rem']?>
    </label>
    <span class="psw"><a href="register.php"><?php echo $login['acc'] ?></a></span>
  </div>
  </div>
</form>
</div>
</div>
    <!--login-end-->

    <?php require_once 'footer.php' ?>

</body>

</html>