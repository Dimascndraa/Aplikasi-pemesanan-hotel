<?php
include "logic/functions.php";

$tipe = $_POST['tipe-kamar'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah-kamar'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];
$cekin = $_POST['cekin'];
$cekout = $_POST['cekout'];
$harga = intval(substr($_POST['harga'], 0, 7));
$durasi = substr($_POST['cekout'], 8) - substr($_POST['cekin'], 8);
$jmlkamar = intval($_POST['jumlah-kamar']);
$totalBiaya = rupiah($harga * $durasi * $jmlkamar . "000");
