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
        $videos = getVideos($_GET['id']);
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

<body>
<img id="myBtn" src="images/arrow.png" class="go__top" style="display: none;">
    <?php require_once 'templates/header.php';
    require 'languages/translater.php'; ?>

    <!--start-breadcrumbs-->
    <div class="breadcrumb">
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
                    <div class="b w-lg-25">
                        <a href="" class=" w-100
                        btn mt-2 mb-2 testdrive_add item_add" onclick="return false"><?php echo $car['b2'] ?></a>
                    </div>
                </div>
                <div class="row">
                    <div class="desc-car">
                        <ul class="menu_drop">
                            <li class="items item2"><a href="#"><?php echo $car['ac2'] ?></a>
                                <ul style="display: none;">
                                    <div class="row">
                                        <div class="col-6-md left">
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
                                        </div>
                                        <div class="col-6-md right">
                                            <img class="icon" src="/images/icons/seat.svg">
                                            <li><?php echo $car['e1'];
                                                echo " : ";
                                                echo translateEq($result['m_seat']) ?></li>
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
                            <li class="items item3"><a href="#"><img><?php echo $car['ac3'] ?></a>
                                <ul class="text-center" style="display: none;">
                                    <li class="subitem3"><a class="links" target="_blank" type="button" href="https://www.youtube.com/results?search_query=review+<?php echo $result['m_model'];
                                                                                                                                                                    echo "+";
                                                                                                                                                                    echo $result['mark'] ?>"><?php echo $car['b1'] ?> YOUTUBE</button></li>
                                    <li class="subitem3"><a class="links" target="_blank" type="button" href="http://www.google.com/search?q=review+<?php echo $result['m_model'];
                                                                                                                                                    echo "+";
                                                                                                                                                    echo $result['mark'] ?>"><?php echo $car['b1'] ?> GOOGLE</a></li>
                                    <div class="video">
                                        <?php
                                        while ($v = $videos->fetch_assoc()) {
                                            echo '<iframe id="video" width="560" height="315" src="https://www.youtube.com/embed/' . $v['v_link'] . ' " frameborder="0" allowfullscreen></iframe>';
                                        }
                                        ?>
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