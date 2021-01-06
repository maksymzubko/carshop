<?php

if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

include 'functions.php';

if (!empty($_POST)) 
{
    header('Content-Type: application/json');

    if (isset($_POST['pass'])) {
        $error = checkUser($_POST);

        if ($error=="") {
            if (login($_POST)) {
                http_response_code(201);
                echo json_encode([
                    'success' => true
                ]);
                exit();
            }
            http_response_code(500);
            echo json_encode([
                'success' => false
            ]);
            exit();
        }

        http_response_code(422);

        echo json_encode([
            'success' => false,
            'error' => $error
        ]);

        exit();
    } 
    else if(isset($_POST['password'])) {
        $error = validate($_POST);

        if ($error=="") {
            if (register($_POST)) {
                http_response_code(201);
                echo json_encode([
                    'success' => true
                ]);
                exit();
            }
            http_response_code(500);
            echo json_encode([
                'success' => false
            ]);
            exit();
        }

        http_response_code(422);

        echo json_encode([
            'success' => false,
            'error' => $error
        ]);

        exit();
    }
    else if(isset($_POST['checkAccount'])) {
        $error = validateAccount($_POST);

        if ($error !="") {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => $error
            ]);
            exit();
        }
        else
        {
            http_response_code(200);
            echo json_encode([
                'success' => true
            ]);
            exit();
        }
    }
    else if (isset($_POST['logout'])) {
        logout();
        http_response_code(201);
        echo json_encode([
            'success' => true
        ]);
        exit();
    } 
    else if (isset($_POST['action'])) {
        if($_POST['action']=="fetch_data")
        {
            $db = get_connection();

    $query = "SELECT * FROM `auto` join images on img_a_ID=a_ID join models on a_model=m_id join categories on c_ID = cat_ID join marks on m_mark_ID=mark_ID where visible = 'Enabled' and isMain = 'True'";

    if(isset($_POST['category']) && !empty($_POST['category']))
    {
        $cat_filter = implode("','", $_POST['category']);

        $query .= " AND cat_Caption IN('".$cat_filter."')";     
    }

    if(isset($_POST['brand']) && !empty($_POST['brand']))
    {
        $brand_filter = implode("','", $_POST['brand']);

        $query .= " AND mark IN('".$brand_filter."')";     
    }

    if(isset($_POST['color']) && !empty($_POST['color']))
    {
        $color_filter = implode("','", $_POST['color']);

        $query .= " AND a_color IN('".$color_filter."')";     
    }
    $result = $db->query($query);
    $output = "";
    if($result)
    {
        $numrows = $result->num_rows;
        require "../languages/" . $_SESSION['lang'] . ".php";
        if($numrows>0)
        {           
            while($row = $result->fetch_assoc())
            {
            $output .= '<div class="col-xs-12 col-sm-6 col-lg-6 col-md-6 product-left p-left" id="' . $row['a_ID'] . '">
            <div class="product-main">
                <div class="mask"><img class="img-responsive zoom-img" style="width:100%" src=" ' . $row['img'] . ' " alt="" /></div>
                <div class="product-bottom">
                    <h3>' . $row['mark'] . '</h3>
                    <p>' . $row['m_model'] . '</p>
                </div>
                <div class="product-buttons">
                    <a class="btn ' . $_SESSION['lang'] . ' effect-button lookcar" data-sm-link-text=" ' . $lang['buttonHideText'] . '"><span> ' . $catalog['btn'] . '</span></a>
                    <div class="photo" data-title="' . $catalog['alt'] . '">';

            if (IsCarFavourite($row['a_ID']))
                $output .= ' <img class="favourite is" tabindex="' . $row['a_ID'] . '">';
            else
                $output .= '<img class="favourite nope" tabindex="' . $row['a_ID'] . '">';

                $output .= '</div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>';
            }
            echo $output;
        }
        else
        {        
            echo $output = '<div class="text-center"><h3 class="none">'. $lang['ndata'] .'</h3></div>';
        }            
    }
    else
    {
        echo $output = '<div class="text-center"><h3 class="none">No Data Found</h3></div>';
    }
    }
        else
        exit();
    } 
    else if (isset($_POST['need'])) {
        if (isAuthorizated()) {
            if ($_POST['need'] == "0") {
                addToFavourite($_POST);
            } else {
                removeFromFavourite($_POST);
            }
            http_response_code(201);
            echo json_encode([
                'success' => true
            ]);
            exit();
        } else {
            http_response_code(500);
            echo json_encode([
                'success' => false
            ]);
            exit();
        }
    } 
    else if (isset($_POST['testdrive'])) {
        $user = $_COOKIE['acc'];
        $where = 'u_ID = ' . $user . '';
        getTest(array('need' => 'yes'), $where);
        exit();
    }
    else if (isset($_POST['mytest']) == "ndtst")
    {
        if (isAuthorizated()) {
                if(addToTestdrive($_POST['car_ID']))
                {
            http_response_code(201);
            echo json_encode([
                'success' => true
            ]);
            exit();
                }
                else
                {
                    http_response_code(500);
                    echo json_encode([
                        'success' => false,
                        'error'=>"Вы уже заказывали тест драйв этой машини!"
                    ]);
                    exit();
                }
        } else {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error'=>"Необходимо быть авторизорованым"
            ]);
            exit();
        }
    }
}
?>