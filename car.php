<?php require_once 'app/config.php';
require_once "app/eventsHandler.php";
?>
<html>
<head>
    <?php require_once 'templates/head.php' ?>
</head>
<body class="body_hide">
    <?php require_once 'templates/header.php'; require 'languages/translater.php';?>

    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main <?php echo $_SESSION['lang'] ?>">
                <ol class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="cars.php">Cars</a></li>
                    <li class="active"><?php echo $car['car']; echo $result['a_ID']?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->

    <!--start-car-->
    <div class="single contact ">
        <div class="container">
            <div class="single-main">
                <div class="col-md-12 single-main-left">
                    <div class="sngl-top">
                        <div class="col-md-5 single-top-left">
                            <div class="flexslider">
                                <ul class="slides  text-center">
                                    <?php while($img = $images->fetch_assoc())
                                    {
                                        echo ' <li data-thumb="'. $img['img'] .'">
                                        <div class="thumb-image"> <img src="'. $img['img'] .'" data-imagezoom="true" class="img-responsive" alt="" /> </div>
                                    </li>';
                                    }; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-7 single-top-right">
                            <div class="single-para">
                                <h2><?php echo ''. $result['mark'] .' '.$result['m_model'] .'';?></h2>

                                <div class="available">
                                    <ul>
                                        <li><?php echo $car['c1'] ?>
                                        </li>
                                        <select>
                                            <?php  while($col = $colors->fetch_assoc())
                                            {
                                                echo '<option>'.translateColor($col['a_color']).'</option>';
                                            };
                                            ?>
                                        </select>
                                        <li class="size-in"><?php echo $car['c2'] ?></li>
                                        <select><?php
                                                echo '<option>'.translateEquip($result['e_name']).'</option>';
                                            ?>
                                        </select>
                                    </ul>
                                </div>
                                <a href="#" class="testdrive_add item_add">ADD TESTDRIVE</a>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="tabs">
                        <ul class="menu_drop">
                            <li class="items item1"><a href="#"><img><?php echo $car['ac1'] ?></a>
                                <ul>
                                    <li class="subitem1"><?php echo $result['m_description'] ?></li>
                                </ul>
                            </li>
                            <li class="items item2"><a href="#"><img><?php echo $car['ac2'] ?></a>
                            <ul>
                                <div class="row">
                                <div class="col-6-md left">
                                <img class="icon" src="/images/icons/engine.svg"><li><?php echo $car['mc1']; echo " : "; echo $result['m_capacity']?></li>
                                <img class="icon" src="/images/icons/car.svg"><li><?php echo $car['mc2']; echo " : "; echo translateEq($result['m_mode'])?></li>
                                <img class="icon" src="/images/icons/transmission.svg"><li><?php echo $car['mc3']; echo " : "; echo translateEq($result['m_gb'])?></li>
                                <img class="icon" src="/images/icons/privod.svg"><li><?php echo $car['mc4']; echo " : "; echo translateEq($result['m_privod'])?></li>
                                <img class="icon" src="/images/icons/gasoline.svg"> <li><?php echo $car['mc5']; echo " : "; echo translateEq($result['m_fuel'])?></li>
</div>
                                <div class="col-6-md right">
                                <img class="icon" src="/images/icons/seat.svg"><li><?php echo $car['e1']; echo " : "; echo translateEq($result['m_seat'])?></li>
                                <img class="icon" src="/images/icons/window.svg"><li><?php echo $car['e2']; echo " : "; echo translateEq($result['m_steklopod'])?></li>
                                <img class="icon" src="/images/icons/temperature.svg"><li><?php echo $car['e3']; echo " : "; echo translateEq($result['m_climatctrl'])?></li>
                                <img class="icon" src="/images/icons/secure.svg"><li><?php echo $car['e4']; echo " : "; echo translateEq($result['m_security'])?></li> 
                                <img class="icon" src="/images/icons/cruise-control.svg"><li><?php echo $car['e5']; echo " : "; echo translateEq($result['m_cruisctrl'])?></li>
                                <img class="icon" src="/images/icons/esp.svg"><li><?php echo $car['e6']; echo " : "; echo translateEq($result['m_esp'])?></li>
                                <img class="icon" src="/images/icons/airbag.svg"><li><?php echo $car['e7']; echo " : "; echo translateEq($result['m_airbags'])?></li>                        
</div></div>
                            </ul>
                            </li>
                            <li class="items item3"><a href="#"><img><?php echo $car['ac3'] ?></a>
                                <ul class="text-center">                  
                                    <li class="subitem3"><a class="links" target="_blank" type="button" href="https://www.youtube.com/results?search_query=review+<?php echo $result['m_model']; echo "+"; echo $result['mark']?>"><?php echo $car['b1'] ?> YOUTUBE</button></li>
                                    <li class="subitem3"><a  class="links" target="_blank" type="button" href="http://www.google.com/search?q=review+<?php echo $result['m_model']; echo "+"; echo $result['mark']?>"><?php echo $car['b1'] ?> GOOGLE</a></li>
                                    <?php  
                                    while($v = $videos -> fetch_assoc())
                                    {
                                        echo '<iframe id="video" width="560" height="315" src="https://www.youtube.com/embed/'. $v['v_link'] .' " frameborder="0" allowfullscreen></iframe>';
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-car-->

    <!--footer-starts-->
    <?php require_once 'templates/footer.php'; ?>
    <!--footer-end-->

    <script>
        $(function() {

            var menu_ul = $('.menu_drop > li > ul'),
                menu_a = $('.menu_drop > li > a');

            menu_ul.hide();

            menu_a.click(function(e) {
                e.preventDefault();
                if (!$(this).hasClass('active')) {
                    menu_a.removeClass('active');
                    menu_ul.filter(':visible').slideUp('normal');
                    $(this).addClass('active').next().stop(true, true).slideDown('normal');
                } else {
                    $(this).removeClass('active');
                    $(this).next().stop(true, true).slideUp('normal');
                }
            });
        });
        $(window).load(function() {
            $('.flexslider').flexslider({
                directionNav: false,
                animation: "fade",
                controlNav: "thumbnails"
            });
        });
    </script>
</body>

</html>