<?php

include 'db.php';

function register(array $data)
{
    $values = [                           
        $data['email'],
        $pass = md5($data['password']),
        $data['name'],
        $data['secondname'],
        $data['radi1'],
        $c = str_replace("(","",str_replace(")","",str_replace("+","",str_replace(" ", "", $data['phone'])))),
        "d"=>"1"
    ];

    return insert($values);
}

function validate(array $request)
{
    $errors = [];

    if (isEmailAlreadyExists($request['email'])) {
        $errors[]['email'] = 'Email уже используется';
    }
    
    return $errors;
}

function isEmailAlreadyExists(string $email)
{
    if (getUserByEmail($email)) {
        return true;
    }

    return false;
}

function insert(array $data)
{
    $query = "INSERT INTO `users` (u_login, u_pass, u_name, u_fname, u_sex, u_phone, u_roleID) VALUES('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '1')";
    $db = get_connection();
    $stmt = mysqli_query($db,$query);
    return $stmt;
}

function getUserByEmail(string $email)
{
    $query = "SELECT * FROM users WHERE u_login = ?";

    $db = get_connection();
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt -> fetch();

    if ($result) {
        return $result;
    }

    return false;
}

function getUsersList()
{
    $query = "SELECT * FROM `users` ORDER BY `u_ID` DESC";

    $db = get_connection();
    return $db->query($query);
}

function getAboutUser()
{
    $user = $_COOKIE['acc'];

    $query = "SELECT * FROM `users` WHERE `u_ID` = $user";

    $db = get_connection();
    return $db->query($query);
}

function checkUser(array $data)
{
    $errors = [];

    $login = $data['email'];
    $pass = md5($data['pass']);

    $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass'";

    $db = get_connection();
    $stmt = $db->query($query);
    $rowcount = $stmt->num_rows;
    if ($rowcount==0) 
    {
        $errors[]['login'] = 'Проверьте правильность данных';     
    }
    return $errors;
}

function login(array $data)
{
    $login = $data['email'];
    $pass = md5($data['pass']);

    $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass'";

    $db = get_connection();
    $stmt = $db->query($query);
    $row=$stmt->fetch_assoc();

        if(isset($data['remember']))
        Setcookie('acc',$row['u_ID'],time()+2678400,"/");
        else
        Setcookie('acc',$row['u_ID'],0,"/");

    return $stmt;
}

function logout()
{
    setcookie('acc',null, time()-9999, "/");
}

function addToFavourite(array $data)
{
    $car = $data['car_ID'];
    $user = $_COOKIE['acc'];

    $query = "INSERT INTO `favourite` (`client_ID`, `auto_ID`) VALUES('$user','$car')";
    $db = get_connection();
    $stmt = mysqli_query($db,$query);
    return $stmt;
}

function removeFromFavourite(array $data)
{
    $car = $data['car_ID'];
    $user = $_COOKIE['acc'];

    $query = "Delete from `favourite` where `auto_ID` = $car and `client_ID` = $user";
    $db = get_connection();
    $stmt = mysqli_query($db,$query);
    return $stmt;
}

function favouriteList()
{
    $user = $_COOKIE['acc'];

    $query = "SELECT * FROM `favourite` WHERE `client_ID` = $user";

    $db = get_connection();
    return $db->query($query);
}