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
        $c = str_replace("(", "", str_replace(")", "", str_replace("+", "", str_replace(" ", "", $data['phone'])))),
        "d" => "1"
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
    $stmt = mysqli_query($db, $query);
    return $stmt;
}

function getUserByEmail(string $email)
{
    $query = "SELECT * FROM users WHERE u_login = ?";

    $db = get_connection();
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->fetch();

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
    $result = $db->query($query);
    $row = $result -> fetch_assoc();
    return $row;
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
    if ($rowcount == 0) {
        $errors[]['login'] = 'Проверьте правильность данных';
    }
    return $errors;
}

function getCarByID(string $id)
{
    $query = "SELECT * FROM `auto` join images on a_image=imgID join models on a_model=m_id join marks on m_mark_ID=mark_ID where visible = 'Enabled' and a_ID = $id";

    $db = get_connection();
    $stmt = $db->query($query);
    return $row = $stmt->fetch_assoc();
}

function IsUserAdmin()
{
    $user = $_COOKIE['acc'];

    $query = "SELECT * FROM `users` where u_roleID != 'Пользователь' and u_ID = $user";

    $db = get_connection();
    $stmt = $db->query($query);

    if (($stmt->num_rows) > 0)
        return true;
    else
        return false;
}

function login(array $data)
{
    $login = $data['email'];
    $pass = md5($data['pass']);

    $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass'";

    $db = get_connection();
    $stmt = $db->query($query);
    $row = $stmt->fetch_assoc();



    if (isset($data['remember']))
    {
        Setcookie('acc', $row['u_ID'], time() + 2678400, "/");
        setcookie('name', $row['u_name']. ' ' . $row['u_fname'], time() + 2678400, "/");
    }
    else
    {
        Setcookie('acc', $row['u_ID'], 0, "/");
        setcookie('name', $row['u_name']. ' ' . $row['f_name'], 0, "/");
    }

    return $stmt;
}

function logout()
{
    setcookie('acc', null, time() - 9999, "/");
    setcookie('name', null, time() - 9999, "/");
}


function isAuthorizated()
{
    if (isset($_COOKIE['acc']))
        return true;
    else
        return false;
}

function addToFavourite(array $data)
{
    $car = $data['car_ID'];
    $user = $_COOKIE['acc'];

    $query = "INSERT INTO `favourite` (`client_ID`, `auto_ID`) VALUES('$user','$car')";
    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    return $stmt;
}

function removeFromFavourite(array $data)
{
    $car = $data['car_ID'];
    $user = $_COOKIE['acc'];

    $query = "Delete from `favourite` where `auto_ID` = $car and `client_ID` = $user";
    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    return $stmt;
}

function favouriteList()
{
    $user = $_COOKIE['acc'];

    $query = "SELECT * FROM `favourite` WHERE `client_ID` = $user";

    $db = get_connection();
    return $db->query($query);
}

function getCarsList()
{
    $query = "SELECT * FROM `auto` join images on a_image=imgID join models on a_model=m_id join marks on m_mark_ID=mark_ID where visible = 'Enabled'";

    $db = get_connection();
    return $db->query($query);
}

function IsCarFavourite($car_ID)
{
    if (isAuthorizated()) {
        $user = $_COOKIE['acc'];

        $query = "Select * from `favourite` where `auto_ID` = $car_ID and `client_ID` = $user";
        $db = get_connection();
        $stmt = mysqli_query($db, $query);
        $rowcount = $stmt->num_rows;
        if ($rowcount != 0)
            return true;
        else
            return false;
    } else {
        return false;
    }
}

function getTest(array $d, $where)
{
    $db = get_connection();

    $column = array("car_ID", "mark", "m_model", "date", "status");

    $query = "SELECT * FROM testdrive JOIN users on `uid` = u_ID JOIN `auto` on car_ID = a_ID JOIN models on a_model = m_ID JOIN marks on m_mark_ID = mark_ID where $where";
    if (isset($_POST["search"]["value"])) {
        $query .= '  OR (' . $where . ' and (mark LIKE "%' . $_POST["search"]["value"] . '%" OR m_model LIKE "%' . $_POST["search"]["value"] . '%"  OR date LIKE "%' . $_POST["search"]["value"] . '%" ))';
    }

    if (isset($_POST["order"])) {
        $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= 'ORDER BY date DESC ';
    }
    $query1 = '';

    if ($_POST["length"] != -1) {
        $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    $statement = $db->query($query);

    $number_filter_row = $statement->num_rows;

    $statement = $db->query($query . $query1);

    $data = array();

    while ($row = $statement->fetch_assoc()) {
        $sub_array = array();
        $sub_array[] = $row['mark'];
        $sub_array[] = $row['m_model'];
        $sub_array[] = $row['date'];
        $sub_array[] = $row['status'];
        $data[] = $sub_array;
    }

    function count_all_data($conn)
    {
        $query = "SELECT * FROM testdrive";
        $statement = $conn->query($query);
        return $statement->num_rows;
    }

    $output = array(
        'draw'   => intval($_POST['draw']),
        'recordsTotal' => count_all_data($db),
        'recordsFiltered' => $number_filter_row,
        'data'   => $data
    );

    echo json_encode($output);
}
