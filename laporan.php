<?php
session_start();
include 'db.php';
$db = new Database();

if($_SESSION['user']['role'] != 'admin'){
    die("Akses ditolak");
}

$data = mysqli_fetch_assoc($db->laporanKeuangan());

$penjualan = $data['penjualan_sparepart'] ?? 0;
$jasa = $data['jasa_servis'] ?? 0;
$modal = $data['modal_sparepart'] ?? 0;

$laba = ($penjualan + $jasa) - $modal;

// fungsi format rupiah
function rupiah($angka){
    return "Rp " . number_format($angka, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan - Techfix Servis</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }

        .container {
            margin:auto;
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
            width: 400px;
        }

        h2 {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
        }

        td {
            padding: 8px;
        }

        .total {
            font-weight: bold;
            border-top: 1px solid #000;
        }
    </style>
</head>

<body>

<div class="container">

<h2>Laporan Keuangan</h2>

<table>
<tr>
    <td>Total Penjualan Sparepart</td>
    <td><?= rupiah($penjualan) ?></td>
</tr>
<tr>
    <td>Total Jasa Servis</td>
    <td><?= rupiah($jasa) ?></td>
</tr>
<tr>
    <td>Modal Sparepart</td>
    <td><?= rupiah($modal) ?></td>
</tr>

<tr class="total">
    <td>Laba</td>
    <td><?= rupiah($laba) ?></td>
</tr>
</table>

<br>
<a href="dashboard_admin.php">Kembali</a>

</div>

</body>
</html>