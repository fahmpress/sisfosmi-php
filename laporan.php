<?php 
switch($_GET[act]){
default :
    echo "<h2 class='head'>FILTER DATA MAHASISWA BERDASARKAN JURUSAN DAN ANGKATAN</h2>";     
    echo"<form action='laporan_mhs_filter.php' method='POST' target='_blank'>
	<table class='tabel2'>
        <tr>
        <td><div align='left'>";
combojur(jurusan);
$now =  date("Y");
combothn(2005, $now, tahun); "></td>";
echo"<input type=submit name=submit value=Tampilkan></tr></table></form> ";
            break;
        
 case "user":
        echo "<h2 class='head'>FILTER DATA USER BERDASARKAN JURUSAN DAN ANGKATAN</h2>"; 
        echo"<form action='laporan_user_filter.php' method='POST' target='_blank'>
	<table class='tabel2'>
        <tr>
        <td><div align='left'>";
combojur(jurusan);
$now =  date("Y");
combothn(2005, $now, tahun); "></td>";
echo"<input type=submit name=submit value=Tampilkan></tr></table></form> ";
            break;
        
 case "byr":
        echo "<h2 class='head'>FILTER DATA TRANSAKSI BERDASARKAN JURUSAN, ANGKATAN DAN SEMESTER</h2>"; 
        echo"<form action='laporan_bayar_filter.php?op=keterangan' method='POST' target='_blank'>
	<table class='tabel2'>
        <tr>
        <td><div align='left'>";
combojur(jurusan);
$now =  date("Y");
combothn(2005, $now, tahun); 
combosemester(semester); 
comboket(ket);
echo"<input type=submit name=submit value=Tampilkan></tr></table></form>";
            break;
}
?>