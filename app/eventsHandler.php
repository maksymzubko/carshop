<?php

function is_session_started()
{
    if (php_sapi_name() !== 'cli') {
        if (version_compare(phpversion(), '5.4.0', '>=')) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
if (is_session_started() === FALSE) session_start();

include 'functions.php';

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

if (!empty($_POST)) {
    header('Content-Type: application/json');

    if (isset($_POST['pass'])) {
        $errors = checkUser($_POST);

        if (empty($errors)) {
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
            'errors' => $errors
        ]);

        exit();
    } else if (isset($_POST['logout'])) {
        logout();
        http_response_code(201);
        echo json_encode([
            'success' => true
        ]);
        exit();
    } else if (isset($_POST['need'])) {
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
    } else if (isset($_POST['testdrive'])) {
        $user = $_COOKIE['acc'];
        $where = 'u_ID = ' . $user . '';
        getTest(array('need' => 'yes'), $where);
        exit();
    } else {
        $errors = validate($_POST);

        if (empty($errors)) {
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
            'errors' => $errors
        ]);

        exit();
    }
}
?>