<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../logic/login.php?pesan=login");
    exit;
}

if ($_SESSION['level'] == "Pelanggan" || $_SESSION['level'] == "") {
    header("location: ../logic/login.php?pesan=login");
    exit;
}

include '../logic/functions.php';

// jika tidak ada id di url
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// mengambil id dari url
$id = $_GET['id'];

if (hapusFasilitas($id) > 0) {
    echo "<script>
          alert('data berhasil dihapus');
            document.location.href = './';
       </script>";
} else {
    echo "data gagal dihapus!";
}
