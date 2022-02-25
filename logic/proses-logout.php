<?php
session_start();
include "functions.php";
$hotel = query("SELECT * FROM identitas")[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="src/plugins/fontawesome-free/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <link href='../img/logo/<?= $hotel['logo_primary'] ?>' rel='shortcut icon'>
    <title><?= $hotel['nama_hotel'] ?>!</title>
</head>

<body>


    <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success m-3',
                cancelButton: 'btn btn-danger m-3'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Anda yakin ingin Keluar?',
            text: "Anda bisa membatalkannya kapanpun!",
            icon: 'warning',
            backdrop: '#6998AB',
            showCancelButton: true,
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Tidak, Batalkan!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = "logout.php";
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                <?php if ($_SESSION['level'] == "pelanggan") : ?>
                    document.location.href = "../index.php";
                <?php else : ?>
                    document.location.href = "../admin/index.php";
                <?php endif; ?>
            }
        })
    </script>
</body>

</html>