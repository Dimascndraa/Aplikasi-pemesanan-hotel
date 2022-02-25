<?php
include "logic/functions.php";

$tipeKamar = $_POST["tipe-kamar"];
$gambar = query("SELECT gambar FROM fasilitas WHERE tipe_kamar = '$tipeKamar'")[0]['gambar'];
$hargaAwal = query("SELECT harga FROM fasilitas WHERE tipe_kamar = '$tipeKamar'")[0]['harga'];
