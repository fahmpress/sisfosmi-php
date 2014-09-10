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

$dataPerPage = 15;
            if(isset($_GET['page']))
{
$noPage = $_GET['page'];
}
else $noPage = 1;
// perhitungan offset
$offset = ($noPage - 1) * $dataPerPage;
        $ket=$_POST[ket];
	$tgl= date('Y-m-d');
$op=$_GET['op'];
switch($_GET[act]){
	default:
	$kueri="select bayar.smstr, bayar.id_bayar, mahasiswa.nama, mahasiswa.nim, jurusan.n_jur, bayar.tgl_bayar, bayar.jml_bayar, bayar.ket
        from bayar, jurusan, mahasiswa where bayar.nim=mahasiswa.nim and mahasiswa.id_jur=jurusan.id_jur
        and jurusan.id_jur=$_POST[jurusan] and mahasiswa.thn_masuk=$_POST[tahun] and bayar.smstr=$_POST[semester] and bayar.ket='$ket' order by id_bayar desc LIMIT $offset, $dataPerPage";
        $tampil=mysql_query($kueri);
    /* @var $data type */
        $data=mysql_fetch_array($tampil);
        if($data>=1){
	echo "<h2 class='head'>LAPORAN DATA TRANSAKSI JURUSAN $data[n_jur] ANGKATAN $_POST[tahun] SEMESTER $data[smstr]</h2>
         ";
	echo "<table class='tabel'>
	<thead>
  <tr>
    <td><center>No</center></td>
    <td><center>ID Transaksi</center></td>
    <td><center>NIM</center></td>
    <td><center>Nama Mahasiswa</center></td>
    <td><center>Jurusan</center></td>
    <td><center>Semester</center></td>
    <td><center>Tanggal Bayar</center></td>
    <td><center>Jumlah Bayar</center></td>
    <td><center>Keterangan</center></td>
    <td><center>Kontrol</center></td>
	</tr>
  </thead>";
  $no=1;
  $tampil2=mysql_query($kueri);
  while($dt=mysql_fetch_array($tampil2)){
  echo "<tr>
    <td><center>$no</center></td>
      <td><center>$dt[id_bayar]</center></td>
    <td><center>$dt[nim]</center></td>
    <td>$dt[nama]</td>
      <td>$dt[n_jur]</td>
      <td><center>$dt[smstr]</center></td>
     <td><center>".tgl_indo($dt['tgl_bayar'])."</center></td>
      <td><center>$dt[jml_bayar]</center></td>
      <td><center>$dt[ket]</center></td>
	<td><a href='laporan_bayar_histori.php?id=$dt[nim]'>Histori</a></span><span>
    </tr>";
  $no++;
  }
echo "  
</table>";

$query = "SELECT COUNT(*) AS jumData FROM jurusan, mahasiswa, bayar where jurusan.id_jur=mahasiswa.id_jur and mahasiswa.nim=bayar.nim and jurusan.id_jur=$_POST[jurusan] and mahasiswa.thn_masuk=$_POST[tahun] and bayar.smstr=$_POST[semester]" ;
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$jumData = $data['jumData'];
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$dataPerPage);
// menampilkan link previous

if ($noPage > 1) echo "<input type=button value='&lt;&lt;Prev' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=byr&page=".($noPage-1)."';\">";
    
// memunculkan nomor halaman dan linknya
for($page = 1; $page <= $jumPage; $page++)
{
if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
{
if (($showPage == 1) && ($page != 2)) echo "...";
if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) echo "...";
if ($page == $noPage) echo " <b>".$page."</b> ";
else echo "<input type=button value='".$page."' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=byr&page=".$page."';\">";
$showPage = $page;
}
}
// menampilkan link next
if ($noPage < $jumPage) echo "<input type=button value='Next&gt;&gt;' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=byr&page=".($noPage+1)."';\">";

echo "<div style='text-align:center;padding:20px;'>
 <input type=button value='PDF' onclick=\"window.location.href='laporan_pdf.php';\">
        <input type=button value='Excel' onclick=\"window.location.href='laporan_excel.php';\">
         <input type=button value='Print' onclick='window.print()'>
	</div>";
        }else{
            echo "<h2 class='head'>Data tidak ditemukan</h2>";
        }
        
        break;
        
        }?>
    
	
</div>
</body>
</html>
