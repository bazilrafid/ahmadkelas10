<?php
session_start();
include 'db.php';
$db = new Database();

if($_SESSION['user']['role'] != 'teknisi'){
    die("Akses ditolak");
}

$id_servis = $_GET['id'];

if(isset($_POST['tambah'])){
    $db->tambahDetailServis(
        $id_servis,
        $_POST['sparepart'],
        $_POST['qty']
    );
    header("Location: servis.php");
}

$sparepart = $db->getSparepart();
?>

<h2>Tambah Sparepart ke Servis</h2>

<form method="POST">
Sparepart:
<select name="sparepart">
<?php while($s = mysqli_fetch_assoc($sparepart)){ ?>
<option value="<?= $s['id_sparepart'] ?>">
    <?= $s['nama'] ?> (stok: <?= $s['stok'] ?>)
</option>
<?php } ?>
</select><br><br>

Qty:
<input name="qty"><br><br>

<button name="tambah">Tambah</button>
</form>