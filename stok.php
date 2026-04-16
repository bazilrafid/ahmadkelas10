<?php
session_start();
include 'db.php';
$db = new Database();

if($_SESSION['user']['role'] != 'teknisi'){
    die("Akses ditolak");
}

$data = $db->getSparepart();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stok Sparepart - Techfix Servis</title>

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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th {
            background: #eee;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="container">

<h2>Stok Sparepart</h2>

<table>
<tr>
    <th>Nama</th>
    <th>Stok</th>
    <th>Status</th>
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
    <td><?= $d['nama'] ?></td>
    <td><?= $d['stok'] ?></td>
    <td><?= $status ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>