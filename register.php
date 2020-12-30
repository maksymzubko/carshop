<?php require_once "config.php" ?>
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
    <div class="register">
        <div class="container">
            <div class="register-top heading">
                <h2><?php echo $register['register'] ?></h2>
            </div>
            <form id="register" method="post" oninput='password2.setCustomValidity(password.value != password2.value ? "Passwords do not match." : "")'>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email"  name="email" required>
                        <div class="form-control-feedback"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPhone">Phone number</label>
                        <input type="tel" class="form-control phone" id="phone" placeholder="Phone" name="phone" required>
                        <div class="form-control-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" required>
                        <div class="form-control-feedback"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Password </label>
                        <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name=password required>
                        <div class="form-control-feedback"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputSecondName">Second Name</label>
                        <input type="text" class="form-control" id="inputSecondName" placeholder="Second Name"  name="secondname">
                        <div class="form-control-feedback"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password confirm</label>
                        <input type="password" class="form-control" id="inputPassword2" placeholder="Repeat Password" required name=password2>
                        <div class="form-control-feedback"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineradio1" name="radi1" value="Male" checked>
                        <label class="form-check-label">Male</label>
                        <div class="form-control-feedback"></div>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineradio2" name="radi1" value="Female">
                        <label class="form-check-label">Female</label>
                        <div class="form-control-feedback"></div>
                    </div>
                </div>
                <div class="button text-center">
                    <button id="registerButton" type="submit" name=register class="btn <?php echo $_SESSION['lang'] ?> btn-block effect-button2" data-sm-link-text="<?php echo $lang['buttonHideText'] ?>"><span><?php echo $lang['faccp2'] ?></span></button>
                </div>
            </form>
        </div>
    </div>
    <!--register-end-->

    <?php require_once 'footer.php' ?>

</body>

</html>