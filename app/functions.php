<?php

include 'db.php';

//ENCRYPT TEXT
function encrypt(string $word)
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
    $encryption = openssl_encrypt(
        $word,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );


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
    $decryption = openssl_decrypt(
        $word,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );

    return $decryption;
}

function getCoockie(string $entity, string $role)
{
    $admin = isset($_COOKIE['accAdm']) ? json_decode($_COOKIE['accAdm'], true) : null;
    $user = isset($_COOKIE['acc']) ? json_decode($_COOKIE['acc'], true) : null;

    return ($role == "user") ? ($entity == "name" ?  $user['name'] : decrypt($user['id'])) : decrypt($admin['id']);
}

//filter
function filterAuto(string $lang)
{
    require_once '../languages/translater.php';
    require "../languages/" . $lang . ".php";

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
}

//REGISTER
function register(array $data, string $role)
{
    $values = array();

    if ($role == "user")
    {      
        $values = [
            $data['email'],
            encrypt($data['password']),
            $data['name'],
            $data['secondname'],
            $data['radi1'],
            $c = $data['phone'],
            "d" => "1"
        ];

    }      
    else
        $values = [
            $data['login'],
            encrypt($data['password']),
            $data['number']
        ];
    
    function insert(array $data, string $role )
    {
        if ($role == "user") {
            $response = isUserAlreadyExist($data[2],$data[3],$data[5]);
            function ifEmptyEmail($id)
            {
                $query = "Select u_login from users where u_ID = $id";
                $db=get_connection();
                
                $result = $db->query($query);
                $row = $result->fetch_assoc();
                if($row['u_login']==null)
                return true;
                else
                return false;
            }
            if(isset($response["id"]))
            {
                $id = $response["id"];
                if(ifEmptyEmail($id))
                $query = "Update users set u_login = '$data[0]', u_pass='$data[1]',u_sex = '$data[4]' where u_ID = $id";
                else
                return;
            }
            else
            $query = "INSERT INTO `users` (u_login, u_pass, u_name, u_fname, u_sex, u_phone) VALUES('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]')";

            $db = get_connection();
            $stmt = mysqli_query($db, $query);
            return $stmt;
        } else {
            $query = "INSERT INTO `admins` (adm_UNI, adm_LOG, adm_PASS, adm_ROLE) VALUES('$data[0]', '$data[1]', '$data[2]', 'Moder')";
            $db = get_connection();
            $stmt = mysqli_query($db, $query);
            return $stmt;
        }
    }

    return insert($values, $role);
}

//LOGIN
function login(array $data)
{
    $login = $data['email'];
    $pass = encrypt($data['pass']);

    $query = "";

    if (isset($_POST['role']))
        $query = "SELECT * FROM `admins` WHERE `adm_LOG` = '$login' and `adm_PASS` = '$pass'";
    else
        $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass'";

    $db = get_connection();
    $stmt = $db->query($query);
    if ($stmt->num_rows > 0) {
        $row = $stmt->fetch_assoc();
        if (isset($_POST['role']) && $row) {
            $arr = array("id" => encrypt(($row['adm_ID'])), "role" => $row['adm_ROLE']);
            setcookie('accAdm', json_encode($arr), 0, "/");
        } else {
            $arr = array("id" => encrypt($row['u_ID']), "name" => $row['u_name'] . ' ' . $row['u_fname']);
            if (isset($data['remember'])) {
                setcookie('acc', json_encode($arr), time() + 2678400, "/");
            } else {
                setcookie('acc', json_encode($arr), 0, "/");
            }
        }
    }

    return $stmt;
}

function logout($from)
{
    return ($from == "user") ? setcookie('acc', null, time() - 9999, "/") :  setcookie('accAdm', null, time() - 9999, "/");
}

function validate(array $request, string $role)
{
    $errors = "";

    $res = strlen($request['phone']) != 13 ? $errors = "Количество цифр в номере равно 13!" : false;
    if($res)
    {
        return $errors;
    }

    function isEmailAlreadyExists(string $email)
    {
        $query = "SELECT * FROM users WHERE u_login = '$email'";

        $db = get_connection();

        $result = $db->query($query);

        if ($result->num_rows > 0)
            return $result;
        else
            return false;
    }

    function isUniqueNumber(string $number)
    {
        $query = "SELECT * FROM admins WHERE adm_UNI = '$number'";

        $db = get_connection();

        $result = $db->query($query);

        if ($result->num_rows > 0)
            return $result;
        else
            return false;
    }

    function isLoginAlreadyExists(string $login)
    {
        $query = "SELECT * FROM admins WHERE adm_LOG = '$login'";

        $db = get_connection();

        $result = $db->query($query);

        if ($result->num_rows > 0)
            return $result;
        else
            return false;
    }

    if ($role == "user")
        if (isEmailAlreadyExists($request['email']))
            $errors = 'Email уже используется!';

    if ($role == "admin") {
        if (isset($request['unique'])) {
            if (isUniqueNumber($request['unique']))
                $errors = 'Exception1';
        }

        if (isset($request['login'])) {
            if (isLoginAlreadyExists($request['login']))
                $errors = 'Exception2';
        }
    }

    return $errors;
}

function validateLogin(array $login)
{
    $errors = "";

    if (isUserHasBeenBlock($login['email'],"email"))
        $errors = 'Этот email был заблокирован';

    return $errors;
}

function isUserHasBeenBlock(string $data, $by)
{
    $query = $by=="email" ? "SELECT u_login FROM `blacklist` join users on blacklist.u_ID = users.u_ID WHERE u_login = '$data'" : "SELECT d_DESC FROM `blacklist` join users on blacklist.u_ID = users.u_ID WHERE users.u_ID = '$data'";

    $db = get_connection();

    $result = $db->query($query);

    if ($result->num_rows > 0)
    {
        if($by == "email")
            return true;
        else
            return $row = $result->fetch_assoc();
    }       
    else
        return false;
}

function validateAccount(string $role)
{
    $errors = "";
    if (isset($_COOKIE['acc']) || isset($_COOKIE['accAdm'])) {
        $user = getCoockie("id", $role);

        function wrongAccount(string $user, string $role)
        {
            $query = ($role == "user") ? "SELECT * FROM `users` WHERE `u_ID` = $user" : "SELECT * FROM `admins` WHERE `adm_ID` = $user";
            $db = get_connection();

            $result = $db->query($query);

            if ($result->num_rows > 0)
                return true;
            else
                return false;
        }

        if (!wrongAccount($user, $role)) {
            $errors = 'Ваш ID не корректный!';
            logout($role);
        }
    }

    return $errors;
}

function validateTest(string $id)
{
    $user = isset($_POST['userID']) ? $_POST['userID'] : getCoockie("id","user");

    $query = "SELECT * FROM `testdrive` WHERE `uid` = $user and `car_ID` = $id and status != 'Denied'";

    $db = get_connection();
    $result = $db->query($query);
    if ($result->num_rows > 0)
        return false;
    else
        return true;
}

function isAuthorizated()
{
    if (isset($_COOKIE['acc'])) {
        if (!getAboutUser())
            return false;
        else
            return true;
    } else
        return false;
}

function getAboutUser()
{
    $user = getCoockie("id","user");

    $query = "SELECT `u_ID`,`u_login`,`u_name`,`u_fname`,(SELECT COUNT(d_ID) FROM testdrive WHERE uid=$user) as `test`, (SELECT COUNT(client_ID) FROM favourite WHERE client_ID=$user) as `fav` FROM `users` join testdrive on `u_ID` = `uid` join favourite on u_ID = client_ID WHERE `u_ID` = $user GROUP BY u_ID";

    $db = get_connection();
    $result = $db->query($query);

    if ($result) {
        return $row = $result->fetch_assoc();
    } else
        return false;
}

function checkUser(array $data)
{
    $errors = "";

    $login = $data['email'];
    $pass = encrypt($data['pass']);

    $query = "";

    if (isset($_POST['role']))
        $query = "SELECT * FROM `admins` WHERE `adm_LOG` = '$login' and `adm_PASS` = '$pass'";
    else
        $query = "SELECT * FROM `users` WHERE `u_login` = '$login' and `u_pass` = '$pass'";

    $db = get_connection();
    $stmt = $db->query($query);
    if ($stmt->num_rows < 1) {
        $errors = 'Проверьте правильность данных!';
    } else {
        if (!isset($_POST['loginAdmin'])) {
            if (isUserHasBeenBlock($login,"email"))
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
    if ($stmt->num_rows < 1)
        return false;
    else
        return $row = $stmt->fetch_assoc();
}

function getImagesAuto(string $id)
{
    $query = "SELECT * FROM `images` where `img_a_ID` = $id";

    $db = get_connection();
    $stmt = $db->query($query);

    return $stmt;
}

function getColors(string $year, string $model)
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

    $userid = isset($_POST['userID']) ? $_POST['userID'] : decrypt($_COOKIE['acc']);

    $arr = array();
    $res = false;
    if (($stmt->num_rows) > 0) {
        $test = array();
        while ($row = $stmt->fetch_assoc()) {
            if ($row['uid'] == $userid)
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
    $user = getCoockie("id", "user");

    $query = "INSERT INTO `favourite` (`client_ID`, `auto_ID`) VALUES('$user','$car')";
    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    return $stmt;
}

function removeFromFavourite(array $data)
{
    $car = $data['car_ID'];
    $user = getCoockie("id", "user");

    $query = "Delete from `favourite` where `auto_ID` = $car and `client_ID` = $user";
    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    return $stmt;
}

function addToTestdrive(string $id, string $date)
{
    if (validateTest($id)) {
        $user = isset($_POST['userID']) ? $_POST['userID'] : getCoockie("id", "user");

        $query = "INSERT INTO `testdrive` (`uid`, `car_ID`,`status`,`date`) VALUES($user,$id, 'Waiting', '$date')";
        $db = get_connection();
        $stmt = $db->query($query);
        return $stmt;
    } else {
        return false;
    }
}

function favouriteList()
{
    $user = getCoockie("id", "user");

    $query = "SELECT * FROM `favourite` join images on img_a_ID = auto_ID WHERE `client_ID` = $user and `isMain` = 'True'";

    $db = get_connection();
    return $db->query($query);
}

function getVideos(string $id)
{
    $query = "SELECT * FROM `videos` WHERE `auto_ID` = $id";

    $db = get_connection();
    return $db->query($query);
}

function getPhotos(string $id)
{
    $query = "SELECT * FROM `images` WHERE `img_a_ID` = $id Order by `isMain` desc";

    $db = get_connection();
    return $db->query($query);
}

function isExistElement($element, $name)
{
    $element == "video" ? $query = "SELECT * FROM `videos` WHERE `v_link` = '$name'" : $query = "SELECT * FROM `images` WHERE `img` = 'images/'$name";;

    $db = get_connection();
    $result = $db->query($query);

    if ($result) {
        if ($result->num_rows > 0)
            return true;
        else
            return false;
    } else
        return false;
}

function UpdatePhotos()
{
    $countToEdit = $_POST['countToEdit'];
    $countOfEdited = 0;

    $db = get_connection();

    if (isset($_POST['linksOld'])) {
        $arrOld = $_POST['linksOld'];
        $arrKeys = array_keys($arrOld);
        for ($a = 0; $a < count($arrKeys); $a++) {

            if ($arrOld[$arrKeys[$a]] == "") {
                $query = "Delete from `images` where imgID = $arrKeys[$a]";
                $db->query($query);

                if (mysqli_affected_rows($db) == 1);
                $countOfEdited++;
            }
            if (!isExistElement("photo", $arrOld[$arrKeys[$a]])) {
                $query = "Update `images` set img = 'images/" . $arrOld[$arrKeys[$a]] . "' where imgID = $arrKeys[$a]";

                $db->query($query);

                if (mysqli_affected_rows($db) == 1);
                $countOfEdited++;
            } else
                $countOfEdited++;
        }
    }

    $carID = $_POST['carID'];
    if (isset($_POST['linksNew'])) {
        $arrNew = array_unique(array_values($_POST['linksNew']));
        for ($a = 0; $a < count($arrNew); $a++) {

            if (isExistElement("photo", $arrOld[$arrKeys[$a]])) {
                $countOfEdited++;
                continue;
            }

            $query = "INSERT into `images` (`img_a_ID`,`imgName`,`img`,`isMain`) values ('$carID', '$arrNew[$a]','images/$arrNew[$a]','False')";
            $db->query($query);
            if (mysqli_affected_rows($db) == 1);
            $countOfEdited++;
        }
    }

    if ($countOfEdited == $countToEdit)
        return true;
    else
        return false;
}

function isUserAlreadyExist($name, $fname, $phone)
    {
        $query = "Select * from users where u_name = '$name' and u_fname = '$fname' and u_phone = '$phone'";

        $db = get_connection();

        $result = $db->query($query);

        if($result->num_rows>0)
        {
            $row = $result->fetch_assoc();
            $id = $row['u_ID'];

            $response = isUserHasBeenBlock($id,"id");

            if($response)
            return array (
                'success'=>true,
                'error'=>$response['d_DESC']
            );
            else
            return array('success'=>true,'id'=>$id);
        }
        else
        return array('success'=>false);
    }

function registerNewUser(){

    $name = $_POST['name']; $fname = $_POST['fname']; $phone = $_POST['phone'];
    $response = isUserAlreadyExist($name,$fname, $phone);

    if($response['success']==true)
    {
        $response['success']=false;
        return $response;
    }   
    else
    {
        $query = "Insert into users (`u_name`,`u_fname`,`u_phone`) values ('$name','$name', '$phone')";

        $db = get_connection();

        $result = $db->query($query);

        if(mysqli_affected_rows($db) == 1)
        {
            return array('success'=>true, 'id'=>$db->insert_id);
        }   
    }
}

function UpdateVideos()
{

    $arrFailed = array();

    function isLinkValide($link)
    {
        $apiforyoutube = "AIzaSyBxUtkAn6PdFSnrYz7o4D6T7O7qb1RCVp4";
        $theURL = "https://www.googleapis.com/youtube/v3/videos?id=$link&key=$apiforyoutube&part=status&json";

        $headers = file($theURL);
        if(count($headers) == 23)
        return true;
        else
        return false;
    }

    $countToEdit = $_POST['countToEdit'];
    $countOfEdited = 0;

    $db = get_connection();

    if (isset($_POST['linksOld'])) {
        $arrOld = $_POST['linksOld'];
        $arrKeys = array_keys($arrOld);
        for ($a = 0; $a < count($arrKeys); $a++) {
            if ($arrOld[$arrKeys[$a]] == "") {

                $query = "Delete from `videos` where link_ID = $arrKeys[$a]";
                $db->query($query);

                if (mysqli_affected_rows($db) == 1);
                $countOfEdited++;
            }
            if (!isExistElement("video", $arrOld[$arrKeys[$a]])) {
                if(isLinkValide($arrOld[$arrKeys[$a]])==true)
                    {
                        $query = "Update `videos` set v_link = '" . $arrOld[$arrKeys[$a]] . "' where link_ID = $arrKeys[$a]";

                        $db->query($query);

                        if (mysqli_affected_rows($db) == 1);
                        $countOfEdited++;
                    }
                    else
                    {
                        $arrFailed[] = $arrOld[$arrKeys[$a]];  
                        $countOfEdited++;
                    }
               
            } else
                $countOfEdited++;
        }
    }

    $carID = $_POST['carID'];
    if (isset($_POST['linksNew'])) {
        $arrNew = array_unique(array_values($_POST['linksNew']));
        for ($a = 0; $a < count($arrNew); $a++) {
            if(isLinkValide($arrNew[$a]) == true)
                {
                    $query = "INSERT into `videos` (`auto_ID`,`v_link`) values ('$carID', '$arrNew[$a]')";
                    $db->query($query);
                    if (mysqli_affected_rows($db) == 1);
                    $countOfEdited++;
                }
                else
                {
                    $arrFailed[] = $arrOld[$arrKeys[$a]];    
                    $countOfEdited++;             
                }       
        }
    }

    if ($countOfEdited == $countToEdit)
        return array("success"=>true, "data"=>$arrFailed);
    else
        return array("success"=>false, "data"=>$arrFailed);
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
        $user = getCoockie("id", "user");

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
    if ($rowcount > 0)
        return $stmt->fetch_assoc();
    else
        return false;
}

function generateRandomString($length = 15)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

function getUsersList()
{
    $query = "Select * from `users` where `u_ID` not in (Select u_ID from blacklist)";

    $db = get_connection();
    $result = $db->query($query);

    $arr = array();
    if ($result->num_rows > 0) {
        $arr['result'] = true;
        $arrSecond = array();
        while ($row = $result->fetch_assoc()) {
            $arrSecond[$row['u_ID']] = $row['u_ID'] . " - ( " . $row['u_name'] . ", " . $row['u_fname'] . " )";
        }
        $arr['ids'] = $arrSecond;
    } else
        $arr['result'] = false;

    return $arr;
}

function getModersList()
{
    $query = "Select `adm_UNI` from `admins` where adm_ROLE = 'Moder'";

    $db = get_connection();
    $result = $db->query($query);

    $arr = array();
    if ($result->num_rows > 0) {
        $arr['result'] = true;
        $arrSecond = array();
        while ($row = $result->fetch_assoc()) {
            $arrSecond[$row['adm_UNI']] = $row['adm_UNI'];
        }
        $arr['uniq'] = $arrSecond;
    } else
        $arr['result'] = false;

    return $arr;
}

function getAdminRole()
{
    $user = getCoockie("id", "admin");

    $query = "Select `adm_ROLE` from `admins` where adm_ID = $user";

    $db = get_connection();
    $result = $db->query($query);

    $row = $result->fetch_assoc();
    if ($row['adm_ROLE'] == "Moder")
        return 0;
    else
        return 1;
}

function makeAdmin(string $uniq)
{
    $error = validate($_POST, "admin");
    if ($error == "Exception1") {
        return array(
            "result" => false
        );
    }
    $login = generateRandomString();
    $pass = generateRandomString();
    $loginIsExists = false;

    while ($loginIsExists == true) {
        $error = validate(array("login" => $login), "admin");
        $error == "Exception2" ? $loginIsExists = true : $loginIsExists = false;
    }

    $query = "INSERT INTO `admins`(`adm_UNI`, `adm_LOG`, `adm_PASS`, `adm_ROLE`) VALUES ('$uniq', '$login', '$pass', 'Moder')";

    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0)
        return array(
            "uniq" => $uniq,
            "login" => $login,
            "pass" => $pass,
            "result" => true
        );
    else
        return array(
            "result" => false
        );
}

function deleteUser(string $id, string $role)
{
    $query = ($role == "user") ? "Delete from users where u_ID = $id" : "Delete from admins where adm_UNI = $id";

    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0)
        return "1";
    else
        return "0";
}

function blockUser()
{
    $query = "INSERT into `blacklist` (`u_ID`,`d_DESC`) values ('" . $_POST['uid'] . "', '" . $_POST['desc'] . "')";

    $db = get_connection();
    $stmt = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0)
        return "1";
    else
        return "0";
}

function getAllTests($where)
{
    $db = get_connection();

    $column = array("d_ID", "u_fname", "u_name", "car_ID", "mark", "m_model", "date", "status");

    $query = "SELECT * FROM testdrive JOIN users on `uid` = u_ID JOIN `auto` on car_ID = a_ID JOIN models on a_model = m_ID JOIN marks on m_mark_ID = mark_ID where $where ";

    if ($_POST["search"]["value"] != "") {
        $query .= '  OR (' . $where . ' and (u_name LIKE "%' . $_POST["search"]["value"] . '%"  OR u_fname LIKE "%' . $_POST["search"]["value"] . '%"  OR mark LIKE "%' . $_POST["search"]["value"] . '%" OR m_model LIKE "%' . $_POST["search"]["value"] . '%"  OR date LIKE "%' . $_POST["search"]["value"] . '%" )) ';
    }

    if (isset($_POST["order"])) {
        $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= 'ORDER BY d_ID ASC ';
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
        if ($where == "status IN ('Waiting','Success', 'Denied')" || $where == "status = 'Waiting'") {
            $sub_array[] = $row["d_ID"];
            $sub_array[] = $row['u_fname'];
            $sub_array[] = $row['u_name'];
            $sub_array[] = $row['car_ID'];
        }
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

    $column = array("a_ID", "img", "visible");

    $query = "SELECT * FROM auto join images on img_a_ID = a_ID join models on a_model=m_id join marks on m_mark_ID = mark_ID where isMain = 'True'";

    if (isset($_POST["search"]["value"])) {
        $query .= ' and (mark LIKE "%' . $_POST["search"]["value"] . '%"  OR m_model LIKE "%' . $_POST["search"]["value"] . '%") ';
    }
    if (isset($_POST["order"])) {
        $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= 'ORDER BY a_ID ASC ';
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
        $sub_array[] = $row["a_ID"];
        $sub_array[] = "<img class='center' src = ../" . $row['img'] . " width = '250px'>";
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

    $column = array("u_ID", "u_name", "u_fname", "u_login", "u_pass", "u_phone", "u_sex", "u_roleID");

    $query = "SELECT * FROM users where $where";

    if (isset($_POST["search"]["value"])) {
        $query .= ' OR (' . $where . ' and (u_name LIKE "%' . $_POST["search"]["value"] . '%"  OR u_fname LIKE "%' . $_POST["search"]["value"] . '%"  OR u_sex LIKE "%' . $_POST["search"]["value"] . '%" OR u_phone LIKE "%' . $_POST["search"]["value"] . '%"  OR u_login LIKE "%' . $_POST["search"]["value"] . '%" OR u_roleID LIKE "%' . $_POST["search"]["value"] . '%" ))';
    }

    if (isset($_POST["order"])) {
        $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= 'ORDER BY u_ID ASC ';
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

    $column = array("a_ID", "img", "mark", "m_model", "a_color", "a_year", "a_count");

    $query = "SELECT * FROM auto join images on img_a_ID = a_ID join models on a_model=m_id join marks on m_mark_ID = mark_ID where $where";

    if (isset($_POST["search"]["value"])) {
        $query .= ' OR (' . $where . ' and (mark LIKE "%' . $_POST["search"]["value"] . '%"  OR m_model LIKE "%' . $_POST["search"]["value"] . '%"  OR a_color LIKE "%' . $_POST["search"]["value"] . '%" OR a_year LIKE "%' . $_POST["search"]["value"] . '%" OR a_count LIKE "%' . $_POST["search"]["value"] . '%"))';
    }
    if (isset($_POST["order"])) {
        $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
        $query .= 'ORDER BY a_ID ASC ';
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
        $sub_array[] = $row["a_ID"];
        $sub_array[] = "<img class='center' src = ../" . $row['img'] . " width = '150px'>";
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
    $query = "SELECT * FROM " . $from;
    $statement = $conn->query($query);
    return $statement->num_rows;
}
