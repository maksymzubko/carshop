<?php require_once "app/config.php" ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "templates/head.php" ?>

    <title><?php echo $catalog['catalog'] ?></title>
</head>

<body>
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
    <?php require_once "templates/header.php" ?>

    <!--Navigator start-->
    <div class="breadcrumb">
    <div class="back d-flex align-items-center"> <img src="/images//arrow-back.png" height="15px" width="20px"> <a href="" onclick="history.back();return false;"><?php echo $lang['back'] ?></a> </div>
        <div class="container pt-3 pb-3 w-75">
            
            <div class="row">
               
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php"><?php echo $lang['home'] ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $catalog['catalog'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <section class="cars">
        <div class="cars__product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 filter mb-3 sticky top-0">
                        <div class="filters_setting ">
                            <h2><?php echo $lang['filter'] ?></h2>
                            <div class="icons">
                                <div class="ico filter-ico"></div>
                            </div>
                        </div>
                        <div class="filters_list sticky top-0">
                            <div class="close">X</div>
                            <div class="filter__menu ">
                                <div class="header">
                                    <h2><?php include 'app/functions.php';
                                        echo $catalog['c1'] ?></h2>
                                </div>
                                <div class="content">
                                    <?php
                                    $db = get_connection();
                                    $query = "Select `cat_Caption` from categories group by `cat_Caption` order by `cat_Caption` asc";
                                    $result = $db->query($query);
                                    require 'languages/translater.php';
                                    $arr = array();
                                    $rows = array();
                                    while ($row = $result->fetch_assoc()) {
                                        array_push($arr, translateCategory($row['cat_Caption']));
                                    }

                                    asort($arr);

                                    $result = $db->query($query);

                                    foreach ($arr as $val) {
                                        $row = $result->fetch_assoc();
                                        echo '<div class="form-check"> <input class="form-check-input category common_selector" type="checkbox" value="' . $row['cat_Caption']  . '" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">' . $val . '
                                            </label></div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="filter__menu">
                                <div class="header">
                                    <h2><?php echo $catalog['f1'] ?></h2>
                                </div>
                                <div class="content">
                                    <?php
                                    $query = "Select mark from marks group by mark order by `mark` ASC";
                                    $result = $db->query($query);

                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="form-check"> <input class="form-check-input brand common_selector" type="checkbox" value="' . $row['mark']  . '" id="flexCheckDefault"> <label class="form-check-label" for="flexCheckDefault">' . $row['mark']  . '
                                                </label></div>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="filter__menu">
                                <div class="header">
                                    <h2><?php echo $catalog['col'] ?></h2>
                                </div>
                                <div class="content">
                                    <ul class="colors">
                                        <li><a class="color yellow common_selector" id="Желтый" href="" onclick="return false;"></a></li>
                                        <li><a class="color red common_selector" id="Красный" href="" onclick="return false;"></a></li>
                                        <li><a class="color blue common_selector" href="" id="Синий" onclick="return false;"></a></li>
                                        <li><a class="color black common_selector" id="Черный" href="" onclick="return false;"></a></li>
                                        <li><a class="color white common_selector" id="Белый" href="" onclick="return false;"></a></li>
                                        <li><a class="color green common_selector" id="Зеленый" href="" onclick="return false;"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 main">
                        <div class="car-profile row">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php require_once "templates/scripts.php" ?>
    <?php require_once "templates/footer.php" ?>
</body>

</html>