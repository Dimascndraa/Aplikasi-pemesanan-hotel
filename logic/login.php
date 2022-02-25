<?php
session_start();
include "functions.php";

if (!isset($_COOKIE['login'])) {
  $_COOKIE['login'] = "0";
} else if ($_COOKIE['login'] == "1") {
  header("location: ../");
} else if ($_COOKIE['login'] == "2") {
  header("location: ../admin/");
} else if ($_COOKIE['login'] == "3") {
  header("location: ../admin/");
}

$hotel = query("SELECT * FROM identitas")[0];
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link href="style.css" rel="stylesheet">
  <link href='../img/logo/<?= $hotel['logo_primary'] ?>' rel='shortcut icon'>
  <!-- Sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Login</title>
</head>

<body style="background-color: #6998AB;">

  <div class="container overflow-hidden mt-lg-5">
    <div class="card bg-white my-2">
      <div class="row">
        <div class="col-lg-5 pt-5 text-center">
          <img src="../img/logo/<?= $hotel['logo_primary'] ?>" class="logo" alt="Logo SMKN 1 Kadipaten">
          <h1 class="lead mt-3"><?= $hotel['nama_hotel'] ?>!</h1>
        </div>
        <div class="col-lg-7 p-1 pt-lg-5">
          <h1 class="lead text-center">Login</h1>
          <div class="row justify-content-center">
            <div class="col-8 mb-3">
              <form action="cek_login.php" method="post" autocomplete="off">
                <div class="my-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" style="background-color: #e8f0fe;" class="form-control" name="username" id="username" placeholder="Masukkan Username">
                </div>
                <div class="my-3">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group" id="show_hide_password">
                      <input type="password" style="background-color: #e8f0fe;" name='password' class="form-control" name="password" required placeholder="Password">
                      <div class="input-group-append">
                        <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="my-3">
                  <div class="form-check form-switch">
                    <input name="remember" class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                  </div>
                </div>
                <div class="my-3">
                  <button style="background-color: #6998AB;" class="btn text-white w-100" type="submit" name="login">Login</button>
                </div>
                <a style="color: #6998AB;" href="./register.php" class="lg nav-link text-center">Belum punya akun? Daftar sekarang</a>
                <a style="color: #6998AB;" href="./register.php" class="sm nav-link text-center">Daftar?</a>
                <a style="color: #6998AB;" href="../index.php" class="nav-link text-center">Kembali ke halaman awal</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_GET['pesan'])) : ?>
    <?php if ($_GET['pesan'] == "gagal") : ?>
      <div class="container">
        <script>
          Swal.fire({
            icon: 'error',
            title: 'Login Gagal!',
            text: 'Username atau Password salah!',
          })
        </script>
      </div>
    <?php endif; ?>
    <?php if ($_GET['pesan'] == "berhasil") : ?>
      <div class="container">
        <script>
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
          })

          Toast.fire({
            icon: 'success',
            title: 'Anda berhasil Keluar!'
          })
        </script>
      </div>
    <?php endif; ?>
  <?php endif; ?>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass("bi bi-eye-slash");
          $('#show_hide_password i').removeClass("bi bi-eye");
        } else if ($('#show_hide_password input').attr("type") == "password") {
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass("bi bi-eye-slash");
          $('#show_hide_password i').addClass("bi bi-eye");
        }
      });
    });
  </script>

</body>

</html>