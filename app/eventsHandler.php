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

        if (empty($error)) {
            $regResponse = register($_POST, $temp);
            if($regResponse)
            {
                $succesmsg = ($temp == "user") ? translateAction("Вы успешно зарегистрированы!") : "Ви успішно додали модератора!";

                sendResponse([
                    'success' => true,
                    'successmsg' => $succesmsg
                ]);
            }
            else {
                sendResponse([
                    'success' => false,
                    'error' => translateAction("Пользователь уже зарегистрирован!")
                ]);
            }          
        }  else {
            foreach($error as $key=>$val)
            {               
                $error[$key]['error'] = translateAction($val["error"]); 
            }          
            sendResponse([
                'success'=>false,
                'errorArr' => $error
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
        $output = getAllTests("status = 'Waiting'",0);
        if ($output['recordsFiltered'] == 0) {
            sendResponse(["success" => false]);
        } else {
            echo json_encode($output);
        }
    }

    function getAllUncommingTest()
    {
        $output = getAllTests("status = 'Success' and isArrived is Null",0);
        if ($output['recordsFiltered'] == 0) {
            sendResponse(["success" => false]);
        } else {
            echo json_encode($output);
        }
    }

    function getAllCommingTest()
    {
        $output = getAllTests("status IN ('Success', 'Denied') and isArrived IN ('Yes', 'No')",0);
        if ($output['recordsFiltered'] == 0) {
            sendResponse(["success" => false]);
        } else {
            echo json_encode($output);
        }
    }

    function getTestForUser()
    {
        $uid = getCoockie("id","user");
        $output = getAllTests("u_ID = ".$uid."",1);
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
        $output = getAllTests("status IN ('Success', 'Denied')",0);
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
            if($output['block']==true)
            {
                sendResponse([
                    'success' => false,
                    'block' => true,
                    'error' => translateAction("Вы уже заказывали тест драйв этой машини!")
                ]);
            }
            else
            {
            $output["eq"] = translateAction("Вы уже заказывали тест драйв этой машини!");
            http_response_code(200);
            echo json_encode($output);
            }
        } else {
            sendResponse([
                'success' => false,
                'block' => true,
                'error' => translateAction("Необходимо быть авторизорованым!")
            ]);
        }
    }

    function actionGetTestsDrive()
    {
        $output = getTestCar($_POST['car_ID']);
        if ($output["block"]) {
            sendResponse([
                'success' => false,
                'error' => 'Цей юзер вже замовив тест-драйв цього авто!'
            ]);
        } else {
            sendResponse([
                'success' => true,
                'data' => $output
            ]);
        }
    }

    function actionAllGetTestsDrive()
    {
        $output = getTestCar($_POST['car_ID']);
        sendResponse([
            'success' => true,
            'data' => $output
        ]);
    }

    function actionNinth()
    {
        $output = getUsers("1");
        if ($output['recordsFiltered'] == 0) {
            http_response_code(500);
            echo json_encode($output);
        } else {
            echo json_encode($output);
        }
    }
    function actionGetModers()
    {
        $output = getModers();
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
 UPDATE testdrive SET status = '" . $status . "' WHERE d_ID = '" .  $d_ID . "'
 ";

            $statement = $db->query($query);

            echo json_encode($_POST);
        } else if (isset($_POST['visible'])) {
            $db = get_connection();
            if (isset($_POST['ID'])) {
                $d_ID  = $_POST['ID'];
                $vis  = $_POST['visible'];

                $query = "
                UPDATE auto SET visible = '" . $vis . "' WHERE a_ID = '" . $d_ID . "'
                ";
                $statement = $db->query($query);

                if (mysqli_affected_rows($db) == 1)
                    sendResponse(
                        ['success' => true]
                    );
                else sendResponse([
                    'success' => false
                ]);
            } else if ($_POST['visible'] == 'Enabled') {
                $vis  = $_POST['visible'];

                $query = "
                UPDATE auto SET visible = '" . $vis . "'";
                $statement = $db->query($query);

                echo json_encode($_POST);
            } else if ($_POST['visible'] == 'Disabled') {
                $vis  = $_POST['visible'];

                $query = "
                UPDATE auto SET visible = '" . $vis . "'";
                $statement = $db->query($query);

                echo json_encode($_POST);
            }
           
         } else if (isset($_POST['isarrived'])) {
            $db = get_connection();
            $d_ID  = $_POST['ID'];
            $vis  = $_POST['isarrived'];

            $query = "
            UPDATE testdrive SET isArrived = '" . $vis . "' WHERE d_ID = '" . $d_ID . "'
            ";

            $statement = $db->query($query);

            if (mysqli_affected_rows($db) == 1)
                sendResponse(
                    ['success' => true]
                );
            else sendResponse([
                'success' => false
            ]);
        }
        else if (isset($_POST['price'])) {
            $db = get_connection();

            $vis  = $_POST['ID'];
            $price = $_POST['price'];

            $query = "
            UPDATE auto SET t_price = '" . $price . "' where a_ID = '".$vis."'";
            $statement = $db->query($query);

            if (mysqli_affected_rows($db) == 1)
            sendResponse(
                ['success' => true]
            );
        else sendResponse([
            'success' => false
        ]);}
        else if (isset($_POST['date'])) {
            $db = get_connection();
            $id  = $_POST['id'];
            $date = $_POST['date'];

            $query = "
            UPDATE testdrive SET date = '" . $date . "' WHERE d_ID = '" . $id . "'
            ";

            $statement = $db->query($query);

            if (mysqli_affected_rows($db) == 1)
                sendResponse(
                    ['success' => true]
                );
            else sendResponse([
                'success' => false
            ]);
        }
    }

    function actionGetMarkModelsList()
    {
        $result = getMarkModelsList();
        if ($result["success"]) {
            sendResponse([
                'success' => true,
                'data' => $result['data']
            ]);
        } else {
            sendResponse([
                'success' => false,
                'error' => $result['error']
            ]);
        }
    }

    function actionBlockUser()
    {
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
        if (isAuthorizated() == true) {
            
            if (addToTestdrive($_POST['car_ID'], $_POST['date'])) {
                sendResponse([
                    'success' => true,
                    'successmsg' => translateAction("Вы успешно добавили машину! С вами свяжется наш сотрудник.")
                ]);
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
            $arrDefault["'" . $row['imgID'] . "'"] = str_replace('images/', '', $row['img']);
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

    function actionGetListOfUsers()
    {
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

    function actionCreateTestDrive()
    {
        if (addToTestdrive($_POST['car_ID'], $_POST['date'])) {
            sendResponse([
                'success' => true
            ]);
        } else {
            sendResponse([
                'success' => false
            ]);
        }
    }

    function actionRegNewUser()
    {
        $result = registerNewUser();
        if ($result["success"] == true)
            sendResponse([
                'success' => true,
                'data' => $result['id']
            ]);
        else if (isset($result["id"])) {
            sendResponse([
                'success' => true,
                'data' => $result['id']
            ]);
        } else {
            $data = $result["error"] == "" ? "null" : $result["error"];
            sendResponse([
                'success' => false,
                'data' => $data
            ]);
        }
    }

    function actionRegisterNewCar()
    {
        $result = registerNewCar();

        if ($result['success']) {
            sendResponse([
                'success' => true
            ]);
        } else {
            sendResponse([
                'success' => false,
                'error' => $result['error']
            ]);
        }
    }

    function actionGetBlockedUsers(){
        $output = getUsers("2");
        if ($output['recordsFiltered'] == 0) {
            http_response_code(500);
            echo json_encode($output);
        } else {
            echo json_encode($output);
        }
    }

    function actionGetImageSize()
    {
        $data = getimagesize("../images/" . $_POST['image']);
        if ($data[0] > 1025)
            sendResponse([
                "success" => false
            ]);
        else if ($data[1] > 1025)
            sendResponse([
                "success" => false
            ]);
        else if ($data[1] >= $data[0])
            sendResponse([
                "success" => false
            ]);
        else
        if (($data[0] - $data[1]) > 660)
            sendResponse([
                "success" => false
            ]);
        else
            sendResponse([
                "success" => true
            ]);
    }

    function actionGetTest()
    {
        $result = getTestDrives();

        if ($result['success']) {
            sendResponse([
                'success' => true,
                "data" => $result
            ]);
        } else {
            sendResponse([
                'success' => false
            ]);
        }
    }

    function actionGetFiltred(){
        $output = FilterCars();
        sendResponse([
            "success"=>true,
            "html"=>$output
        ]);
    }



    //switch funtions//
    switch (isset($_POST)) {
        case isset($_POST["getTestDrive"]):
            actionGetTest();
            break;
        case isset($_POST["getImageSize"]):
            actionGetImageSize();
            break;
        case isset($_POST["registerNewCar"]):
            actionRegisterNewCar();
            break;
        case isset($_POST["getMarksModels"]):
            actionGetMarkModelsList();
            break;
        case isset($_POST["createnNewTest"]):
            actionCreateTestDrive();
            break;
        case isset($_POST["registerNewUser"]):
            actionRegNewUser();
            break;
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
        case isset($_POST["getCarsList"]):
            actionGetCarsList();
            break;
        case isset($_POST["mytest"]):
            actionWithTestDrive();
            break;
    }

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'fetch_data':
                $lang = (!isset($_SESSION['lang'])) ? "ru" : $_SESSION['lang'];
                filterAuto($lang);
                break;
            case 'getFiltred':
                actionGetFiltred();
                break;
            case 'getAllTests':
                actionFirst();
                break;
            case 'getAllTests2':
                actionSecond();
                break;
            case 'getAllTests3':
                getAllUncommingTest();
                break;
            case 'getAllTests4':
                getAllCommingTest();
                break;
                case 'getAllTests5':
                    getTestForUser();
                    break;
            case 'getVisible':
                actionThird();
                break;
            case 'getAuto':
                actionFourth();
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
            case 'getBlockA':
                actionGetTestsDrive();
                break;
            case 'getBlockB':
                actionAllGetTestsDrive();
                break;
            case 'getUsers':
                actionNinth();
                break;
                case 'getBlockedUsers':
                    actionGetBlockedUsers();
                    break;
                case 'getModers':
                    actionGetModers();
                    break;
            case 'edit':
                actionTenth();
                break;
        }
    }
}
