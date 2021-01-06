<?php
echo '
<!--header-start-->
<div class="top-header">
    <div class="top-header-main">
        <div class="top-header-left">
            <div class="titleSite">
                <a class="mainLogo" href="index.php">
                    <img src="images/logo-mini.png" alt="" style="width:27px;height:30px" />
                    <h3><b>Carshop</b></h3>
                </a>
            </div>
        </div>
        <div class="header header1">
            <div class="col-md-12">
                <div class="top-nav">
                    <ul class="memenu ' . $_SESSION['lang'] . ' main skyblue">
                        <li class="grid" id="first">
                            <a href="index.php">' . $lang['home'] . '</a>
                        </li>
                        <li class="grid" id="second"><a href="cars.php">' . $lang['cars'] . '</a>
                        </li>
                        <li class="grid" id="third"><a href="blog.php">' . $lang['blog'] . '</a>
                        </li>
                        <li class="grid" id="fourh"><a href="contact.php">' . $lang['contact'] . '</a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="top-header-right">
            <div class="account-box ' . $_SESSION['lang'] . '">
                <div class="dropdown ' . $_SESSION['lang'] . ' ">
                    <button class="dropbtn">';
                        if (!isset($_COOKIE['acc']))
                        echo '<label class="lab">' . $lang['footerH3'] . '</label>';
                        else
                        echo '<label class="lab">' . $_COOKIE['name'] . '</label>';

                        echo '
                        <img src="images/account.png" alt="" style="width:30px;height:30px" /> <i
                            class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content acc">';
                        if (!isset($_COOKIE['acc'])) {
                        echo '<a href="login.php"><label class="acclog" id="log">' . $login['log'] . '</label></a>
                        <a href="register.php"><label class="accreg" id="reg">' . $register['reg'] . '</label></a>';
                        } else {
                        echo '<a href="account.php"><label class="acclog" id="acc">' . $lang['faccp1'] . '</label></a>
                        <a href="favourite.php"><label class="accreg" id="fav">' . $lang['faccp2'] . '</label></a>
                        <a href="testdrives.php"><label class="accreg" id="test">' . $testdrive['test'] . '</label></a>
                        <a class="logout"><label class="hr">' . $account['exit'] . '</label></a>';
                        }
                        echo '

                    </div>
                </div>
                <div class="dropdown ' . $_SESSION['lang'] . ' ">
                    <button class="dropbtn">' . $lang['language'] . ' <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content lang">
                        <label class="lan" id="en">English</label>
                        <label class="lan" id="ru">Русский</label>
                        <label class="lan" id="ukr">Українська</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="logo" style="display:none">
    <a href="index.php">
        <h1><b>Carshop INC</b></h1>
    </a>
</div>
<div class="header-bottom disable">
    <div class="container">
        <div class="header header2">
            <div class="col-md-12">
                <div class="top-nav">
                    <ul class="memenu '. $_SESSION['lang'] .' main skyblue">
                        <li class="grid" id="first2">
                            <a href="index.php">'. $lang['home'] .'</a>
                        </li>
                        <li class="grid" id="second2"><a href="cars.php">'. $lang['cars'] .'</a>
                        </li>
                        <li class="grid" id="third2"><a href="blog.php">'. $lang['blog'] .'</a>
                        </li>
                        <li class="grid" id="fourh2"><a href="contact.php">'. $lang['contact'] .'</a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--header-end-->';
?>
