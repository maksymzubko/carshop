<?php require_once "app/config.php" ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "templates/head.php" ?>

    <title><?php echo $catalog['catalog'] ?></title>
</head>

<body class="body_hide">
    <?php require_once "templates/header.php" ?>

    <!--Navigator start-->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumbs-main <?php echo $_SESSION['lang'] ?>">
                <ol class="breadcrumb">
                    <li><a href="index.php"><?php echo $lang['home'] ?></a></li>
                    <li class="active"><?php echo $catalog['catalog'] ?></li>
                </ol>
            </div>
        </div>
    </div>
    <!--Navigator end-->

    <!--Cars-product start-->
    <div class="cars-catalog">
        <div class="container">
            <div class="cars-top">
                <div class="col-md-3 car-right">
                    <div class="w_sidebar">
                        <ul class="memenu <?php echo $_SESSION['lang'] ?> filters skyblue">
                            <li>
                                <section class="sky-form">
                                    <h4><?php include 'app/functions.php';
                                     echo $catalog['c1'] ?></h4>
                                    <div class="row1 scroll-pane">
                                        <div class="col col-4">
                                            <?php 
                                             $db = get_connection();
                                             $query = "Select `cat_Caption` from categories group by `cat_Caption` order by `cat_Caption` asc";
                                             $result = $db->query($query);

                                             while($row = $result->fetch_assoc())
                                             {
                                                 echo '<label class="checkbox"><input type="checkbox" class="category common_selector" value = "'. $row['cat_Caption']  .'"><i></i>'. $row['cat_Caption'] .'</label>';
                                             }
                                            ?>                                                                         
                                        </div>
                                    </div>
                                </section>
                                <section class="sky-form">
                                    <h4><?php echo $catalog['f1'] ?></h4>
                                    <div class="row1 scroll-pane">
                                        <div class="col col-4">
                                            <?php
                                            $query = "Select mark from marks group by mark order by `mark` ASC";
                                            $result = $db->query($query);

                                            while($row = $result->fetch_assoc())
                                             {
                                                 echo '<label class="checkbox"><input type="checkbox" class="brand common_selector" value = "'. $row['mark']  .'"><i></i>'. $row['mark'] .'</label>';
                                             }
                                            ?>                                  
                                        </div>
                                    </div>
                                </section>
                                <section class="sky-form">
                                    <h4><?php echo $catalog['col'] ?></h4>
                                    <ul class="w_nav2">
                                        <li><a class="color color9 common_selector" id="Желтый" href="#" onclick="return false;"></a></li>
                                        <li><a class="color color5 common_selector" id="Красный" href="#" onclick="return false;"></a></li>
                                        <li><a class="color color1 common_selector" id="Синий" href="#" onclick="return false;"></a></li>
                                        <li><a class="color color2 common_selector" id="Черный" href="#" onclick="return false;"></a></li>
                                        <li><a class="color color10 common_selector" id="Белый" href="#" onclick="return false;"></a></li>
                                        <li><a class="color color6 common_selector" id="Зеленый" href="#" onclick="return false;"></a></li>
                                    </ul>
                                </section>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="change1" class="sky-form-sort">
                        <h4>
                            <span>
                                <input type="radio" id="t1" name="radio" checked><img class="img-rounded" style="width:25px; height:25px" src="images/grid-white.png">
                            </span>
                            <span>
                                <input type="radio" id="t2" name="radio"><img class="img-rounded" style="width:25px; height:25px" src="images/list-white.png">
                            </span>
                        </h4>
                    </div>
                <div class="col-md-9 cars-left">                  
                    <div class="product maincar">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Cars-product end-->

    <?php require_once "templates/footer.php" ?>
</body>

</html>