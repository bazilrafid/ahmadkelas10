<?php
session_start();
if ($_SESSION['user']['role'] != 'teknisi') {
    die("Akses ditolak");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Techfix Servis</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }

        .box {
            background: white;
            padding: 20px;
            width: 300px;
            border: 1px solid #ddd;
            margin: 8% auto;
        }

        h2 {
            margin-bottom: 20px;
        }

        a {
            display: block;
            padding: 8px;
            margin-bottom: 10px;
            background: black;
            color: white;
            text-decoration: none;
            text-align: center;
        }

        a:hover {
            background: #333;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2 align="center">Teknisi Panel</h2>

        <a href="servis.php">Data Servis</a><br>
        <a href="tambah_servis.php">Tambah Servis</a><br>
        <a href="stok.php">Lihat Stok</a><br>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>