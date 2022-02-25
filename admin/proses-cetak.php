<?php
include "../logic/functions.php";

$bulan = $_POST['bulan'];
header("Location: print/print-data-pembayaran?bulan=$bulan");
