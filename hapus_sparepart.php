<?php
session_start();
include 'db.php';
$db = new Database();

if($_SESSION['user']['role'] != 'admin'){
    die("Akses ditolak");
}

$id = $_GET['id'];
$db->deleteSparepart($id);

header("Location: sparepart.php");