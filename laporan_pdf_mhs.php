<?php
#panggil koneksi databasenya
require('plugins/fpdf17/fpdf.php');
include "config/koneksi.php";

#masukan ke array data yang akan ditampilkan
$query = "select * from mahasiswa,jurusan where mahasiswa.id_jur=jurusan.id_jur order by nim DESC" ;
$sql = mysql_query ($query);
$data = array();
while ($row = mysql_fetch_assoc($sql)) {
array_push($data, $row);
}
#setting judul laporan dan header tabel
$judul = "LAPORAN DATA PEMBAYARAN";
$header = array(
array("label"=>"NIM", "length"=>20, "align"=>"C"),
array("label"=>"NAMA", "length"=>40, "align"=>"C"),
array("label"=>"TAHUN MASUK", "length"=>25, "align"=>"C"),
array("label"=>"JURUSAN", "length"=>25, "align"=>"C"),
);

#panggil library FPDF dan bentuk objek
#require_once('plugins/fpdf17/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage('L', '');

#cetak judul laporan
$pdf->SetFont('Arial','B','14');
$pdf->Cell(0,20, $judul, '0', 1, 'C');
#buat header tabel
$pdf->SetFont('Arial','','10');
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
foreach ($header as $kolom) {
$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0',
$kolom['align'], true);
}
$pdf->Ln();
#tampilkan data dari tabel
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill=false;
foreach ($data as $baris) {
$i = 0;
foreach ($baris as $cell) {
$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0',
$kolom['align'], $fill);
$i++;
}
$fill = !$fill;
$pdf->Ln();
}
#cetak file PDF
$pdf->Output();
?>