<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../../src/plugins/fontawesome-free/css/all.min.css">

    <title>Hello, world!</title>
</head>

<body>

    <?= date("Y-m-d 12:00") ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card position-relative">
                    <div class="card-header">
                        <a href="hapus-pesanan.php"><i class="fas fa-trash position-absolute text-secondary" style="right: 1rem; top: 1rem;"></i></a>
                        <h5 class="text-center" style="font-size: 12pt;">Superior</h5>
                        <span class="d-block text-muted text-center mt-2 ms-2" style="font-size:9pt">12 Februari 2022</span>
                    </div>
                    <div class="card-body" style="font-size: 9pt;">
                        <div class="row justify-content-center g-1">
                            <div class="col-5 text-lg-end">
                                Nama:
                            </div>
                            <div class="col-6 offset-lg-1">
                                Dimas Candra
                            </div>
                            <div class="col-5 text-lg-end">
                                Jumlah:
                            </div>
                            <div class="col-6 offset-lg-1">
                                2 Kamar
                            </div>
                            <div class="col-5 text-lg-end">
                                Durasi:
                            </div>
                            <div class="col-6 offset-lg-1">
                                1 Malam
                            </div>
                            <div class="col-5 text-lg-end">
                                CheckIn:
                            </div>
                            <div class="col-6 offset-lg-1">
                                16 Februari 2022
                            </div>
                            <div class="col-5 text-lg-end">
                                CheckOut:
                            </div>
                            <div class="col-6 offset-lg-1">
                                17 Februari 2022
                            </div>
                            <div class="col-5 text-lg-end">
                                Batas Pembayaran:
                            </div>
                            <div class="col-6 offset-lg-1">
                                18 Februari 2022
                            </div>
                            <div class="col-5 text-lg-end">
                                Total:
                            </div>
                            <div class="col-6 offset-lg-1">
                                Rp. 1.000.000
                            </div>
                            <div class="col-12 text-center mt-3">Belum Dibayar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>