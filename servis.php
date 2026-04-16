<?php
session_start();
include 'db.php';
$db = new Database();

if ($_SESSION['user']['role'] != 'teknisi') {
    die("Akses ditolak");
}

if (isset($_POST['selesai'])) {
    $id = $_POST['id'];
    $jasa = $_POST['biaya_jasa'];

    $db->selesaiServis($id, $jasa);

    header("Location: servis.php");
}

// ambil data servis
$data = $db->getServis();
$no = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Servis - Techfix Servis</title>

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

        a.btn {
            padding: 5px 8px;
            background: black;
            color: white;
            text-decoration: none;
        }

        a.btn:hover {
            background: #333;
        }

        input {
            padding: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 5px 8px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #333;
        }
    </style>
</head>

<body>

<div class="container">

<h2>Data Servis</h2>

<table>
<tr>
    <th>ID</th>
    <th>Pelanggan</th>
    <th>Keluhan</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php while ($d = mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nama'] ?></td>
    <td><?= $d['keluhan'] ?></td>

    <!-- STATUS -->
    <td>
        <?php
        if ($d['status'] == 'Selesai') {
            echo "Selesai";
        } elseif ($d['status'] == 'Menunggu Sparepart') {
            echo "Menunggu Sparepart";
        } else {
            echo "Proses";
        }
        ?>
    </td>

    <!-- AKSI -->
    <td>
        <?php if ($d['status'] != 'Selesai') { ?>

            <a class="btn" href="tambah_sparepart_servis.php?id=<?= $d['id_servis'] ?>">
                + Sparepart
            </a>

            <br><br>

            <form method="POST">
                <input type="hidden" name="id" value="<?= $d['id_servis'] ?>">
                <input type="number" name="biaya_jasa" placeholder="Biaya Jasa" required>
                <button name="selesai">Selesai</button>
            </form>

        <?php } else { ?>
            -
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>