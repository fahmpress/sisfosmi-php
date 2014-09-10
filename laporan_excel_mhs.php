<?php
error_reporting(E_ALL);
require('plugins/excel/PHPExcel.php');
include "config/koneksi.php";

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$no;
$query="select * from mahasiswa,jurusan where mahasiswa.id_jur=jurusan.id_jur order by nim DESC";
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

->setCellValue('B1', 'NIM')
->setCellValue('C1', 'Nama')
->setCellValue('D1', 'Tahun Masuk')
->setCellValue('E1', 'Jurusan');
$baris = 2;
$no = 0;
while($row=mysql_fetch_array($hasil)){
$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)

->setCellValue("B$baris", $row['nim'])
->setCellValue("C$baris", $row['nama'])
->setCellValue("D$baris", $row['thn_masuk'])
->setCellValue("E$baris", $row['n_jur']);
$baris = $baris + 1;
}
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Data Mahasiswa');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client�s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel' );
header('Content-Disposition: attachment;filename="Laporan Data Mahasiswa.xls"' );
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>