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