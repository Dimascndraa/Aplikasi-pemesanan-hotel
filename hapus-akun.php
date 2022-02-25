<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


include "logic/functions.php";

// jika tidak ada id di url
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// mengambil id dari url
$id = $_GET['id'];

if (hapusAkun($id) > 0) {
    echo "<script>
          alert('data berhasil dihapus');
          document.location.href = 'index.php';
       </script>";
} else {
    echo "data gagal dihapus!";
}

header("Location: logic/logout.php");
