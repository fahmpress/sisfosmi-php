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
        $kueri="select jurusan.n_jur, jurusan.id_jur, user.userid, user.passid, user.level_user, mahasiswa.nama 
            from mahasiswa, user, jurusan where user.userid=mahasiswa.nim and mahasiswa.id_jur=jurusan.id_jur and mahasiswa.thn_masuk=$_POST[tahun] and jurusan.id_jur=$_POST[jurusan] order by userid desc LIMIT $offset, $dataPerPage";
	$tampil=mysql_query($kueri);
        $data=mysql_fetch_array($tampil);
        if($data>=1){
	echo "<h2 class='head'>LAPORAN DATA USER JURUSAN $data[n_jur] ANGKATAN $_POST[tahun]</h2>
	<table class='tabel'>
	<thead>
  <tr>
    <td>No</td>
    <td>Nama Mahasiswa</td>
    <td>Username</td>
    <td>Password</td>
	</tr>
  </thead>";
  $no=1;
  $tampil2=mysql_query($kueri);
  while($dt=mysql_fetch_array($tampil2)){
  echo "<tr>
    <td>$no</td>
    <td>$dt[nama]</td>
    <td>$dt[userid]</td>
      <td>$dt[passid]</td>
	</tr>";
  $no++;
  }
echo "  
</table>";

$query = "SELECT COUNT(*) AS jumData from mahasiswa, user, jurusan where user.userid=mahasiswa.nim and mahasiswa.id_jur=jurusan.id_jur and mahasiswa.thn_masuk=$_POST[tahun] and jurusan.id_jur=$_POST[jurusan]" ;
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$jumData = $data['jumData'];
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$dataPerPage);
// menampilkan link previous
if ($noPage > 1) echo "<input type=button value='&lt;&lt;Prev' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=usrmgr&page=".($noPage-1)."';\">";
// memunculkan nomor halaman dan linknya
for($page = 1; $page <= $jumPage; $page++)
{
if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
{
if (($showPage == 1) && ($page != 2)) echo "...";
if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) echo "...";
if ($page == $noPage) echo " <b>".$page."</b> ";
else echo "<input type=button value='".$page."' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=usrmgr&page=".$page."';\">";
$showPage = $page;
}
}
// menampilkan link next
if ($noPage < $jumPage) echo "<input type=button value='Next&gt;&gt;' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=usrmgr&page=".($noPage+1)."';\">";

echo"<div style='text-align:center;padding:20px;'>
 <input type=button value='PDF' onclick=\"window.location.href='laporan_pdf_user.php';\">
        <input type=button value='Excel' onclick=\"window.location.href='laporan_excel_user.php';\">
         <input type=button value='Print' onclick='window.print()'>
	</div>";
        }else{
            echo "<h2 class='head'>Data tidak ditemukan</h2>";
        }
	?>
	
</div>
</body>
</html>
