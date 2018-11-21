<?php
$user = $_POST['user'];
$pass = $_POST['pass'];

$host_name = '********';
$database = 'db****';
$user_name = '******';
$password = '****';

$connect = mysqli_connect($host_name, $user_name, $password, $database);
//if (mysqli_errno()) {
//    die('<p>Failed to connect to MySQL: '.mysqli_error().'</p>');
//} else {
//    echo '<script language="javascript">alert("DB conectada");</script>'; 
//}
?>