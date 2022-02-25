<?php
session_start();
include 'functions.php';

$username = $_POST['username'];
$password = hash('sha256', $_POST['password']);

$id = query("SELECT * FROM pegawai WHERE username = '$username'")[0]['id'];
$usernamePegawai = query("SELECT * FROM pegawai WHERE username = '$username'")[0]['username'];
$idPelanggan = query("SELECT * FROM pelanggan WHERE username = '$username'")[0]['id'];
$usernamePelanggan = query("SELECT * FROM pelanggan WHERE username = '$username'")[0]['username'];

$login = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE username = '$username' AND password='$password'");
$cek = mysqli_num_rows($login);

$loginPelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE username = '$username' AND password = '$password'");
$cekPelanggan = mysqli_num_rows($loginPelanggan);


if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);
    if ($data['role'] == "admin") {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        $_SESSION['level'] = "admin";
        $_SESSION['login'] = 2;
        if (isset($_POST['remember'])) {
            setcookie('id', $id, time() + 86400, "/");
            setcookie('key', hash('sha256', $username), time() + 86400, "/");
            setcookie('login', "2", time() + 86400, "/");
        }
        header("location:../admin/");
    } else if ($data['role'] == "resepsionis") {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        $_SESSION['level'] = "resepsionis";
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        $_SESSION['level'] = "admin";
        $_SESSION['login'] = 3;
        if (isset($_POST['remember'])) {
            setcookie('id', $id, time() + 86400, "/");
            setcookie('key', hash('sha256', $username), time() + 86400, "/");
            setcookie('login', "3", time() + 86400, "/");
        }
        header("location:../admin/");
    } else {
        header("location:login.php?pesan=gagal");
    }
} else if ($cekPelanggan > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $idPelanggan;
    $_SESSION['level'] = "Pelanggan";
    $_SESSION['login'] = 1;
    if (isset($_POST['remember'])) {
        setcookie('id', $idPelanggan, time() + 86400, "/");
        setcookie('key', hash('sha256', $usernamePelanggan), time() + 86400, "/");
        setcookie('login', "1", time() + 86400, "/");
    }
    header("Location: ../index.php?page=index&pesan=berhasil");
} else {
    header("location:login.php?pesan=gagal");
}
