<?php

$servername = "localhost";

//HOW TO USE
//Example
//http://localhost/kpr/index.php?harga=(harga-properti)&dp=(uang-muka)&waktu=(lama-angsuran)&bunga=(bunga)
//http://localhost/kpr/index.php?harga=500000000&dp=90000000&waktu=5&bunga=10

$harga_properti = $_GET["harga"];
$uang_muka = $_GET["dp"];
$p_uang_muka = round($uang_muka/$harga_properti*100,2);
$lama_angsuran = $_GET["waktu"];
$bunga = $_GET["bunga"];
$p_bunga = $bunga/100;

//HITUNG
$pokok = $harga_properti - $uang_muka;
$angsuran = ($pokok * $p_bunga / 12) / (1 - pow((1 + $p_bunga / 12),(-($lama_angsuran * 12))));
$total_bunga = $angsuran * $lama_angsuran * 12;

$provisi = 0.01 * $pokok;
$bphtb = 0.05 * ($harga_properti - 50000000); //asumsi NJOPTK 50JUTA
$pnbp = 0.001 * $harga_properti;
$bbn = 0.01 * $harga_properti;

$biaya_lain = $provisi + $bphtb + $pnbp + $bbn;
$total_uang = $uang_muka + $biaya_lain;
$total_bayar = $total_uang + $total_bunga;

//KPR BROOOOO
//
//
echo "<h1>SIMULASI PERHITUNGAN KPR</h1>";

echo "<h2>INFORMASI YANG DIBUTUHKAN </h2>\n";
echo "Harga Properti        : Rp ".number_format($harga_properti)."<br>";
echo "Jumlah Uang Muka      : Rp ".number_format($uang_muka)."<br>";
echo "Persentase Uang Muka  : ".$p_uang_muka." %<br>";
echo "Lama Angsuran         : ".$lama_angsuran." tahun<br>";
echo "Bunga                 : ".$bunga." %<br>";


echo "<h2>HASIL PERHITUNGAN KPR </h2>\n";
echo "Pokok Kredit          : Rp ".number_format($pokok)."<br>";
echo "Angsuran Per Bulan    : Rp ".number_format($angsuran)."<br>";
echo "Total Bunga           : Rp ".number_format($total_bunga)."<br>";
echo "Biaya Lainnya         : Rp ".number_format($biaya_lain)."<br>";
echo "Total Pembayaran      : Rp ".number_format($total_bayar)."<br>";


echo "<h2>BIAYA YANG DIBUTUHKAN </h2>\n";
echo "Uang Muka                      : Rp ".number_format($uang_muka)."<br>";
echo "Biaya Provisi                  : Rp ".number_format($provisi)."<br>";
echo "Pajak Pembeli (BPHTB)          : Rp ".number_format($bphtb)."<br>";
echo "Penerimaan Negara Bukan Pajak  : Rp ".number_format($pnbp)."<br>";
echo "Biaya Balik Nama               : Rp ".number_format($bbn)."<br>";

echo "<h3>Total Uang di Awal             : Rp ".number_format($total_uang)."</h3>";
echo "<h3>Cicilan Per Bulan              : Rp ".number_format($angsuran)."</h3>";


?>