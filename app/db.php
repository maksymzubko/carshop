<?php
function get_connection()
{
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db_name = 'carshop';
  
  $conn = mysqli_connect($servername, $username, $password, $db_name);
  if (!$conn) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }else
  {
    $conn->set_charset('utf8');
    return $conn;
  }
}?>