<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include 'functions.php';

//FUNCTION FOR SENDS RESPONSE//
function sendResponse(array $res)
{
    if ($res['success'] == false) {
        http_response_code(500);
        echo json_encode($res);
        exit();
    } else {
        http_response_code(200);
        echo json_encode($res);
        exit();
    }
}

//IF WE HAVE A POST REQUEST//
if (!empty($_POST)) {
    header('Content-Type: application/json');
    require "../languages/" . $_SESSION['lang'] . ".php";
    require "../languages/translater.php";

    //ACTION WHEN WE TRY LOGIN//
    if (isset($_POST['pass'])) {
        $error = checkUser($_POST);

        if ($error == "" && login($_POST)) {
            sendResponse([
                'success' => true,
                'successmsg' => translateAction("Вы успешно авторизированы!")
            ]);
        } else {
            sendResponse([
                'success' => false,
                'error' => translateAction($error)
            ]);
        }
    }
    //ACTION WHEN WE TRY REGISTER//
    else if (isset($_POST['password'])) {
        $error = validate($_POST);

        if ($error == "" && register($_POST)) {
            sendResponse([
                'success' => true,
                'successmsg' => translateAction("Вы успешно зарегистрированы!")
            ]);
        } else {
            sendResponse([
                'success' => false,
                'error' => translateAction($error)
            ]);
        }
    }
    //ACTION FOR CHECK ?VALIDEACCOUNTID//
    else if (isset($_POST['checkAccount'])) {
        $error = validateAccount($_POST);

        if ($error != "") {
            sendResponse([
                'success' => false,
                'error' => translateAction($error)
            ]);
        } else {
            sendResponse([
                'success' => true
            ]);
        }
    }
    //ACTION WHEN USER LOGOUT//
    else if (isset($_POST['logout'])) {
        logout();
        sendResponse([
            'success' => true,
            'successmsg' => translateAction("Вы успешно вышли!")
        ]);
    }
    //ACTION FILTER//
    else if (isset($_POST['action'])) {
        if ($_POST['action'] == "fetch_data") {
            $db = get_connection();

            $query = "SELECT * FROM `auto` join images on img_a_ID=a_ID join models on a_model=m_id join categories on c_ID = cat_ID join marks on m_mark_ID=mark_ID where visible = 'Enabled' and isMain = 'True'";

            if (isset($_POST['category']) && !empty($_POST['category'])) {
                $cat_filter = implode("','", $_POST['category']);

                $query .= " AND cat_Caption IN('" . $cat_filter . "')";
            }

            if (isset($_POST['brand']) && !empty($_POST['brand'])) {
                $brand_filter = implode("','", $_POST['brand']);

                $query .= " AND mark IN('" . $brand_filter . "')";
            }

            if (isset($_POST['color']) && !empty($_POST['color'])) {
                $color_filter = implode("','", $_POST['color']);

                $query .= " AND a_color IN('" . $color_filter . "')";
            }
            $result = $db->query($query);
            $output = "";
            if ($result) {
                $numrows = $result->num_rows;
                if ($numrows > 0) {
                    while ($row = $result->fetch_assoc()) {
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
                } else {
                    echo $output = '<div class="text-center"><h3 class="none">' . $lang['ndata'] . '</h3></div>';
                }
            } else {
                echo $output = '<div class="text-center"><h3 class="none">' . $lang['ndata'] . '</h3></div>';
            }
        } else {
            if ($_POST['action'] == "getAllTests") {
                $output = getAllTests("status = 'Waiting'");
                if($output['recordsFiltered'] == 0)
                {
                    http_response_code(500);
                    echo json_encode($output);
                }
                else
                {
                    $output["success"] = true; 
                    echo json_encode($output);
                }
                
            }else if($_POST['action'] == "getAllTests2")
            {
                $output = getAllTests("status IN ('Waiting','Success', 'Denied')");
                if($output['recordsFiltered'] == 0)
                {
                    http_response_code(500);
                    echo json_encode($output);
                }
                else
                {
                    $output["success"] = true; 
                    echo json_encode($output);
                }
            }else if($_POST['action'] == "getVisible"){
                $output = getVisible();
                if($output['recordsFiltered'] == 0)
                {
                    http_response_code(500);
                    echo json_encode($output);
                }
                else
                {
                    echo json_encode($output);
                }
            }else if($_POST['action'] == "getAuto"){
                $output = getAuto();
                if($output['recordsFiltered'] == 0)
                {
                    http_response_code(500);
                    echo json_encode($output);
                }
                else
                {
                    echo json_encode($output);
                }
            }else if (isset($_POST['action']) == "getUsers")
            {
                $output = getUsers();
                if($output['recordsFiltered'] == 0)
                {
                    http_response_code(500);
                    echo json_encode($output);
                }
                else
                {
                    echo json_encode($output);
                }
            }
            else if (isset($_POST['action']) == "edit") {
                if (isset($_POST['status'])) {
                    $db = get_connection();
        
                    $d_ID  = $_POST['d_ID'];
                    $status  = $_POST['status'];
        
                    $query = "
         UPDATE testdrive SET status = '" . $_POST["status"] . "' WHERE d_ID = '" . $_POST["d_ID"] . "'
         ";
                    $statement = $db->query($query);

                    echo json_encode($_POST);
                }
                else if (isset($_POST['visible'])) {
                    $db = get_connection();
                    if($_POST['visible'] == 'Enabled')
                    {                                              
                        $vis  = $_POST['visible'];
                        
                        $query = "
                        UPDATE auto SET visible = '" . $_POST["visible"] . "'";
                        $statement = $db->query($query);
                        
                        echo json_encode($_POST);
                    }
                    else if($_POST['visible'] == 'Disabled')
                    {
                        $vis  = $_POST['visible'];
                        
                        $query = "
                        UPDATE auto SET visible = '" . $_POST["visible"] . "'";
                        $statement = $db->query($query);
                        
                        echo json_encode($_POST);
                    }
                    else
                    {                      
                        $d_ID  = $_POST['a_ID'];
                        $vis  = $_POST['visible'];
                        
                        $query = "
                        UPDATE auto SET visible = '" . $_POST["visible"] . "' WHERE a_ID = '" . $_POST["a_ID"] . "'
                        ";
                        $statement = $db->query($query);
                        
                        echo json_encode($_POST);
                    }
                }
                
            }
        }
        //ACTION WITH ADD/DELETE FAVOURITE CAR//
    }  else if (isset($_POST['need']) &&  isset($_POST['car_ID'])) {
        if (isAuthorizated()) {
            if ($_POST['need'] == "0") {
                addToFavourite($_POST);
                sendResponse([
                    'success' => true,
                    'successmsg' => translateAction("Действие выполнено!")
                ]);
            } else {
                removeFromFavourite($_POST);
                sendResponse([
                    'success' => true,
                    'successmsg' => translateAction("Действие выполнено!")
                ]);
            }
        } else {
            sendResponse([
                'success' => false,
                'error' => translateAction("Необходимо быть авторизорованым!")
            ]);
        }
        //ACTION LIST OF USER TESTDRIVES//
    } else if (isset($_POST['testdrive'])) {
        $user = decrypt($_COOKIE['acc']);
        $where = 'u_ID = ' . $user . '';
        getTest(array('need' => 'yes'), $where);
        exit();
        //ACTION ADD TO TESTDRIVE//
    } else if (isset($_POST['mytest']) == "ndtst") {
        if (isAuthorizated()) {
            if (addToTestdrive($_POST['car_ID'])) {
                sendResponse([
                    'success' => true,
                    'successmsg' => translateAction("Вы успешно добавили машину! С вами свяжется наш сотрудник.")
                ]);
                exit();
            } else {
                sendResponse([
                    'success' => false,
                    'error' => translateAction("Вы уже заказывали тест драйв этой машини!")
                ]);
            }
        } else {
            sendResponse([
                'success' => false,
                'error' => translateAction("Необходимо быть авторизорованым!")
            ]);
        }
    }
}
?>