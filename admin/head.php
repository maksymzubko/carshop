<?php 
if (!isset($_COOKIE['accAdm'])) {
    header("Location: login.php");
    exit;
}

echo '    <!-- Import css -->
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/bootstrap-datetimepicker.css">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/admin_style.css">
<link rel="stylesheet" href="../css/all.css">
<link rel="stylesheet" href="../css/sweetalert2.min.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">'
?>