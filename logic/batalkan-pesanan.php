<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


include "functions.php";

// jika tidak ada id di url
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// mengambil id dari url
$id = $_GET['id'];

$data = query("SELECT * FROM pemesanan WHERE id = $id")[0];
if (batalkanPesanan($data) > 0) {
    echo "<script>
            document.location.href = '../pesanan.php?page=pesanan&pesan=berhasil-dibatalkan';
       </script>";
} else {
    echo "data gagal dihapus!";
}
