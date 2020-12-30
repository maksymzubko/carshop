<?php 
echo ' <!--header-start-->
<div class="top-header">
    <div class="container">
        <div class="top-header-main">
            <div class="top-header-left">
                <div class="dropdown '. $_SESSION['lang'].' ">
                    <button class="dropbtn">'. $lang['language'] . ' <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <label class="lan" id="en">English</label>
                        <label class="lan" id="ru">Русский</label>
                        <label class="lan" id="ukr">Українська</label>
                    </div>
                </div>
            </div>
            <div class="top-header-right">
                <div class="account-box '. $_SESSION['lang'] .'">
                    <label>'. $lang['toplabel'] .'</label>
                    <a href="account.html">
                        <img src="images/account.png" alt="" style="width:30px;height:30px" />
                    </a>
                    <div class="clearfix"> </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</div>
<div class="logo">
    <a href="index.php">
        <h1><b>Prestigious cars</b></h1>
    </a>
</div>
<div class="header-bottom">
    <div class="container">
        <div class="header">
            <div class="col-md-12">
                <div class="top-nav">
                    <ul class="memenu '. $_SESSION['lang'] .' main skyblue">
                        <li class="grid" id="first">
                            <a href="index.php">'. $lang['home'] .'</a>
                        </li>
                        <li class="grid" id="second"><a href="cars.php">'. $lang['cars'] .'</a>
                        </li>
                        <li class="grid" id="third"><a href="blog.php">'. $lang['blog'] .'</a>
                        </li>
                        <li class="grid" id="fourh"><a href="contact.php">'. $lang['contact'] .'</a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--header-end-->'
?>