<?php
error_reporting(E_ALL);
require('plugins/excel/PHPExcel.php');
include "config/koneksi.php";

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$no;
$query="select user.userid, user.passid, user.level_user, mahasiswa.nama 
            from mahasiswa, user where user.userid=mahasiswa.nim order by userid asc";
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

->setCellValue('B1', 'Nama')
->setCellValue('C1', 'Username')
->setCellValue('D1', 'Password');
$baris = 2;
$no = 0;
while($row=mysql_fetch_array($hasil)){
$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)

->setCellValue("B$baris", $row['nama'])
->setCellValue("C$baris", $row['userid'])
->setCellValue("D$baris", $row['passid']);
$baris = $baris + 1;
}
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Data User');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client�s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel' );
header('Content-Disposition: attachment;filename="Laporan Data User.xls"' );
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>