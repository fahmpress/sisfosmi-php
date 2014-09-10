<?php
error_reporting(E_ALL);
require('plugins/excel/PHPExcel.php');
include "config/koneksi.php";

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$no;
$query="select bayar.id_bayar, mahasiswa.nama, mahasiswa.nim, bayar.tgl_bayar, bayar.jml_bayar, bayar.ket
from bayar, mahasiswa where bayar.nim=mahasiswa.nim order by id_bayar asc";
$hasil = mysql_query($query);
// Set properties
$objPHPExcel->getProperties()->setCreator("Leon")
->setLastModifiedBy("Leon")
->setTitle("Office 2007 XLSX Test Document")
->setSubject("Office 2007 XLSX Test Document")
->setDescription("Laporan Data Siswa .")
->setKeywords("office 2007 openxml php")
->setCategory("UMR 2013");
// Add some data
$objPHPExcel->setActiveSheetIndex(0)

->setCellValue('B1', 'Kode')
->setCellValue('C1', 'Nama')
->setCellValue('D1', 'Tanggal Bayar')
->setCellValue('E1', 'Jumlah Bayar')
->setCellValue('F1', 'Keterangan');
$baris = 2;
$no = 0;
while($row=mysql_fetch_array($hasil)){
$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)

->setCellValue("B$baris", $row['id_bayar'])
->setCellValue("C$baris", $row['nama'])
->setCellValue("D$baris", $row['tgl_bayar'])
->setCellValue("E$baris", $row['jml_bayar'])
->setCellValue("F$baris", $row['ket']);
$baris = $baris + 1;
}
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Data Pembayaran');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client�s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel' );
header('Content-Disposition: attachment;filename="Laporan Data Pembayaran.xls"' );
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>