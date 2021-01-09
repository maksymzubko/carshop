<?php
echo '
<!--header-start-->
<div class="top-header">
    <div class="top-header-main">
        <div class="top-header-left">
            <div class="titleSite">
                <a class="mainLogo" href="../index.php">
                    <img src="../images/logo-mini.png" alt="" style="width:27px;height:30px" />
                    <h3><b>Carshop</b></h3>
                </a>
            </div>
        </div>
        <div class="top-header-right">
            <div class="account-box">
                <div class="dropdown ">
                    <button class="dropbtn">';
                        echo '<label class="lab"> Acc</label>';
                        echo '
                        <img src="../images/account.png" alt="" style="width:30px;height:30px" /> <i
                            class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content acc">';
                        echo '<a href="../index.php"><label class="acclog" id="acc"> Main page </label></a>
                        <a class="logout"><label class="hr"> Logout </label></a>';
                        echo '
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--header-end-->'; ?>