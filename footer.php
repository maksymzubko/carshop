<?php 

echo ' <!--information-start-->
<div class="information '. $_SESSION['lang'] .'">
    <div class="container">
        <div class="infor-top">
            <div class="col-xxs-12 col-xs-3 col-md-3 infor-left">
                <h3 class="'. $_SESSION['lang'] .'">'. $lang['footerH1'] .'</h3>
                <ul>
                    <li><a href="https://www.facebook.com/profile.php?id=100007769135894"><span class="fb"></span>
                            <h6>Facebook</h6>
                        </a></li>
                    <li><a href="https://twitter.com/Maksimilan0"><span class="twit"></span>
                            <h6>Twitter</h6>
                        </a></li>
                    <li><a href="https://www.instagram.com/piaceofrice"><span class="google"></span>
                            <h6>Instagram</h6>
                        </a></li>
                </ul>
            </div>
            <div class="col-xxs-12 col-xs-3 col-md-3 infor-left">
                <h3 class="'. $_SESSION['lang'] .'">'. $lang['footerH2'] .'</h3>
                <ul>
                    <li><a href="cars.php">
                            <p>'. $lang['finfp1'] .'</p>
                        </a></li>
                    <li><a href="contact.php">
                            <p>'. $lang['finfp2'] .'</p>
                        </a></li>
                </ul>
            </div>
            <div class="col-xxs-12 col-xs-3  col-md-3 infor-left">
                <h3 class="'. $_SESSION['lang'] .'">'. $lang['footerH3'] .'</h3>
                <ul>
                    <li><a href="account.php">
                            <p>'. $lang['faccp1'] .'</p>
                        </a></li>
                    <li><a href="favourite.php">
                            <p>'. $lang['faccp2'] .'</p>
                        </a></li>
                </ul>
            </div>
            <div class="col-xxs-12 col-xs-3 col-md-3 infor-left">
                <h3 class="'. $_SESSION['lang'] .'">'.$lang['footerH4'] .'</h3>
                <h4>KhCar Shop,
                    <span>'.$lang['fstorep1'] .',</span>
                    '. $lang['fstorep2'] .'
                </h4>
                <h5><a href="callto:+380992443242">+380 99 244 3242</a></h5>
                <p><a href="mailto:makzzubko66@email.com">makzzubko66@gmail.com</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--information-end-->

<!--footer-starts-->
<div class="footer '. $_SESSION['lang'] .'">
    <div class="container">
        <div class="footer-top text-center">
            <p>© 2020 Prestigious cars. '.$lang['footer'] .'</p>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</div>
<!--footer-end-->';

?>