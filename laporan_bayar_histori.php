<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>POLITEKNIK SUKABUMI</title>
<link rel="stylesheet" href="css/print.css" type="text/css"  />
</head>
<style>
@media print {
input.noPrint { display: none; }
}
</style>
<body class="body">
<div id="wrapper">
<?php
include "config/koneksi.php";

include "config/fungsi_indotgl.php";
include "config/class_paging.php";
include "config/kode_auto.php";
include "config/fungsi_combobox.php";
include "config/fungsi_nip.php";

$tampil=mysql_query("select bayar.smstr, bayar.id_bayar, mahasiswa.nama, mahasiswa.nim, jurusan.n_jur, bayar.tgl_bayar, bayar.jml_bayar, bayar.ket
from bayar, jurusan, mahasiswa where bayar.nim=mahasiswa.nim and mahasiswa.id_jur=jurusan.id_jur and mahasiswa.nim='$_GET[id]' order by id_bayar asc");
$data=mysql_fetch_array($tampil);           
echo "<h2 class='head'>HISTORI PEMBAYARAN</h2>
               <table style='border:0px;font-family: 'IstokWebRegular';'>
               <tr>
               <td>Nama     </td><td>:</td><td>$data[nama]</td>
               </tr>
               <tr>
               <td>Jurusan  </td><td>:</td><td>$data[n_jur]</td>
               </tr>
               </table>    
	<table class='tabel'>
	<thead>
       
  <tr>
     <td><center>No</center></td>
    <td><center>ID Transaksi</center></td>
    <td><center>Semester</center></td>
    <td><center>Tanggal Bayar</center></td>
    <td><center>Jumlah Bayar</center></td>
    <td><center>Keterangan</center></td>
    	</tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td><center>$no</center></td>
      <td><center>$dt[id_bayar]</center></td>
    <td><center>$dt[smstr]</center></td>
     <td><center>".tgl_indo($dt['tgl_bayar'])."</center></td>
      <td><center>$dt[jml_bayar]</center></td>
      <td><center>$dt[ket]</center></td>
	</tr>";
  $no++;
  }
echo "  
</table>

<div style='text-align:center;padding:20px;'>
 <input type=button value='PDF' onclick=\"window.location.href='laporan_pdf_mhs.php';\">
        <input type=button value='Excel' onclick=\"window.location.href='laporan_excel_mhs.php';\">
         <input type=button value='Print' onclick='window.print()'>
	</div>";
	?>
	
</div>
</body>
</html>
