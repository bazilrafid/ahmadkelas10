<?php
session_start();
include 'db.php';
$db = new Database();

if($_SESSION['user']['role'] != 'teknisi'){
    die("Akses ditolak");
}

if(isset($_POST['simpan'])){
    $db->insertServis($_POST['pelanggan'], $_POST['keluhan']);
    header("Location: servis.php");
}

$pelanggan = $db->getPelanggan();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Servis - Techfix Servis</title>

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
            width: 320px;
            border: 1px solid #ddd;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        select {
            width: 99.5%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
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
    <h2>Tambah Servis</h2>

    <form method="POST">
        Pelanggan:
        <select name="pelanggan" required>
            <?php while($p = mysqli_fetch_assoc($pelanggan)){ ?>
                <option value="<?= $p['id_pelanggan'] ?>">
                    <?= $p['nama'] ?>
                </option>
            <?php } ?>
        </select>

        Keluhan:
        <input name="keluhan" required>

        <button name="simpan">Simpan</button>
    </form>

    <a href="servis.php">Kembali</a>
</div>

</body>
</html>