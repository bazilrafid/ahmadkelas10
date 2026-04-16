<?php
class Database
{
    private $conn;

    function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "techfix_servis");

        if (!$this->conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
    }

    // ================= LOGIN =================
    function login($u, $p)
    {
        $q = mysqli_query($this->conn, "
            SELECT * FROM user 
            WHERE username='$u' AND password='$p'
        ");
        return mysqli_fetch_assoc($q);
    }

    // ================= SPAREPART (CRUD) =================

    function getSparepart()
    {
        return mysqli_query($this->conn, "SELECT * FROM sparepart");
    }

    function getSparepartById($id)
    {
        return mysqli_fetch_assoc(mysqli_query($this->conn, "
            SELECT * FROM sparepart WHERE id_sparepart='$id'
        "));
    }

    function insertSparepart($nama, $stok, $beli, $jual)
    {
        mysqli_query($this->conn, "
            INSERT INTO sparepart (nama,stok,harga_beli,harga_jual)
            VALUES('$nama','$stok','$beli','$jual')
        ");
    }

    function updateSparepart($id, $nama, $stok, $beli, $jual)
    {
        mysqli_query($this->conn, "
            UPDATE sparepart 
            SET nama='$nama',
                stok='$stok',
                harga_beli='$beli',
                harga_jual='$jual'
            WHERE id_sparepart='$id'
        ");
    }

    function deleteSparepart($id)
    {
        mysqli_query($this->conn, "
            DELETE FROM sparepart WHERE id_sparepart='$id'
        ");
    }

    // ================= SERVIS =================

    function tambahDetailServis($id_servis, $id_sparepart, $qty)
    {
        $sp = $this->getSparepartById($id_sparepart);

        if (!$sp) {
            return "Sparepart tidak ditemukan";
        }

        if ($sp['stok'] >= $qty) {

            // kurangi stok
            $sisa = $sp['stok'] - $qty;
            mysqli_query($this->conn, "
                UPDATE sparepart SET stok='$sisa'
                WHERE id_sparepart='$id_sparepart'
            ");

            // hitung subtotal
            $harga = $sp['harga_jual'];
            $subtotal = $qty * $harga;

            // simpan detail servis
            mysqli_query($this->conn, "
                INSERT INTO detail_servis
                (id_servis,id_sparepart,qty,harga_saat_servis,subtotal)
                VALUES('$id_servis','$id_sparepart','$qty','$harga','$subtotal')
            ");

            return "Berhasil tambah sparepart";
        } else {

            // stok tidak cukup
            mysqli_query($this->conn, "
                UPDATE servis 
                SET status='Menunggu Sparepart'
                WHERE id_servis='$id_servis'
            ");

            return "Stok habis";
        }
    }

    // ================= NOTA =================

    function buatNota($id_servis)
    {

        // total sparepart
        $q = mysqli_query($this->conn, "
            SELECT SUM(subtotal) as total_sparepart 
            FROM detail_servis 
            WHERE id_servis='$id_servis'
        ");
        $d = mysqli_fetch_assoc($q);

        $total_sparepart = $d['total_sparepart'] ?? 0;

        // biaya jasa
        $jasa = mysqli_fetch_assoc(mysqli_query($this->conn, "
            SELECT biaya_jasa 
            FROM servis 
            WHERE id_servis='$id_servis'
        "));

        $biaya_jasa = $jasa['biaya_jasa'] ?? 0;

        // total akhir
        $total = $total_sparepart + $biaya_jasa;

        // simpan nota
        mysqli_query($this->conn, "
            INSERT INTO nota_pembayaran
            (id_servis,tanggal_bayar,total_bayar)
            VALUES('$id_servis',CURDATE(),'$total')
        ");
    }

    // ================= SERVIS =================

    // ambil semua servis + pelanggan
    function getServis()
    {
        return mysqli_query($this->conn, "
        SELECT servis.*, pelanggan.nama 
        FROM servis
        JOIN pelanggan ON servis.id_pelanggan = pelanggan.id_pelanggan
    ");
    }

    // ambil pelanggan (buat dropdown)
    function getPelanggan()
    {
        return mysqli_query($this->conn, "SELECT * FROM pelanggan");
    }

    // tambah servis
    function insertServis($id_pelanggan, $keluhan)
    {
        mysqli_query($this->conn, "
        INSERT INTO servis (id_pelanggan,keluhan,status,tanggal_masuk,biaya_jasa)
        VALUES('$id_pelanggan','$keluhan','Proses',CURDATE(),0)
    ");
    }

    function updateStatusServis($id, $status)
    {
        mysqli_query($this->conn, "
        UPDATE servis SET status='$status'
        WHERE id_servis='$id'
    ");
    }

    function laporanKeuangan()
    {

        return mysqli_query($this->conn, "
        SELECT 
            SUM(detail_servis.subtotal) AS penjualan_sparepart,
            SUM(servis.biaya_jasa) AS jasa_servis,
            SUM(sparepart.harga_beli * detail_servis.qty) AS modal_sparepart
        FROM detail_servis
        JOIN sparepart ON detail_servis.id_sparepart = sparepart.id_sparepart
        JOIN servis ON detail_servis.id_servis = servis.id_servis
    ");
    }

    function selesaiServis($id, $biaya_jasa){
    mysqli_query($this->conn,"
        UPDATE servis 
        SET biaya_jasa='$biaya_jasa', status='Selesai'
        WHERE id_servis='$id'
    ");
}
}
