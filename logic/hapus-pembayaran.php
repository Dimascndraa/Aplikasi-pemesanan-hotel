<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}


include "../logic/functions.php";

// jika tidak ada id di url
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// mengambil id dari url
$id = $_GET['id'];

if (hapusPembayaran($id) > 0) {
    echo "<script>
          document.location.href = '../admin/data-pembayaran.php?page=data-pembayaran&pesan=berhasil-hapus-pembayaran';
       </script>";
} else {
    echo "data gagal dihapus!";
}
