<?php $hotel = query("SELECT * FROM identitas")[0]; ?>
<?php if ($_SESSION['login'] == 1) : ?>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6998AB;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/logo/<?= $hotel['logo_secondary'] ?>" width="30" alt="<?= $hotel['logo_primary'] ?>"> <span class="bold"><?= $hotel['nama_hotel'] ?></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link <?= $_GET['page'] == 'index' ? 'active' : ''; ?>" href="./index.php?page=index">Beranda</a>
                    <a class="nav-link <?= $_GET['page'] == 'profile' ? 'active' : ''; ?>" href="./profile.php?page=profile">Profil</a>
                    <a class="nav-link <?= $_GET['page'] == 'kamar' ? 'active' : ''; ?>" href="./kamar.php?page=kamar">Kamar</a>
                    <a class="nav-link <?= $_GET['page'] == 'fasilitas' ? 'active' : ''; ?>" href="./fasilitas.php?page=fasilitas">Fasilitas</a>
                    <a class="nav-link <?= $_GET['page'] == 'pesanan' ? 'active' : ''; ?>" href="./pesanan.php?page=pesanan">Pesanan</a>
                    <a class="nav-link" href="./logic/proses-logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
<?php else : ?>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #6998AB;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/logo/<?= $hotel['logo_secondary'] ?>" width="30" alt="<?= $hotel['nama_hotel'] ?>"> <span class="bold"><?= $hotel['nama_hotel'] ?></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link <?= $_GET['page'] == 'index' ? 'active' : ''; ?>" href="./index.php?page=index">Beranda</a>
                    <a class="nav-link <?= $_GET['page'] == 'kamar' ? 'active' : ''; ?>" href="./kamar.php?page=kamar">Kamar</a>
                    <a class="nav-link <?= $_GET['page'] == 'fasilitas' ? 'active' : ''; ?>" href="./fasilitas.php?page=fasilitas">Fasilitas</a>
                    <a class="nav-link" href="./logic/login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>
<?php endif; ?>