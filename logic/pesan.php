<?php
include "functions.php";

$jumlahKamar = $_POST['jumlah-kamar'];
$tglCheckOut = $_POST['tgl-check-out'];
$tglCheckIn = $_POST['tgl-check-in'];
$cekin = substr($tglCheckIn, 8);
$cekout = substr($tglCheckOut, 8);
$durasiMenginap = $cekout - $cekin;
$hargaAwal = $_POST['tipe'];
$jumlahHarga = $_POST['tipe'] * $durasiMenginap * $jumlahKamar;
$totalHarga = rupiah($jumlahHarga);
$tipeKamar = query("SELECT tipe_kamar FROM fasilitas_kamar WHERE harga = $hargaAwal")[0]['tipe_kamar'];
