<?php
session_start();
include 'db.php';
$db = new Database();

if($_SESSION['user']['role'] != 'admin'){
    die("Akses ditolak");
}

$data = $db->getSparepart();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sparepart - Techfix Servis</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
        }

        h2 {
            margin-bottom: 10px;
        }

        a.btn {
            display: inline-block;
            padding: 6px 10px;
            background: black;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
        }

        a.btn:hover {
            background: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>

<div class="container">

<h2>Data Sparepart</h2>

<a href="tambah_sparepart.php" class="btn">+ Tambah</a>

<table>
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Stok</th>
    <th>Status</th>
    <th>Harga Beli</th>
    <th>Harga Jual</th>
    <th>Aksi</th>
</tr>

<?php while($d = mysqli_fetch_assoc($data)){ 

    if($d['stok'] == 0){
        $status = "Habis";
    } elseif($d['stok'] < 3){
        $status = "Menipis";
    } else {
        $status = "Aman";
    }

?>

<tr>
    <td><?= $d['id_sparepart'] ?></td>
    <td><?= $d['nama'] ?></td>
    <td><?= $d['stok'] ?></td>
    <td><?= $status ?></td>
    <td><?= $d['harga_beli'] ?></td>
    <td><?= $d['harga_jual'] ?></td>
    <td>
        <a href="edit_sparepart.php?id=<?= $d['id_sparepart'] ?>">Edit</a> |
        <a href="hapus_sparepart.php?id=<?= $d['id_sparepart'] ?>">Hapus</a>
    </td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>