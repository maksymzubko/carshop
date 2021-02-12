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
    if (!isset($_SESSION['lang']))
        $lang = "ru";
    else
        $lang = $_SESSION['lang'];

    require "../languages/" . $lang . ".php";
    require "../languages/translater.php";

    //ACTION WHEN WE TRY LOGIN//
    function actionLogin()
    {
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
    function actionRegister()
    {
        if (isset($_POST['unique']))
            $temp = "admin";
        else
            $temp = "user";

        $error = validate($_POST, $temp);

        if ($error == "" && register($_POST, $temp)) {

            $succesmsg = ($temp == "user") ? translateAction("Вы успешно зарегистрированы!") : "Ви успішно додали модератора!";

            sendResponse([
                'success' => true,
                'successmsg' => $succesmsg
            ]);
        } else {
            sendResponse([
                'success' => false,
                'error' => translateAction($error)
            ]);
        }
    }
    //ACTION FOR CHECK ?VALIDEACCOUNTID//
    function actionValidate(string $role)
    {
        $error = validateAccount($role);

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
    function logoutFromAccount(string $role)
    {
        logout($role);
        $succesmsg = ($role == "user") ? translateAction("Вы успешно вышли!") : "Ви успішно вийшли!";
        sendResponse([
            'success' => true,
            'successmsg' => $succesmsg
        ]);
    }

    function actionFirst()
    {
        $output = getAllTests("status = 'Waiting'");
        if ($output['recordsFiltered'] == 0) {
            http_response_code(500);
            echo json_encode($output);
        } else {
            $output["success"] = true;
            echo json_encode($output);
        }
    }

    function actionSecond()
    {
        $output = getAllTests("status IN ('Waiting','Success', 'Denied')");
        if ($output['recordsFiltered'] == 0) {
            http_response_code(500);
            echo json_encode($output);
        } else {
            $output["success"] = true;
            echo json_encode($output);
        }
    }
    function actionThird()
    {
        $output = getVisible();
        if ($output['recordsFiltered'] == 0) {
            http_response_code(500);
            echo json_encode($output);
        } else {
            echo json_encode($output);
        }
    }

    function actionFourth()
    {
        $output = getAuto();
        if ($output['recordsFiltered'] == 0) {
            http_response_code(500);
            echo json_encode($output);
        } else {
            echo json_encode($output);
        }
    }
    function actionFifth()
    {
        if ($_POST['move'] == 1) {
            $output = getUsersList(1);
        } else {
            $output = getUsersList(2);
        }
        if ($output->num_rows == 0) {
            http_response_code(500);
        } else {
            http_response_code(200);
            $data = array();
            $outputText = '';
            while ($row = $output->fetch_assoc()) {
                $temp = array();
                $temp['u_ID'] = $row['u_ID'];
                $temp['u_login'] = $row['u_login'];
                $temp['u_name'] = $row['u_name'];
                $temp['u_fname'] = $row['u_fname'];
                $outputText .=  '<li class="drplist">' . $row['u_ID'] . '</li>';
                $data[] = $temp;
            }
            echo json_encode(array(
                'html' => $outputText,
                'data' => $data
            ));
        }
    }
    function actionSixth()
    {
        $output = makeAdmin($_POST['unique']);
        if ($output['result'] == true) {
            http_response_code(200);
            echo json_encode($output);
        } else {
            http_response_code(500);
        }
    }
    function actionSeventh()
    {
        $output = deleteUser($_POST['unique'], "admin");
        if ($output == "0") {
            sendResponse([
                'success' => false
            ]);
        } else {
            sendResponse([
                'success' => true
            ]);
        }
    }
    function actionEighth()
    {
        if (isAuthorizated()) {
            $output = getTestCar($_POST['car_ID']);
            $output["eq"] = translateAction("Вы уже заказывали тест драйв этой машини!");
            http_response_code(200);
            echo json_encode($output);
        } else {
            sendResponse([
                'success' => false,
                'block' => true,
                'error' => translateAction("Необходимо быть авторизорованым!")
            ]);
        }
    }
    function actionNinth()
    {
        $output = getUsers();
        if ($output['recordsFiltered'] == 0) {
            http_response_code(500);
            echo json_encode($output);
        } else {
            echo json_encode($output);
        }
    }
    function actionTenth()
    {
        if (isset($_POST['status'])) {
            $db = get_connection();

            $d_ID  = $_POST['d_ID'];
            $status  = $_POST['status'];

            $query = "
 UPDATE testdrive SET status = '" . $_POST["status"] . "' WHERE d_ID = '" . $_POST["d_ID"] . "'
 ";
            $statement = $db->query($query);

            echo json_encode($_POST);
        } else if (isset($_POST['visible'])) {
            $db = get_connection();
            if ($_POST['visible'] == 'Enabled') {
                $vis  = $_POST['visible'];

                $query = "
                UPDATE auto SET visible = '" . $_POST["visible"] . "'";
                $statement = $db->query($query);

                echo json_encode($_POST);
            } else if ($_POST['visible'] == 'Disabled') {
                $vis  = $_POST['visible'];

                $query = "
                UPDATE auto SET visible = '" . $_POST["visible"] . "'";
                $statement = $db->query($query);

                echo json_encode($_POST);
            } else {
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

    function actionBlockUser(){
        $output = blockUser();
        if ($output == "0") {
            sendResponse([
                'success' => false
            ]);
        } else {
            sendResponse([
                'success' => true
            ]);
        }
    }

    function actionWithCars()
    {
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
    }

    function testDrive()
    {
        $user = getCoockie("id", "user");
        $where = 'u_ID = ' . $user . '';
        $output = getAllTests($where);
        if ($output['recordsFiltered'] == 0) {
            http_response_code(500);
            echo json_encode($output);
        } else {
            echo json_encode($output);
        }
        exit();
    }

    function actionGetListOfModers()
    {
        $res = getModersList();
        if ($res['result'] == true)
            sendResponse([
                'success' => true,
                'data' => json_encode($res)
            ]);
        else
            sendResponse([
                'success' => false
            ]);
    }

    function actionGetAdminRole()
    {
        $res = getAdminRole();
        if ($res == 1)
            sendResponse([
                'success' => true
            ]);
        else
            sendResponse([
                'success' => false
            ]);
    }

    function actionWithTestDrive()
    {
        if (isAuthorizated()) {
            if (addToTestdrive($_POST['car_ID'], $_POST['date'])) {
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

    function actionGetCarsList()
    {
        $result = getCarsList();

        if ($result->num_rows > 0) {
            $arrDefault = array();
            while ($row = $result->fetch_assoc()) {
                $temp = "" . $row['a_ID'] . " - (" . $row['mark'] . "," . $row['m_model'] . "," . $row['a_color'] . "," . $row['a_year'] . ")";

                $arrDefault[$row['a_ID']] = $temp;
            }
            $arr["IDs"] = $arrDefault;
            sendResponse([
                'success' => true,
                json_encode($arr)
            ]);
        } else {
            sendResponse([
                'success' => false
            ]);
        }
    }

    function actionGetVideosList()
    {
        $result = getVideos($_POST['carID']);

        $arrDefault = array();
        $count = 0;
        $id = null;
        while ($row = $result->fetch_assoc()) {
            $arrDefault[$row['link_ID']] = $row['v_link'];
            $id = $row['auto_ID'];
            $count++;
        }
        $arr["links"] = $arrDefault;
        $arr["count"] = $count;
        $arr["id"] = $id;
        sendResponse([
            'success' => true,
            json_encode($arr)
        ]);
    }

    function actionUpdatePhotos()
    {
        $result = UpdatePhotos();

        if ($result)
            sendResponse([
                'success' => true
            ]);
        else
            sendResponse([
                'success' => false
            ]);
    }

    function actionGetPhotosList()
    {
        $result = getPhotos($_POST['carID']);

        $arrDefault = array(); 
        $count = 0;
        $id = null;
        while ($row = $result->fetch_assoc()) {
            $arrDefault["'".$row['imgID']."'"] = str_replace('images/', '', $row['img']);
            $id = $row['img_a_ID'];
            $count++;
        }
        $arr["links"] = $arrDefault;
        $arr["count"] = $count;
        $arr["id"] = $id;
        sendResponse([
            'success' => true,
            json_encode($arr)
        ]);
    }

    function actionGetListOfUsers(){
        $res = getUsersList();
        if ($res['result'] == true)
            sendResponse([
                'success' => true,
                'data' => json_encode($res)
            ]);
        else
            sendResponse([
                'success' => false
            ]);
    }

    function actionUpdateVideos()
    {
        $result = UpdateVideos();

        if ($result)
            sendResponse([
                'success' => true
            ]);
        else
            sendResponse([
                'success' => false
            ]);
    }

    //switch funtions//
    switch (isset($_POST)) {
        case isset($_POST["blockUser"]):
            actionBlockUser();
            break;
        case isset($_POST["listOfUsers"]):
            actionGetListOfUsers();
            break;
        case isset($_POST["updatePhotos"]):
            actionUpdatePhotos();
            break;
        case isset($_POST["getPhotosList"]):
            actionGetPhotosList();
            break;
        case isset($_POST["updateVideosLinks"]):
            actionUpdateVideos();
            break;
        case isset($_POST["getVideosList"]):
            actionGetVideosList();
            break;
        case isset($_POST["listOfModers"]):
            actionGetListOfModers();
            break;
        case isset($_POST["adminRole"]):
            actionGetAdminRole();
            break;
        case isset($_POST["pass"]):
            actionLogin();
            break;
        case isset($_POST["password"]):
            actionRegister();
            break;
        case isset($_POST["checkAccount"]):
            actionValidate($_POST['role']);
            break;
        case isset($_POST["logout"]):
            logoutFromAccount($_POST['role']);
            break;
        case isset($_POST["need"]):
            actionWithCars();
            break;
        case isset($_POST["testdrive"]):
            testDrive();
            break;
        case isset($_POST["getCarsList"]):
            actionGetCarsList();
            break;
        case isset($_POST["ndtst"]):
            actionWithTestDrive();
            break;
    }

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'fetch_data':
                $lang = (!isset($_SESSION['lang'])) ? "ru" : $_SESSION['lang'];
                filterAuto($lang);
                break;
            case 'getAllTests':
                actionFirst();
                break;
            case 'getAllTests2':
                actionSecond();
                break;
            case 'getVisible':
                actionThird();
                break;
            case 'getAuto':
                actionFourth();
                break;
            case 'getIDs':
                actionFifth();
                break;
            case 'updateU':
                actionSixth();
                break;
            case 'deleteAdm':
                actionSeventh();
                break;
            case 'getBlock':
                actionEighth();
                break;
            case 'getUsers':
                actionNinth();
                break;
            case 'edit':
                actionTenth();
                break;
        }
    }
}
