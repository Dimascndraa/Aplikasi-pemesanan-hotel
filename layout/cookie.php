<?php
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $idCookie = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    // ambil username berdasarkan id
    $result = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id = $idCookie");
    $row = mysqli_fetch_assoc($result);
    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = 1;
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['level'] = "Pelanggan";
    }
}

if (!isset($_COOKIE['login'])) {
    $_COOKIE['login'] = "0";
} else if ($_COOKIE['login'] == "2") {
    header("location: admin/");
} else if ($_COOKIE['login'] == "3") {
    header("location: admin/");
}


if (!isset($_SESSION['login'])) {
    $_SESSION['login'] = 0;
}
if ($_SESSION['login'] == 1) {
    $id = $_SESSION['id'];
    $dataPelanggan = query("SELECT * FROM pelanggan WHERE id = '$id'")[0];
    $username = $dataPelanggan['username'];
    $password = $dataPelanggan['password'];
} else if ($_SESSION['login'] == 2) {
    header("location: admin/");
} else if ($_SESSION['login'] == 3) {
    header("location: admin/");
}
