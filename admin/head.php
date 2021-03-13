<?php 
if (!isset($_COOKIE['accAdm'])) {
    header("Location: login.php");
    exit;
}

echo '  
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Import css -->
<link rel="shortcut icon" href="../images/logo-mini.png">
<link rel="stylesheet" href="../css/bootstrap-reboot.css">
<link rel="stylesheet" href="../css/all.css">
<link rel="stylesheet" href="../css/bootstrap-datetimepicker.css">
<link rel="stylesheet" href="../css/bootstrap.css">

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/sweetalert2.min.css">
';
?>