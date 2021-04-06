<?php require_once 'app/config.php';
require_once "app/eventsHandler.php";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $result = getCarByID($_GET['id']);
    if (!$result) {
        header("Location: ../cars.php");
        exit;
    } else {
        $images = getImagesAuto($_GET['id']);
        $colors = getColors($result['a_year'], $result['a_model']);
    }
} else {
    header("Location: ../cars.php");
    exit;
}
?>
<title><?php echo $car['car'];
        echo $result['a_ID'] ?></title>
<html>

<head>
    <?php require_once 'templates/head.php' ?>
</head>

<body class="auto">
    <div class="form-testdrive hide">
        <form>
            <div class="close_btn">X</div>
            <h3 class="text-center mb-3"><?php echo $testform['order']?>:</h3>
            <h5><?php echo $testform['auto'] ." : ". $result['mark'] . ' ' . $result['m_model']; ?></h5>
            <h5><?php echo $testform['year'] ." : ". $result['a_year']; ?></h5>
            <p><?php echo $testform['com']?></p>
            <h4><?php echo $testform['datetext']?></h4>
            <input type="text" name="data" value="" class="datetime" placeholder="<?php echo $testform['inputtext']?>" readonly=true>
            <div><input type="checkbox" name="pricecheck" class="pricecheck"> <?php echo $testform['rules']?> <b><?php echo $result['t_price'] ?> UAH</b></div>.
            <button name="submit" class="disable text-center align-self-center order" onclick="return false;"><?php echo $car['b2']?></button>
        </form>
    </div>
    <div class="contact-with-us close unselect">
        <div class="header">
            <div><img src="/images/arrow-down.png" width="35px" height="15px"></div>
            <p><?php echo $lang['cont']?></p>
        </div>
        <div class="contact-info d-flex align-items-center justify-content-start flex-column">
            <div class="d-flex align-items-center"><img style="margin-right:10px" src="/images/phone.png" width="25px" height="18px">
                <p><a href="callto:+380992443242">+380 99 244 3242</a></h5>
            </div>
            <div class="d-flex align-items-center"><img style="margin-right:10px" src="/images/mail.png" width="25px" height="18px">
                <p><a href="mailto:makzzubko66@email.com">makzzubko66@gmail.com</a></p>
            </div>
        </div>
    </div>
    <img id="myBtn" src="images/arrow.png" class="go__top" style="display: none;">
    <?php require_once 'templates/header.php';
    require 'languages/translater.php'; ?>

    <!--start-breadcrumbs-->
    <div class="breadcrumb">
        <div class="back align-items-center"> <img src="/images//arrow-back.png" height="15px" width="20px"> <a href="" onclick="history.back();return false;"><?php echo $lang['back'] ?></a> </div>
        <div class="container pt-3 pb-3 w-75">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><?php echo $lang['home'] ?></a></li>
                        <li class="breadcrumb-item"><a href="cars.php"><?php echo $catalog['catalog'] ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $car['car'];
                                                                                echo $result['a_ID'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->

    <!--start-car-->
    <section>
        <div class="car-page">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-6 col-xl-4">
                        <div id="carouselExampleIndicators" class="carousel slide mh-25" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php $count = 0;
                                while ($img = $images->fetch_assoc()) {
                                    if ($count == 9)
                                        break;

                                    if ($count == 0)
                                        echo ' 
                                        <div class="carousel-item active">
                                        <img src="' . $img['img'] . '" class="d-block " alt="...">
                                        </div>';
                                    else
                                        echo '<div class="carousel-item">
                                        <img src="' . $img['img'] . '" class="d-block " alt="...">
                                        </div>';
                                    $count++;
                                }; ?>
                            </div>
                            <?php if ($count > 1)
                                echo ' <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>'
                            ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-xl-6">
                        <div class="car-main_info">
                            <h2 class="mt-4 mt-lg-0"><?php echo '' . $result['mark'] . ' ' . $result['m_model'] . ''; ?></h2>
                            <p class="mt-4"><?php echo $car['c1'] ?></p>
                            <div class="colors-list">
                                <ul class="colors">
                                    <?php while ($col = $colors->fetch_assoc()) {
                                        echo '<li><a class="' . $col['a_color'] . '" onclick="return false"></a></li>';
                                    };
                                    ?>
                                </ul>
                            </div>
                            <p class="mb-1 mt-3"><?php echo $car['c2'] ?></p>
                            <div class="eq-list">
                                <ul class="equip p-4 pt-0">
                                    <?php
                                    echo '<li>' . translateEquip($result['e_name']) . '</li>';
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center justify-content-lg-end">
                    <div class="b w-lg-25 mt-4 mb-4">
                        <a href="" class=" w-100
                        btn_opacity black  test" onclick="return false"><?php echo $car['b2'] ?></a>
                    </div>
                </div>
                <div class="row">
                    <div class="desc-car">
                        <ul class="menu_drop">
                            <li class="items item2"><a href="#">
                                    <div class="arrow_car"></div><?php echo $car['ac2'] ?>
                                </a>
                                <ul style="display: none;">
                                    <div class="row pb-4 pt-4">
                                        <div class="col-md-6 col-sm-12 left">
                                            <img class="icon" src="/images/icons/engine.svg">
                                            <li><?php echo $car['mc1'];
                                                echo " : ";
                                                echo $result['m_capacity'] ?></li>
                                            <img class="icon" src="/images/icons/car.svg">
                                            <li><?php echo $car['mc2'];
                                                echo " : ";
                                                echo translateEq($result['m_mode']) ?></li>
                                            <img class="icon" src="/images/icons/transmission.svg">
                                            <li><?php echo $car['mc3'];
                                                echo " : ";
                                                echo translateEq($result['m_gb']) ?></li>
                                            <img class="icon" src="/images/icons/privod.svg">
                                            <li><?php echo $car['mc4'];
                                                echo " : ";
                                                echo translateEq($result['m_privod']) ?></li>
                                            <img class="icon" src="/images/icons/gasoline.svg">
                                            <li><?php echo $car['mc5'];
                                                echo " : ";
                                                echo translateEq($result['m_fuel']) ?></li>
                                                <img class="icon" src="/images/icons/seat.svg">
                                            <li><?php echo $car['e1'];
                                                echo " : ";
                                                echo translateEq($result['m_seat']) ?></li>
                                        </div>
                                        <div class="col-6 col-12-sm right">                                      
                                            <img class="icon" src="/images/icons/window.svg">
                                            <li><?php echo $car['e2'];
                                                echo " : ";
                                                echo translateEq($result['m_steklopod']) ?></li>
                                            <img class="icon" src="/images/icons/temperature.svg">
                                            <li><?php echo $car['e3'];
                                                echo " : ";
                                                echo translateEq($result['m_climatctrl']) ?></li>
                                            <img class="icon" src="/images/icons/secure.svg">
                                            <li><?php echo $car['e4'];
                                                echo " : ";
                                                echo translateEq($result['m_security']) ?></li>
                                            <img class="icon" src="/images/icons/cruise-control.svg">
                                            <li><?php echo $car['e5'];
                                                echo " : ";
                                                echo translateEq($result['m_cruisctrl']) ?></li>
                                            <img class="icon" src="/images/icons/esp.svg">
                                            <li><?php echo $car['e6'];
                                                echo " : ";
                                                echo translateEq($result['m_esp']) ?></li>
                                            <img class="icon" src="/images/icons/airbag.svg">
                                            <li><?php echo $car['e7'];
                                                echo " : ";
                                                echo translateEq($result['m_airbags']) ?></li>
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section></section>
    <!--end-car-->

    <!--footer-starts-->
    <?php require_once 'templates/footer.php'; ?>
    <?php require_once 'templates/scripts.php'; ?>
    <!--footer-end-->
    <script>

    </script>
</body>

</html>