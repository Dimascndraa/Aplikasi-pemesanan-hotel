<?php
ini_set('date.timezone', 'Asia/Jakarta');
$koneksi = mysqli_connect("localhost", "root", "", "aplikasi_hotel");
// if (!$_SESSION) {
//     $_SESSION['login'] = 0;
// }
// if (!$_SESSION['login']) {
//     $_SESSION['login'] = 0;
// } else {
//     $_SESSION['login'] = 1;
//     $id = $_SESSION['id'];
//     $user = query("SELECT * FROM pelanggan WHERE id = '$id'")[0];
// }

// ========================================= LOGIC ===============================================================================================================  
function query($query)
{
    global $koneksi;
    $hasil = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($hasil)) {
        $rows[] = $row;
    }
    return $rows;
}

function checkOut()
{
}

function rupiah($angka)
{

    $hasil_rupiah = number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function tanggal_indonesia($tanggal)
{
    $bulan = array(
        1 =>       'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $var = explode('-', $tanggal);
    return $var[2] . ' ' . $bulan[(int)$var[1]] . ' ' . $var[0];
}
// ========================== Akhir LOGIC =====================================================================================================================  

// ========================== FUNCTION Profil Petugas ==============================================================================================================
// ============ tambah
function tambahPetugas($data)
{
    global $koneksi;

    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $password = hash('sha256', mysqli_real_escape_string($koneksi, htmlspecialchars($data['password'])));
    $konfirmasiPassword = hash('sha256', mysqli_real_escape_string($koneksi, htmlspecialchars($data['confirm-password'])));
    $email = htmlspecialchars($data['email']);
    $telp = htmlspecialchars($data['telp']);
    $role = htmlspecialchars($data['role']);
    $jenisKelamin = htmlspecialchars($data['jenis-kelamin']);

    // cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM pegawai WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username sudah terdaftar!');
            </script>";
        return false;
    }

    if ($password !== $konfirmasiPassword) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    $foto = "default-" . $data['jenis-kelamin'] . ".png";
    $query = "INSERT INTO pegawai VALUES ('', '$foto', '$nama', '$email', '$jenisKelamin', '$username', '$password', '$telp', '$role')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// ========= ubah
function ubahProfilePetugas($data)
{
    global $koneksi;
    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $telp = htmlspecialchars($data['telp']);
    $email = htmlspecialchars($data['email']);
    $role = htmlspecialchars($data['level']);
    $fotoLama = htmlspecialchars($data['foto-lama']);

    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = uploadProfilePetugas();
        if ($fotoLama !== "default-laki-laki.png " && $fotoLama !== "default-perempuan.png") {
            unlink('../img/profil/' . $fotoLama);
        }
    }

    mysqli_query($koneksi, "UPDATE pegawai SET 
                    foto = '$foto', 
                    nama = '$nama', 
                    email = '$email', 
                    username = '$username', 
                    telp = '$telp', 
                    role = '$role' 
                    WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}

// ============ ubah password
function ubahPasswordPegawai($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $passwordLama = htmlspecialchars(hash('sha256', $data['password-lama']));
    $passwordBaru = htmlspecialchars($data['password']);
    $konfirmasiPassword = htmlspecialchars($data['konfirmasi-password']);

    $result = mysqli_query($koneksi, "SELECT password FROM pegawai WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($passwordLama !== $row['password']) {
        echo "<script>
            alert('Password lama tidak sesuai');
            </script>";
        return false;
    }

    if ($passwordBaru !== $konfirmasiPassword) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    $passwordBaru = hash('sha256', mysqli_real_escape_string($koneksi, htmlspecialchars($data['password'])));

    mysqli_query($koneksi, "UPDATE pegawai SET password = '$passwordBaru' WHERE id = $id");
    return mysqli_affected_rows($koneksi);
}

// ========= upload
function uploadProfilePetugas()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar');
                  </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
                    alert('Ukuran gambar terlalu besar');
                  </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/profil/' . $namaFileBaru);

    return $namaFileBaru;
}
// ========================== Akhir FUNCTION Profil Petugas =================================================================================================================

// ========================== FUNCTION Profil Pelanggan =================================================================================================================
// ============ tambah
function daftarAkun($data)
{
    global $koneksi;

    $nama = htmlspecialchars($data['nama']);
    $jenisKelamin = htmlspecialchars($data['jenis-kelamin']);
    $telp = htmlspecialchars($data['telp']);
    $alamat = htmlspecialchars($data['alamat']);
    $email = htmlspecialchars($data['email']);
    $username = strtolower(stripslashes(htmlspecialchars($data['username'])));
    $password = hash('sha256', mysqli_real_escape_string($koneksi, htmlspecialchars($data['password'])));
    $konfirmasiPassword = hash('sha256', mysqli_real_escape_string($koneksi, htmlspecialchars($data['confirm-password'])));

    // cek username sudah ada atau belum
    $result = mysqli_query($koneksi, "SELECT username FROM pelanggan WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
            document.location.href = '?pesan=username-invalid';
        </script>";
        $_SESSION = $_POST;
        return false;
    }

    if ($password !== $konfirmasiPassword) {
        echo "<script>
                document.location.href = '?pesan=password-invalid';
        </script>";
        $_SESSION = $_POST;
        return false;
    }

    $foto = "default-" . $data['jenis-kelamin'] . ".png";
    $query = "INSERT INTO pelanggan VALUES ('', '$nama', '$jenisKelamin', '$telp', '$alamat', '$email', '', '$username', '$password','$foto')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// ========= ubah
function ubahAkun($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $jenisKelamin = htmlspecialchars($data['jenis-kelamin']);
    $telp = htmlspecialchars($data['telp']);
    $alamat = htmlspecialchars($data['alamat']);
    $email = htmlspecialchars($data['email']);
    $gambarLama = htmlspecialchars($data['gambar-lama']);

    if ($_FILES['foto']['error'] === 4) {
        $foto = $gambarLama;
    } else {
        $foto = uploadProfil();
        if ($gambarLama !== "default-laki-laki.png" && $gambarLama !== "default-perempuan.png") {
            unlink('img/profil/' . $gambarLama);
        }
    }

    $query = "UPDATE pelanggan SET
            nama = '$nama',
            username = '$username',
            jenis_kelamin = '$jenisKelamin',
            telp = '$telp',
            alamat = '$alamat',
            email = '$email',
            foto = '$foto'
            WHERE id = $id";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// ========= ubah password
function ubahPassword($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $passwordLama = htmlspecialchars(hash('sha256', $data['password-lama']));
    $passwordBaru = htmlspecialchars($data['password']);
    $konfirmasiPassword = htmlspecialchars($data['konfirmasi-password']);

    $result = mysqli_query($koneksi, "SELECT password FROM pelanggan WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if ($passwordLama !== $row['password']) {
        echo "<script>
            alert('Password lama tidak sesuai');
            </script>";
        return false;
    }

    if ($passwordBaru !== $konfirmasiPassword) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    $passwordBaru = hash('sha256', mysqli_real_escape_string($koneksi, $passwordBaru));

    $query = "UPDATE pelanggan SET
            password = '$passwordBaru'
            WHERE id = $id";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// ========= upload
function uploadProfil()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar');
                  </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar');
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/profil/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapusAkun($id)
{
    global $koneksi;
    //menghapus gambar difolder
    $pelanggan = query("SELECT * FROM pelanggan WHERE id = $id");
    if ($pelanggan['gambar'] != 'default-laki-laki.jpg' && $pelanggan['gambar'] != 'default-perempuan.jpg') {
        unlink('img/' . $pelanggan['gambar']);
    }
    mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id = $id") or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}
// ========================== Akhir FUNCTION Profil Pelanggan ======================================================================================================

// ========================== FUNCTION Pemesanan ======================================================================================================================
// ============ tambah
function tambahPesanan($data)
{
    global $koneksi;

    $idPelanggan = $data['id'];
    $tipeKamar = htmlspecialchars($data['tipe-kamar']);
    $hargaPermalam = htmlspecialchars($data['harga']);
    $jumlahKamar = htmlspecialchars($data['jumlah-kamar']);
    $namaPemesan = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $noTelp = htmlspecialchars($data['telp']);
    $checkIn = htmlspecialchars($data['cekin']);
    $checkOut = htmlspecialchars($data['cekout']);
    $durasiMenginap = htmlspecialchars($data['durasi']);
    $totalBiaya = htmlspecialchars($data['total-biaya']);
    $batasBayar = date('Y-m-d 12:00', strtotime('1 day'));
    $bayar = date('Y-m-d H:i');


    $query = "INSERT INTO `pemesanan` VALUES ('', '$idPelanggan', '$bayar', '$checkIn', '$checkOut', '$tipeKamar', '$hargaPermalam', '$jumlahKamar', '$namaPemesan', '$alamat', '$noTelp', '$durasiMenginap', '$totalBiaya', 'belum dibayar', '$batasBayar')";

    for ($i = 1; $i <= $jumlahKamar; $i++) {
        $nomorKamar = htmlspecialchars($data["nomor-kamar-$i"]);
        mysqli_query($koneksi, "UPDATE kamar SET status = 'dipesan' WHERE no_kamar = '$nomorKamar'");
        mysqli_query($koneksi, "UPDATE kamar SET tgl_pemesanan = '$bayar' WHERE no_kamar = '$nomorKamar'");
        mysqli_query($koneksi, "UPDATE kamar SET tgl_check_out = '$checkOut' WHERE no_kamar = '$nomorKamar'");
    }
    mysqli_query($koneksi, $query);
    mysqli_query($koneksi, "UPDATE stok_kamar SET stok = stok-$jumlahKamar WHERE tipe = '$tipeKamar'");

    return mysqli_affected_rows($koneksi);
}

// ============ batal 
function batalkanPesanan($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $tipeKamar = htmlspecialchars($data['tipe-kamar']);
    $jumlahKamar = htmlspecialchars($data['jumlah-kamar']);
    $tglPemesanan = htmlspecialchars($data['tgl-pemesanan']);
    $data = query("SELECT * FROM kamar WHERE tgl_pemesanan = '$tglPemesanan'");

    mysqli_query($koneksi, "UPDATE stok_kamar SET stok = stok+$jumlahKamar WHERE tipe = '$tipeKamar'");
    mysqli_query($koneksi, "UPDATE pemesanan SET status = 'batal' WHERE id = '$id'");
    foreach ($data as $row) {
        $nomorKamar = $row['no_kamar'];
        mysqli_query($koneksi, "UPDATE kamar SET status = 'tersedia', tgl_pemesanan = NULL, tgl_check_out = NULL WHERE no_kamar = '$nomorKamar'");
    }

    return mysqli_affected_rows($koneksi);
}

// ============ checkout
function checkoutPesanan($data)
{
    global $koneksi;

    $id = htmlspecialchars($data['id']);
    $jumlahKamar = htmlspecialchars($data['jumlah-kamar']);
    $tipeKamar = htmlspecialchars($data['tipe-kamar']);
    $tglPemesanan = htmlspecialchars($data['tgl-pemesanan']);
    $data = query("SELECT * FROM kamar WHERE tgl_pemesanan = '$tglPemesanan'");

    foreach ($data as $row) {
        $nomorKamar = $row['no_kamar'];
        mysqli_query($koneksi, "UPDATE kamar SET status = 'tersedia', tgl_pemesanan = NULL, tgl_check_out = NULL WHERE no_kamar = '$nomorKamar'");
    }

    mysqli_query($koneksi, "UPDATE pemesanan SET status = 'check out' WHERE id = '$id'");
    mysqli_query($koneksi, "UPDATE stok_kamar SET stok = stok+$jumlahKamar WHERE tipe = '$tipeKamar'");

    return mysqli_affected_rows($koneksi);
}

// ============ hapus
function hapusPesanan($id)
{
    $id = $_GET['id'];

    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id = $id") or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}


// ========================== Akhir FUNCTION Pemesanan ==========================================================================================================


// ========================== FUNCTION Pembayaran ====================================================================================================================
// ============= tambah
function tambahPembayaran($data)
{
    global $koneksi;
    $namaPemesan = htmlspecialchars($data['nama-pembayar']);
    $bank = htmlspecialchars($data['bank']);
    $nomorRekening = htmlspecialchars($data['nomor-rekening']);
    $namaPemilikKartu = htmlspecialchars($data['nama-pemilik-kartu']);
    $jumlahBayar = htmlspecialchars($data['total-bayar']);
    // $bukti = htmlspecialchars($data['bukti']);
    $jumlah = htmlspecialchars($data['jumlah-kamar']);
    $id = htmlspecialchars($data['id']);

    // upload gambar
    $bukti = uploadBuktiTF();
    if (!$bukti) {
        return false;
    }

    $bayar = date('Y-m-d', strtotime('1 day'));

    $pembayaran = tanggal_indonesia(date('Y-m-d'));

    $query = "INSERT INTO pembayaran VALUES('', $id, '$pembayaran', '$namaPemesan', '$bank', '$nomorRekening', '$namaPemilikKartu', '$jumlahBayar','$bukti')";
    for ($i = 1; $i <= intval($jumlah); $i++) {
        $nomorKamar = htmlspecialchars($data["nomor-kamar-$i"]);
        mysqli_query($koneksi, "UPDATE kamar SET status = 'terisi' WHERE no_kamar = '$nomorKamar'");
    }

    mysqli_query($koneksi, $query);
    mysqli_query($koneksi, "UPDATE pemesanan SET status = 'pending' WHERE id = '$id'");
    return mysqli_affected_rows($koneksi);
    header("Location: ./pesanan.php");
}

// ============= upload
function uploadBuktiTF()
{
    $namaFile = $_FILES['bukti']['name'];
    $ukuranFile = $_FILES['bukti']['size'];
    $error = $_FILES['bukti']['error'];
    $tmpName = $_FILES['bukti']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar');
                  </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
                    alert('Ukuran gambar terlalu besar');
                  </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/bukti/' . $namaFileBaru);

    return $namaFileBaru;
}

// ============ hapus
function hapusPembayaran($id)
{
    $id = $_GET['id'];

    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM pembayaran WHERE id = $id") or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}

// =========================== Akhir FUNCTION Pembayaran =================================================================================================================


// =========================== FUNCTION Data Hotel ===================================================================================================================
// ============== Tambah Kamar
function tambahKamar($data)
{
    global $koneksi;
    $idStokKamar = htmlspecialchars($data["id-stok-kamar"]);
    $jenisKamar = htmlspecialchars($data["tipe-kamar"]);
    $gambar = htmlspecialchars($data["gambar"]);
    $nomorKamar = htmlspecialchars($data["no-kamar"]);
    $tarif = htmlspecialchars($data["tarif"]);

    $jumlahTambah = htmlspecialchars($data['jumlah']);
    mysqli_query($koneksi, "INSERT INTO kamar VALUES ('', '$idStokKamar', '$jenisKamar', '$gambar', '$nomorKamar', 'tersedia', null, null, '$tarif')");
    mysqli_query($koneksi, "UPDATE stok_kamar SET stok = stok+$jumlahTambah WHERE tipe = '$jenisKamar'");
    mysqli_query($koneksi, "UPDATE stok_kamar SET jumlah_kamar = jumlah_kamar+$jumlahTambah WHERE tipe = '$jenisKamar'");
    return mysqli_affected_rows($koneksi);
}

// ============== Identitas Hotel
function ubahIdentitasHotel($data)
{
    global $koneksi;
    $namaHotel = htmlspecialchars($data['nama-hotel']);
    $nomorRekening = htmlspecialchars($data['rekening-hotel']);
    $telp = htmlspecialchars($data['telp-hotel']);
    $alamat = htmlspecialchars($data['alamat-hotel']);
    $email = htmlspecialchars($data['email-hotel']);
    $logoPrimaryLama = htmlspecialchars($data['logo-primary-lama']);
    $logoSecondaryLama = htmlspecialchars($data['logo-secondary-lama']);

    if ($_FILES['logo-primary']['error'] === 4) {
        $logoPrimary = $logoPrimaryLama;
    } else {
        $logoPrimary = uploadLogoPrimary();
    }

    if ($_FILES['logo-secondary']['error'] === 4) {
        $logoSecondary = $logoSecondaryLama;
    } else {
        $logoSecondary = uploadLogoSecondary();
    }

    mysqli_query($koneksi, "UPDATE identitas SET nama_hotel = '$namaHotel', no_rekening = '$nomorRekening', telp = '$telp', alamat = '$alamat', email = '$email', logo_primary = '$logoPrimary', logo_secondary = '$logoSecondary'");

    return mysqli_affected_rows($koneksi);
}

// ============== Sosial Media
function ubahSosialMedia($data)
{
    global $koneksi;
    $identitas = query("SELECT * FROM identitas")[0];

    $facebook = htmlspecialchars($data['facebook']);
    $instagram = htmlspecialchars($data['instagram']);
    $whatsapp = htmlspecialchars($data['whatsapp']);
    $twtter = htmlspecialchars($data['twitter']);
    $email = htmlspecialchars($data['email']);

    mysqli_query($koneksi, "UPDATE sosial_media SET facebook = '$facebook', instagram = '$instagram', whatsapp = '$whatsapp', twitter = '$twtter'");
    if ($email !== $identitas['email']) {
        mysqli_query($koneksi, "UPDATE identitas SET email = '$email'");
    }


    return mysqli_affected_rows($koneksi);
}

// ============== Upload Logo Primary
function uploadLogoPrimary()
{
    $namaFile = $_FILES['logo-primary']['name'];
    $ukuranFile = $_FILES['logo-primary']['size'];
    $error = $_FILES['logo-primary']['error'];
    $tmpName = $_FILES['logo-primary']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar');
                  </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
                    alert('Ukuran gambar terlalu besar');
                  </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/logo/' . $namaFileBaru);

    return $namaFileBaru;
}

// ============== Upload Logo Secondary
function uploadLogoSecondary()
{
    $namaFile = $_FILES['logo-secondary']['name'];
    $ukuranFile = $_FILES['logo-secondary']['size'];
    $error = $_FILES['logo-secondary']['error'];
    $tmpName = $_FILES['logo-secondary']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar');
                  </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
                    alert('Ukuran gambar terlalu besar');
                  </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/logo/' . $namaFileBaru);

    return $namaFileBaru;
}
// =========================== Akhir Function Data Hotel =======================================================================================================

// =========================== Function Data Fasilitas ================================================
// ========== Tambah Fasilitas
function tambahFasilitas($data)
{
    global $koneksi;

    $fasilitas = htmlspecialchars($data['fasilitas']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $tipeKamar = htmlspecialchars($data['tipe-kamar']);
    $gambar = uploadFasilitas();
    if (!$gambar) {
        return false;
    }

    if ($tipeKamar == "superior") {
        $harga = "410000";
    } elseif ($tipeKamar == "deluxe") {
        $harga = "450000";
    }

    $query = "INSERT INTO fasilitas VALUES ('','$tipeKamar','$fasilitas','$gambar','$deskripsi','$harga')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// ========== Ubah Fasilitas
function ubahFasilitas($data)
{
    global $koneksi;

    $idFasilitas = htmlspecialchars($data['id-fasilitas']);
    $fasilitas = htmlspecialchars($data['fasilitas']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $tipeKamar = htmlspecialchars($data['tipe-kamar']);
    $gambarLama = htmlspecialchars($data['gambar-lama']);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = uploadFasilitas();
        unlink('../img/fasilitas/' . $gambarLama);
    }

    $query = "UPDATE fasilitas SET 
                tipe_kamar = '$tipeKamar', 
                fasilitas = '$fasilitas', 
                gambar = '$gambar', 
                deskripsi = '$deskripsi' 
                WHERE id = $idFasilitas";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// ========== Upload Gambar Fasilitas
function uploadFasilitas()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar');
                  </script>";

        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
                    alert('Ukuran gambar terlalu besar');
                  </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/fasilitas/' . $namaFileBaru);

    return $namaFileBaru;
}

// ========== Hapus Fasilitas
function hapusFasilitas($id)
{
    global $koneksi;
    //menghapus gambar difolder
    $fasilitas = query("SELECT * FROM fasilitas WHERE id = $id")[0];
    unlink('../img/fasilitas/' . $fasilitas['gambar']);
    mysqli_query($koneksi, "DELETE FROM fasilitas WHERE id = $id") or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}

// =========================== Akhir Function Data Fasilitas ============================================