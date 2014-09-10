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
<div id="wrapper2">
<?php
include "config/koneksi.php";

include "config/fungsi_indotgl.php";
include "config/class_paging.php";
include "config/kode_auto.php";
include "config/fungsi_combobox.php";
include "config/fungsi_nip.php";

$ambil=mysql_query("select * from mahasiswa where nim='$_GET[id]'");
	$t=mysql_fetch_array($ambil);
	echo "<h2 class='head'>Data Mahasiswa</h2>
	<div class='rp' >
	<div class='foto'>";
	if($t[foto]==""){
		echo "<img src='image_mhs/no.jpg' width='200' height='240' />";
	} else {
	echo "<img src='image_mhs/small_$t[foto]' width='200' height='240' />";
	}
	echo "</div>
	<table class='tabelform tabpad'>
	<tr>
	<td>NIM</td><td>:</td><td>$t[nim]</td>
	</tr>
	<tr>
	<td>Nama</td><td>:</td><td>$t[nama]</td>
	</tr>
	<tr>
	<td>Tempat Lahir</td><td>:</td><td>$t[tmpt_lahir]</td>
	</tr>
	<tr>
	<td>Tanggal Lahir</td><td>:</td><td>"; 
	echo "".tgl_indo($t['tgl_lahir'])."";
	echo "</td>
	</tr>
	
	<tr>
	<td>Jenis Kelamin</td><td>:</td><td>";
	if($t['jenis_kelamin']=='L'){
	echo "Pria";
	} else {
	echo "Wanita";
	}	
	echo "</td></tr>
	
	<tr>
	<td>Alamat</td><td>:</td><td>$t[alamat]</td>
	</tr>
	
	<tr>
	<td>Tahun Masuk</td><td>:</td><td>$t[thn_masuk]</td>
	</tr>
	
	<tr>
	<td>Jurusan</td><td>:</td><td>";
	$bag=mysql_query("select * from jurusan where id_jur='$t[id_jur]'");
	$b=mysql_fetch_array($bag);
	echo "$b[n_jur]";	
	echo "</td>
	</tr>
				
	<div class='rp2'>
	<h2 class=''></h2>
	<table class='tabel'>	
	<thead>
	<tr>
	
	</tr>	
	</thead>";
	
	echo "
	</table>
	</div>
		<div style='clear:both'></div>
	";	
	?>
	<div style="text-align:center;padding:20px;">
	<input class="noPrint" type="button" value="Cetak Halaman" onclick="window.print()">
	<? echo "<input type=button value=Batal onclick=self.history.back()>";?>
	</div>
</div>
</body>
</html>
