<?php
include "logic/functions.php";

$tipe = $_POST['tipe-kamar'];
$jumlah = $_POST['jumlah-kamar'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];
$cekin = $_POST['cekin'];
$cekout = $_POST['cekout'];

$tgl1 = new DateTime("$cekin");
$tgl2 = new DateTime("$cekout");
$selisih = $tgl2->diff($tgl1);

$durasi = $selisih->days;

// $harga = intval(substr($_POST['harga'], 0, 7));
$jmlkamar = intval($_POST['jumlah-kamar']);
$totalBiaya = $_POST['harga'] . ",00";
