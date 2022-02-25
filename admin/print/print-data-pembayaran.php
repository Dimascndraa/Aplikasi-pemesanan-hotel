<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
include "../../logic/functions.php";
$dataPembayaran = query("SELECT * FROM `pembayaran` WHERE tgl_pembayaran LIKE '%$bulan%' && tgl_pembayaran LIKE '%$tahun%' ORDER BY id DESC");
$i = 1;

$html = '<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kamar</title>
</head>

<body>
    <h2 align=center>Data Pembayaran</h2>
        <table cellspacing="0" cellpadding="5" border="1" align="center">
            <thead style="text-align: center;">
                <tr>
                    <th>No</th>
                    <th>Nama Pembayar</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Bank</th>
                    <th>Nomor Rekening</th>
                    <th>Nama Pemilik Kartu</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody style="vertical-align: middle;">';
foreach ($dataPembayaran as $pembayaran) :
    $html .= '<tr>
                        <td align=center>' . $i++ . '</td>
                        <td align=center>' . $pembayaran['nama_pembayar'] . '</td>
                        <td align=center>' . tanggal_indonesia($pembayaran['tgl_pembayaran']) . '</td>
                        <td align=center>' . $pembayaran['bank'] . '</td>
                        <td align=center width=100>' . $pembayaran['no_rekening'] . '</td>
                        <td align=center>' . $pembayaran['nama_pemilik_kartu'] . '</td>
                        <td align=center>Rp.' . $pembayaran['total_akhir'] . '</td>
                    </tr>';
endforeach;
$html .= '</tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('data-kamar-deluxe.pdf', "I");
