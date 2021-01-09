<?php

include 'db.php';

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

function validate(array $request)
{
    $errors = "";

    if (isEmailAlreadyExists($request['email']))
        $errors = 'Email уже используется!';

    return $errors;
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
    $user = decrypt($_COOKIE['acc']);

    $query = "SELECT * FROM `testdrive` WHERE `uid` = $user and `car_ID` = $id";

    $db = get_connection();
    $result = $db->query($query);
    if($result)
    return false;
    else
    return true;
}

function wrongCoockie(string $coockie)
{
    if (!getAboutUser($coockie)) {
        return false;
    }

    return true;
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
    $query = "INSERT INTO `users` (u_login, u_pass, u_name, u_fname, u_sex, u_phone, u_roleID) VALUES('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', 'Пользователь')";
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
    $user = decrypt($_COOKIE['acc']);

    $query = "SELECT `u_ID`,`u_login`,`u_name`,`u_fname`,(SELECT COUNT(d_ID) FROM testdrive WHERE uid=$user) as `test`, `viewCount`, (SELECT COUNT(client_ID) FROM favourite WHERE client_ID=$user) as `fav` FROM `users` join views on `u_ID`=`viewUser` join testdrive on `u_ID` = `uid` join favourite on u_ID = client_ID WHERE `u_ID` = $user GROUP BY u_ID";

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
    $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass' and u_roleID != 'Пользователь'";
    else
    $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass'";

    $db = get_connection();
    $stmt = $db->query($query);
    if ($stmt -> num_rows < 1) {
        $errors = 'Проверьте правильность данных!';
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

function IsUserAdmin()
{
    $user = decrypt($_COOKIE['acc']);

    $query = "SELECT * FROM `users` where u_roleID != 'Пользователь' and u_ID = $user";

    $db = get_connection();
    $stmt = $db->query($query);

    if (($stmt->num_rows) > 0)
        return true;
    else
        return false;
}

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

function login(array $data)
{
    $login = $data['email'];
    $pass = encrypt($data['pass']);

    $query="";

    if(isset($_POST['loginAdmin']))
    $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass' and u_roleID != 'Пользователь'";
    else
    $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass'";

    $db = get_connection();
    $stmt = $db->query($query);
    $row = $stmt->fetch_assoc();

    if(isset($_POST['loginAdmin']))
    {
        if (isset($data['remember']))
        {
            Setcookie('accAdm', encrypt($row['u_ID']), time() + 2678400, "/");
        }
        else
        {
            Setcookie('accAdm', encrypt($row['u_ID']), 0, "/");
        }
    }else
    {
        if (isset($data['remember']))
        {
            Setcookie('acc', encrypt($row['u_ID']), time() + 2678400, "/");
            setcookie('name', $row['u_name']. ' ' . $row['u_fname'], time() + 2678400, "/");
        }
        else
        {
            Setcookie('acc', encrypt($row['u_ID']), 0, "/");
            setcookie('name', $row['u_name']. ' ' . $row['u_fname'], 0, "/");
        }
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
    $user = decrypt($_COOKIE['acc']);

    $query = "INSERT INTO `favourite` (`client_ID`, `auto_ID`) VALUES('$user','$car')";
    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    return $stmt;
}

function addLookCount(){

    $user = decrypt($_COOKIE['acc']);

    $db = get_connection();

    $query = "Select * From `views` where `viewUser` = $user";
    $stmt = $db -> query($query);

    if($stmt->num_rows == 0)
    {
        $query = "INSERT INTO `views` (`viewUser`, `viewCount`) VALUES('$user','0')";
        $stmt = mysqli_query($db, $query);
    }

    $query = "Update `views` set `viewCount` = `viewCount` + 1 where `viewUser` = $user";
    
    $stmt = mysqli_query($db, $query);
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

function addToTestdrive(string $id)
{
    if(validateTest($id))
    {
    $user = decrypt($_COOKIE['acc']);

    $query = "INSERT INTO `testdrive` (`uid`, `car_ID`,`status`,`date`) VALUES($user,$id, 'Waiting', CURDATE())";
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
    $user = decrypt($_COOKIE['acc']);

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
        $user = decrypt($_COOKIE['acc']);

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

function count_all_data_test($conn)
{
 $query = "SELECT * FROM testdrive";
 $statement = $conn->query($query);
 return $statement->num_rows;
}

return $output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data_test($db),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);

}

function getVisible()
{
$db = get_connection();

$column = array("a_ID","img", "mark", "m_model", "visible");

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
    $sub_array[] = "<img src = ../".$row['img']." width = '150px'>";
    $sub_array[] = $row['mark'];
    $sub_array[] = $row['m_model'];
    $sub_array[] = $row['visible'];
    $data[] = $sub_array;
}

function count_all_data_vis($db)
{
 $query = "SELECT * FROM auto";
 $statement = $db->query($query);
 return $statement->num_rows;
}

$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data_vis($db),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);

return $output;
}

function getTest($where)
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
