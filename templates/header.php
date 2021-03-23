<?php
echo '
<header>
<div class="container">
    <div class="header">
        <nav class="navbar sticky-top w-100 navbar-expand-lg navbar-dark bg-black">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon custom_icon"></span>
                    <span class="navbar-toggler-icon custom_icon"></span>
                    <span class="navbar-toggler-icon custom_icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" id="first" aria-current="page" href="index.php">' . $lang['home'] . '</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="second"  href="cars.php">' . $lang['cars'] . '</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="third"  href="contacts.php">' . $lang['contact'] . '</a>
                        </li>
                    </ul>
                    <div class="right__menu">
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">';
                                if (!isset($_COOKIE['acc']))
                                echo '<label class="lab">' . $lang['footerH3'] . '</label>';
                                else
                                {
                                    $user = json_decode($_COOKIE['acc'],true)["name"];
                                    echo $user;
                                }
                                echo '<img src="images/account.png" width="22em">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                            if (!isset($_COOKIE['acc'])) {
                                echo ' <li><a class="dropdown-item" href="login.php">' . $login['log'] . '</a></li>
                                <li><a class="dropdown-item" href="register.php">' . $register['reg'] . '</a></li>';
                                } else {
                                echo '
                                <li><a class="dropdown-item" href="testdrives.php">' . $testdrive['test'] . '</a></li>
                                <li><a class="dropdown-item logout" href="#">' . $account['exit'] . '</a></li>';
                                }   
                                echo'     
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                '.$lang['language'].'
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           
                            <li  class=" lan"><a class="dropdown-item" id="en" onclick="return false"   href="">English</a></li>
                            <li  class=" lan"><a class="dropdown-item" id="ru"  onclick="return false" href="">Русский</a></li>
                            <li   class=" lan"><a class="dropdown-item" id="ukr" onclick="return false" href="">Українська</a></li>
                            </ul>
                        </div>
                        <div class="ico ">
                            <div class="search ">                   
                            </div>
                        </div>
                    </div>
                    <div class="hide-timing search-input ">
                    <input placeholder="'.$lang['filter'].'" maxlength = 25>
                    <div class="search_result text-white">
                    </div>
                    
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>';
?>
