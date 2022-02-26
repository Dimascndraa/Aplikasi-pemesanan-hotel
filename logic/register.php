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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <!-- Sweet Alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="style.css">

  <link href='../img/logo/<?= $hotel['logo_primary'] ?>' rel='shortcut icon'>
  <title>Buat Akun</title>
  <style>
    body {
      background-image: url('../img/pattern.png');
    }
  </style>
</head>

<body class="bg-primary">

  <div class="container my-5">
    <div class="daftar card m-auto" style="background: #eaeaea;">
      <main class="mt-5">
        <div class="text-center">
          <img class="d-block mx-auto mb-4" src="../img/logo/<?= $hotel['logo_primary'] ?>" alt="Logo" width="100">
          <h2><?= $hotel['nama_hotel'] ?></h2>
        </div>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10">
            <h4 class="mt-5 text-center">Daftar</h4>
            <p class="text-center">Isi Sesuai Kartu Identitas Anda (KTP/SIM/Passport)</p>
            <form action="" method="post" autocomplete="off">
              <div class="container">
                <div class="row g-3">
                  <div class="col-sm-6">
                    <label for="nama" class="form-label">Nama</label>
                    <input style="background-color: #e8f0fe;" type="text" name="nama" class="form-control" id="nama" value="<?= @$_SESSION['nama'] ?>" required placeholder="Nama">
                  </div>
                  <div class="col-lg-6">
                    <label for="username" class="form-label">Username</label>
                    <input style="background-color: #e8f0fe;" type="text" name="username" class="form-control" id="username" value="<?= @$_SESSION['username'] ?>" placeholder="Username" required>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="password">Password</label>
                      <div class="input-group" id="show_hide_password">
                        <input type="password" style="background-color: #e8f0fe;" name='password' class="form-control" value="<?= @$_SESSION['password'] ?>" required placeholder="Password">
                        <div class="input-group-append">
                          <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="confirm-password">Password</label>
                      <div class="input-group" id="show_hide_password_2">
                        <input type="password" style="background-color: #e8f0fe;" name='confirm-password' class="form-control" value="<?= @$_SESSION['confirm-password'] ?>" name="confirm-password" required placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                          <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label for="email" class="form-label">Email</label>
                    <input style="background-color: #e8f0fe;" type="email" name="email" class="form-control" value="<?= @$_SESSION['email'] ?>" id="email" placeholder="Email" required>
                  </div>
                  <div class="col-lg-6">
                    <label for="telp" class="form-label">Telepon</label>
                    <input style="background-color: #e8f0fe;" type="text" name="telp" class="form-control" value="<?= @$_SESSION['telp'] ?>" id="telp" placeholder="No HP" required>
                  </div>
                  <div class="col-lg-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input style="background-color: #e8f0fe;" type="text" name="alamat" class="form-control" value="<?= @$_SESSION['alamat'] ?>" id="alamat" placeholder="Alamat" required>
                  </div>
                  <div class="col-lg-12">
                    <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis-kelamin" id="jenis-kelamin" style="background-color: #e8f0fe;" class="form-select">
                      <option value="" disabled selected>-- Pilih Jenis Kelamin--</option>
                      <option value="laki-laki" <?= @$_SESSION['jenis-kelamin'] == "laki-laki" ? "selected" : "" ?>>Laki-laki</option>
                      <option value="perempuan" <?= @$_SESSION['jenis-kelamin'] == "perempuan" ? "selected" : "" ?>>Perempuan</option>
                    </select>
                  </div>
                  <hr class="my-4">
                  <button class="w-100 btn text-white btn-lg" style="background: #174578;" name="register" type="submit">Daftar</button>
                  <a class="nav-link text-center mb-5" style="color: #174578;" href="./login.php">Atau sudah punya akun?</a>
                </div>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>

  <?php
  if (isset($_POST['register'])) {
    if (daftarAkun($_POST) > 0) {
      echo "<script>
            document.location.href = 'login.php?pesan=daftar-berhasil';
          </script>";
    } else {
      echo "<script>
            document.location.href = '?pesan=gagal';
          </script>";
    }
  }

  if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "username-invalid") {
      echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'Daftar Gagal',
            text: 'Username sudah terdaftar!',
            footer: 'Silahkan gunakan username lain!'
            })
          </script>";
    }

    if ($_GET['pesan'] == "password-invalid") {
      echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'Daftar Gagal',
            text: 'Konfirmasi password tidak sesuai!',
            footer: 'Silahkan cek kembali password yang diinputkan!'
            })
          </script>";
    }
  }
  ?>

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
      $("#show_hide_password_2 a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password_2 input').attr("type") == "text") {
          $('#show_hide_password_2 input').attr('type', 'password');
          $('#show_hide_password_2 i').addClass("bi bi-eye-slash");
          $('#show_hide_password_2 i').removeClass("bi bi-eye");
        } else if ($('#show_hide_password_2 input').attr("type") == "password") {
          $('#show_hide_password_2 input').attr('type', 'text');
          $('#show_hide_password_2 i').removeClass("bi bi-eye-slash");
          $('#show_hide_password_2 i').addClass("bi bi-eye");
        }
      });
    });
  </script>
</body>

</html>