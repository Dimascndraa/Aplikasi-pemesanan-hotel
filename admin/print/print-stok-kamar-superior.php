<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();

include "../../logic/functions.php";
$dataKamar = query("SELECT * FROM kamar WHERE jenis_kamar = 'superior' && status = 'tersedia' ORDER BY status DESC");
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
    <h2 align=center>Stok Kamar Superior</h2>
        <table cellspacing="0" cellpadding="10" border="1" align="center">
            <thead style="text-align: center;">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Jenis Kamar</th>
                    <th>Nomor Kamar</th>
                    <th>Status</th>
                    <th>Tarif</th>
                </tr>
            </thead>
            <tbody style="vertical-align: middle;">';
foreach ($dataKamar as $kamar) :
    $html .= '<tr>
                        <td align=center>' . $i++ . '</td>
                        <td align=center><img height=40 src="../../img/' . $kamar['gambar'] . '" class="d-block m-auto" height="100" alt=""></td>
                        <td align=center>' . ucfirst($kamar['jenis_kamar']) . '</td>
                        <td align=center>' . $kamar['no_kamar'] . '</td>
                        <td align=center width=100>' . ucfirst($kamar['status']) . '</td>
                        <td align=center>Rp.' . rupiah($kamar['tarif']) . '</td>
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
$mpdf->Output('stok-kamar-superior.pdf', "I");
