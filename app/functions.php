<?php

include 'db.php';

//ENCRYPT TEXT
function encrypt (string $word)
{
  
// Store the cipher method 
$ciphering = "AES-128-CTR"; 
  
// Use OpenSSl Encryption method 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
  
// Non-NULL Initialization Vector for encryption 
$encryption_iv = '1234567891011121'; 
  
// Store the encryption key 
$encryption_key = "lJ2jKKmGPk"; 
  
// Use openssl_encrypt() function to encrypt the data 
$encryption = openssl_encrypt($word, $ciphering, 
            $encryption_key, $options, $encryption_iv); 
  

return $encryption;
}

//DECRYPT TEXT
function decrypt($word)
{
    // Non-NULL Initialization Vector for decryption 
$decryption_iv = '1234567891011121'; 
  
// Store the cipher method 
$ciphering = "AES-128-CTR"; 

// Store the decryption key 
$decryption_key = "lJ2jKKmGPk"; 
  
$options = 0; 

// Use openssl_decrypt() function to decrypt the data 
$decryption=openssl_decrypt ($word, $ciphering,  
        $decryption_key, $options, $decryption_iv); 
  
return $decryption;
}

function register(array $data)
{
    $values = [
        $data['email'],
        $pass = encrypt($data['password']),
        $data['name'],
        $data['secondname'],
        $data['radi1'],
        $c = str_replace("(", "", str_replace(")", "", str_replace("+", "", str_replace(" ", "", $data['phone'])))),
        "d" => "1"
    ];

    return insert($values);
}


function insert(array $data)
{
    $query = "INSERT INTO `users` (u_login, u_pass, u_name, u_fname, u_sex, u_phone, u_roleID) VALUES('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', 'Пользователь')";
    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    return $stmt;
}

function login(array $data)
{
    $login = $data['email'];
    $pass = encrypt($data['pass']);

    $query="";

    if(isset($_POST['loginAdmin']))
    $query = "SELECT * FROM `admins` WHERE `adm_LOG` = '$login' and `adm_PASS` = '$pass'";
    else
    $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass'";

    $db = get_connection();
    $stmt = $db->query($query);
    $row = $stmt->fetch_assoc();
    if($stmt->num_rows > 0)
    {
    if(isset($_POST['loginAdmin']) && $row)
    {
        $arr = array("id"=>encrypt(($row['adm_ID'])), "role" => $row['adm_ROLE']);
        if (isset($data['remember']))
        {
            setcookie('accADM', json_encode($arr), time() + 2678400, "/");
        }
        else
        {
            setcookie('accAdm', json_encode($arr), 0, "/");
        }
    }else
    {
        $arr = array("id"=>encrypt($row['u_ID']), "name"=>$row['u_name']. ' ' . $row['u_fname']);
        if (isset($data['remember']))
        {
            setcookie('acc', json_encode($arr), time() + 2678400, "/");
        }
        else
        {
            Setcookie('acc', json_encode($arr), 0, "/");
        }
    }
}

    return $stmt;
}

function logout()
{
    if(isset($_COOKIE['accAdm']))
    {
    setcookie('accAdm', null, time() - 9999, "/");
    }
    else
    {
    setcookie('acc', null, time() - 9999, "/");
    }
}

function validate(array $request)
{
    $errors = "";

    if (isEmailAlreadyExists($request['email']))
        $errors = 'Email уже используется!';

    return $errors;
}

function validateLogin(array $login)
{
    $errors = "";

    if(isUserHasBeenBlock($login['email']))
    $errors = 'Этот email был заблокирован';

    return $errors;
}

function isEmailAlreadyExists(string $email)
{
    $query = "SELECT * FROM users WHERE u_login = '$email'";

    $db = get_connection();

    $result = $db->query($query);

    if ($result)
    return $result;
    else
    return false;
}

function isUserHasBeenBlock(string $email)
{
    $query = "SELECT u_login FROM `blacklist` join users on blacklist.u_ID = users.u_ID WHERE u_login = '$email'";

    $db = get_connection();

    $result = $db -> query($query);

    if($result)
    return $result;
    else
    return false;
}

function validateAccount()
{
    $errors = "";
    if(isset($_COOKIE['acc']))
    {
        if(!wrongCoockie($_COOKIE['acc']))
        {
            $errors = 'Ваш ID не корректный!';
            logout();
        }
    }

    return $errors;
}

function validateTest(string $id)
{
    $coockie = json_decode($_COOKIE['acc'],true);
    $user = decrypt($coockie['id']);

    $query = "SELECT * FROM `testdrive` WHERE `uid` = $user and `car_ID` = $id and status != 'Denied'";

    $db = get_connection();
    $result = $db->query($query);
    if($result->num_rows > 0)
    return false;
    else
    return true;
}

function wrongCoockie(string $coockie)
{
    if (!getAboutUser()) {
        return false;
    }

    return true;
}


function isAuthorizated()
{
    if (isset($_COOKIE['acc']))
    {
        if(!getAboutUser())
        return false;
        else 
        return true;
    }
    else
        return false;
}

function getUsersList($where)
{
    if(!$where)
    $query = "SELECT * FROM `users` ORDER BY `u_ID` DESC";
    else if($where == 1)
    $query = "SELECT * FROM `users` where u_roleID = 'Пользователь' ORDER BY `u_ID` DESC";
    else if($where == 2)
    $query = "SELECT * FROM `users` where u_roleID = 'Администратор' ORDER BY `u_ID` DESC";

    $db = get_connection();
    return $db->query($query);
}

function getAboutUser()
{
    $coockie = json_decode($_COOKIE['acc'],true);
    $user = decrypt($coockie['id']);

    $query = "SELECT `u_ID`,`u_login`,`u_name`,`u_fname`,(SELECT COUNT(d_ID) FROM testdrive WHERE uid=$user) as `test`, (SELECT COUNT(client_ID) FROM favourite WHERE client_ID=$user) as `fav` FROM `users` join testdrive on `u_ID` = `uid` join favourite on u_ID = client_ID WHERE `u_ID` = $user GROUP BY u_ID";

    $db = get_connection();
    $result = $db->query($query);

    if($result)
    {
        return $row = $result -> fetch_assoc();
    }       
    else
        return false;
    
}

function checkUser(array $data)
{
    $errors = "";

    $login = $data['email'];
    $pass = encrypt($data['pass']);
    
    $query="";

    if(isset($_POST['loginAdmin']))
    $query = "SELECT * FROM `admins` WHERE `adm_LOG` = '$login' and `adm_PASS` = '$pass'";
    else
    $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass'";

    $db = get_connection();
    $stmt = $db->query($query);
    if ($stmt -> num_rows < 1) {
        $errors = 'Проверьте правильность данных!';
    }
    else
    {
        if(!isset($_POST['loginAdmin']))
        {
        if(isUserHasBeenBlock($login))
        $errors = 'Ваш email был заблокирован!';
        }
    }

    return $errors;
}

function getCarByID(string $id)
{
    $query = "SELECT * FROM `auto` join images on img_a_ID = a_ID join models on a_model=m_id join marks on m_mark_ID=mark_ID join a_equipment on m_equip = e_ID where visible = 'Enabled' and a_ID = $id and isMain = 'True'";

    $db = get_connection();
    $stmt = $db->query($query);
    if($stmt->num_rows < 1)
    return false;
    else
    return $row = $stmt->fetch_assoc();
}

function getImagesAuto(string $id)
{
    $query = "SELECT * FROM `images` where img_a_ID = $id";

    $db = get_connection();
    $stmt = $db->query($query);

    return $stmt;
}

function getColors(string $year,string $model)
{
    $query = "SELECT * FROM `auto` where a_model = $model and a_year = $year";

    $db = get_connection();
    $stmt = $db->query($query);

    return $stmt;
}

function getTestCar($car)
{
    $query = "SELECT `date`, `uid` FROM `testdrive` where car_ID = $car and status != 'Denied'";

    $db = get_connection();
    $stmt = $db->query($query);

    $arr = array();
    $res = false;
    if (($stmt->num_rows) > 0)
    {              
            $test = array();
            while($row = $stmt->fetch_assoc())
            {
                if($row['uid']==decrypt($_COOKIE['acc']))
                $res = true;

                $test[] = $row["date"];              
            }
            $arr["dates"] = $test;
    }

    $query = "select t_price from auto where a_ID = $car";
    $stmt = $db->query($query);
    $row = $stmt->fetch_assoc();
    $arr["tprice"] = $row["t_price"];
    $arr["block"] = $res;
    return $arr;
}

function addToFavourite(array $data)
{
    $car = $data['car_ID'];
    $user = decrypt($_COOKIE['acc']);

    $query = "INSERT INTO `favourite` (`client_ID`, `auto_ID`) VALUES('$user','$car')";
    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    return $stmt;
}

function removeFromFavourite(array $data)
{
    $car = $data['car_ID'];
    $user = decrypt($_COOKIE['acc']);

    $query = "Delete from `favourite` where `auto_ID` = $car and `client_ID` = $user";
    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    return $stmt;
}

function addToTestdrive(string $id, string $date)
{
    if(validateTest($id))
    {
    $coockie = json_decode($_COOKIE['acc'],true);
    $user = decrypt($coockie['id']);

    $query = "INSERT INTO `testdrive` (`uid`, `car_ID`,`status`,`date`) VALUES($user,$id, 'Waiting', '$date')";
    $db = get_connection();
    $stmt = $db -> query($query);
    return $stmt;
    }
    else
    {
        return false;
    }
}

function favouriteList()
{
    $coockie = json_decode($_COOKIE['acc'],true);
    $user = decrypt($coockie['id']);

    $query = "SELECT * FROM `favourite` WHERE `client_ID` = $user";

    $db = get_connection();
    return $db->query($query);
}

function getVideos(string $id)
{
    $query = "SELECT * FROM `videos` WHERE `auto_ID` = $id";

    $db = get_connection();
    return $db->query($query);
}

function getCarsList()
{
    $query = "SELECT * FROM `auto` join images on img_a_ID=a_ID join models on a_model=m_id join marks on m_mark_ID=mark_ID where visible = 'Enabled' and isMain = 'True'";

    $db = get_connection();
    return $db->query($query);
}

function IsCarFavourite($car_ID)
{
    if (isAuthorizated()) {
        $coockie = json_decode($_COOKIE['acc'],true);
        $user = decrypt($coockie['id']);

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

function getStats()
{
    $query = "Select COUNT(a_ID) as `cars`, 
    (SELECT COUNT(d_ID) FROM testdrive where status = 'Waiting') as `requests`, 
    (SELECT COUNT(d_ID) FROM testdrive) as `alldreq` from auto";

        $db = get_connection();
        $stmt = mysqli_query($db, $query);
        
        $rowcount = $stmt->num_rows;
        if($rowcount>0)
        return $stmt->fetch_assoc();
        else
        return false;
}

function updateUser($id)
{
    $query = "Update users set u_roleID = 'Администратор' where u_ID = $id";

        $db = get_connection();
        $stmt = mysqli_query($db, $query);
        if(mysqli_affected_rows($db) > 0)
        return "1";
        else
        return "0";
}

function deleteUser($id)
{
    $query = "Delete from users where u_ID = $id";

        $db = get_connection();
        $stmt = mysqli_query($db, $query);
        if(mysqli_affected_rows($db) > 0)
        return "1";
        else
        return "0";
}

function getAllTests($where)
{
$db = get_connection();

$column = array("d_ID","u_fname","u_name" , "car_ID" ,"mark", "m_model", "date", "status");

$query = "SELECT * FROM testdrive JOIN users on `uid` = u_ID JOIN `auto` on car_ID = a_ID JOIN models on a_model = m_ID JOIN marks on m_mark_ID = mark_ID where $where";
if(isset($_POST["search"]["value"]))
{
 $query .= '  OR ('.$where.' and (u_name LIKE "%'.$_POST["search"]["value"].'%"  OR u_fname LIKE "%'.$_POST["search"]["value"].'%"  OR mark LIKE "%'.$_POST["search"]["value"].'%" OR m_model LIKE "%'.$_POST["search"]["value"].'%"  OR date LIKE "%'.$_POST["search"]["value"].'%" ))';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY d_ID ASC ';
}
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->query($query);

$number_filter_row = $statement->num_rows;

$statement = $db->query($query . $query1);

$data = array();

while($row = $statement->fetch_assoc()){
    $sub_array = array();
    $sub_array[] = $row["d_ID"];
    $sub_array[] = $row['u_fname'];
    $sub_array[] = $row['u_name'];
    $sub_array[] = $row['car_ID'];
    $sub_array[] = $row['mark'];
    $sub_array[] = $row['m_model'];
    $sub_array[] = $row['date'];
    $sub_array[] = $row['status'];
    $data[] = $sub_array;
}

return $output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data($db, "testdrive"),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);

}

function getVisible()
{
$db = get_connection();

//$column = array("a_ID","img", "mark", "m_model", "visible");

$column = array("a_ID","img", "visible");

$query = "SELECT * FROM auto join images on img_a_ID = a_ID join models on a_model=m_id join marks on m_mark_ID = mark_ID where isMain = 'True'";

if(isset($_POST["search"]["value"]))
{
 $query .= ' and (mark LIKE "%'.$_POST["search"]["value"].'%"  OR m_model LIKE "%'.$_POST["search"]["value"].'%") ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY a_ID ASC ';
}
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->query($query);
$number_filter_row = $statement->num_rows;

$statement = $db->query($query . $query1);

$data = array();

while($row = $statement->fetch_assoc()){
    $sub_array = array();
    $sub_array[] = $row["a_ID"];
    $sub_array[] = "<img class='center' src = ../".$row['img']." width = '250px'>";
   // $sub_array[] = $row['mark'];
   // $sub_array[] = $row['m_model'];
    $sub_array[] = $row['visible'];
    $data[] = $sub_array;
}

$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data($db, "auto"),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);

return $output;
}

function getUsers($where = "u_roleID = 'Пользователь'")
{
$db = get_connection();

$column = array("u_ID", "u_name", "u_fname", "u_login", "u_pass", "u_phone","u_sex","u_roleID");

$query = "SELECT * FROM users where $where";

if(isset($_POST["search"]["value"]))
{
 $query .= ' OR ('.$where.' and (u_name LIKE "%'.$_POST["search"]["value"].'%"  OR u_fname LIKE "%'.$_POST["search"]["value"].'%"  OR u_sex LIKE "%'.$_POST["search"]["value"].'%" OR u_phone LIKE "%'.$_POST["search"]["value"].'%"  OR u_login LIKE "%'.$_POST["search"]["value"].'%" OR u_roleID LIKE "%'.$_POST["search"]["value"].'%" ))';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY u_ID ASC ';
}
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->query($query);

$number_filter_row = $statement->num_rows;

$statement = $db->query($query . $query1);

$data = array();

while($row = $statement->fetch_assoc()){
    $sub_array = array();
    $sub_array[] = $row["u_ID"];
    $sub_array[] = $row['u_name'];
    $sub_array[] = $row['u_fname'];
    $sub_array[] = $row['u_login'];
    $sub_array[] = decrypt($row['u_pass']);
    $sub_array[] = $row['u_phone'];
    $sub_array[] = $row['u_sex'];
    $sub_array[] = $row['u_roleID'];
    $data[] = $sub_array;
}

$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data($db, "users"),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);

return $output;
}

function getAuto($where = "isMain = 'True'")
{
    $db = get_connection();

    $column = array("a_ID","img", "mark", "m_model", "a_color","a_year","a_count");

$query = "SELECT * FROM auto join images on img_a_ID = a_ID join models on a_model=m_id join marks on m_mark_ID = mark_ID where $where";

if(isset($_POST["search"]["value"]))
{
 $query .= ' OR ('.$where.' and (mark LIKE "%'.$_POST["search"]["value"].'%"  OR m_model LIKE "%'.$_POST["search"]["value"].'%"  OR a_color LIKE "%'.$_POST["search"]["value"].'%" OR a_year LIKE "%'.$_POST["search"]["value"].'%" OR a_count LIKE "%'.$_POST["search"]["value"].'%"))';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY a_ID ASC ';
}
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $db->query($query);
$number_filter_row = $statement->num_rows;

$statement = $db->query($query . $query1);

$data = array();

while($row = $statement->fetch_assoc()){
    $sub_array = array();
    $sub_array[] = $row["a_ID"];
    $sub_array[] = "<img class='center' src = ../".$row['img']." width = '150px'>";
    $sub_array[] = $row['mark'];
    $sub_array[] = $row['m_model'];
    $sub_array[] = $row['a_color'];
    $sub_array[] = $row['a_year'];
    $sub_array[] = $row['a_count'];
    $data[] = $sub_array;
}

    return $output = array(
        'draw'   => intval($_POST['draw']),
        'recordsTotal' => count_all_data($db, "auto"),
        'recordsFiltered' => $number_filter_row,
        'data'   => $data
    );
}

function count_all_data($conn, $from)
{
    $query = "SELECT * FROM ". $from;
    $statement = $conn->query($query);
    return $statement->num_rows;
}
