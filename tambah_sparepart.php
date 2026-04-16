<?php
session_start();
include 'db.php';
$db = new Database();

if($_SESSION['user']['role'] != 'admin'){
    die("Akses ditolak");
}

if(isset($_POST['simpan'])){
    $db->insertSparepart(
        $_POST['nama'],
        $_POST['stok'],
        $_POST['beli'],
        $_POST['jual']
    );
    header("Location: sparepart.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Sparepart - Techfix Servis</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            padding: 20px;
            width: 300px;
            border: 1px solid #ddd;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        input {
            width: 94%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 8px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #333;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="box">
    <h2>Tambah Sparepart</h2>

    <form method="POST">
        Nama:
        <input name="nama" required>

        Stok:
        <input type="number" name="stok" required>

        Harga Beli:
        <input type="number" name="beli" required>

        Harga Jual:
        <input type="number" name="jual" required>

        <button name="simpan">Simpan</button>
    </form>

    <a href="sparepart.php">Kembali</a>
</div>

</body>
</html>