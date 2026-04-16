<?php
session_start();
include 'db.php';
$db = new Database();

$username = $_POST['username'];
$password = $_POST['password'];

$data = $db->login($username,$password);

if($data){
    $_SESSION['user'] = $data;

    if($data['role'] == 'admin'){
        header("Location: dashboard_admin.php");
    } else {
        header("Location: dashboard_teknisi.php");
    }
}else{
    echo "Login gagal";
}