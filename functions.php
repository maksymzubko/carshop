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

function getAboutUser(string $id)
{
    $query = "SELECT * FROM `users` WHERE `u_ID` = $id";

    $db = get_connection();
    return $db->query($query);
}