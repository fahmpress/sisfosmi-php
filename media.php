<?php 
session_start();
error_reporting(0);
include "timeout.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>POLITEKNIK SUKABUMI</title>
<link rel="stylesheet" href="css/style.css" type="text/css"  />
<script src="js/jquery-1.4.js" type="text/javascript"></script>
<script src="js/superfish.js" type="text/javascript"></script>
<script src="js/hoverIntent.js" type="text/javascript"></script>

	<script type="text/javascript">
      $(document).ready(function(){
			   $('ul.nav').superfish();
		  });
  </script>
</head>

<body>

<div id="menu">
	<ul class="nav">
        <li><div id="header2">POLITEKNIK SUKABUMI</div></li>
        <? if ($_SESSION['leveluser']=='3'){ ?>
	<li><a class="border link linkback" href="?module=user">Home</a></li>
	<li><a class="border link linkback" href="?module=mhs&act=detail&id=<? echo "$_SESSION[namauser]";?>">Profile</a></li>
        <li><a class="border link linkback" href="?module=mhs&act=byrusr&id=<? echo "$_SESSION[namauser]";?>">Data Pembayaran</a></li>
	<li><a class="border link linkback" href="#"><? echo "$_SESSION[nama]";?></a>
            <ul><li><a class="border link linkback" href="logout.php">Logout</a></li></ul>
        </li>
            <?php 
	}
	if ($_SESSION['leveluser']=='1'){
	?>
    	<li><a class="border link linkback" class="border link linkback" href="?module=mhs">Data Mahasiswa</a>
            <ul>
            <li><a class="border link linkback" href="?module=mhs&act=input" class="li">Tambah Data</a></li>
            <li><a class="border link linkback" href="?module=mhs&act=cari" class="li">Cari Data</a></li>
            </ul>
        	</li>
         <li><a class="border link linkback" href="?module=jur" class="li">Data Jurusan</a>
             </li>
        <li><a class="border link linkback" href="?module=byr">Pembayaran</a>
        <ul>
             <li><a class="border link linkback" href="?module=byr&act=input" class="li">Pembayaran Baru</a></li>
             <li><a class="border link linkback" href="?module=byr&act=cari" class="li">Cari Data</a></li>
             </ul>
        </li>
        <li><a class="border link linkback" href="?module=usrmgr">User Manager</a>
        <ul>
            <li><a class="border link linkback" href="?module=usrmgr&act=cari" class="li">Cari Data</a></li>
             </ul>       
        </li>
        <li><a class="border link linkback" href="#">Laporan</a>
        	<ul>
                    <li><a class="border link linkback" href="laporan_mhs.php" target="_blank">Data Mahasiswa</a>
                        <ul><li><a class="border link linkback" href="?module=laporan">Filter Data</a></li></ul></li>
        <li><a class="border link linkback" href="laporan_user.php" target="_blank">Data User</a>
         <ul><li><a class="border link linkback" href="?module=laporan&act=user">Filter Data</a></li></ul></li>
			<li><a class="border link linkback" href="laporan_bayar.php" target="_blank" class="li" >Data Transaksi</a>
                            <ul><li><a class="border link linkback" href="?module=laporan&act=byr">Filter Data</a></li></ul></li>
            <li><a class="border link linkback" href="laporan_statistik.php" target="_blank" class="li">Laporan Data Statistik</a></li>
            </ul>
            <li><a class="border link linkback" href="#">Administrator</a>
            <ul><li><a class="border link linkback" href="logout.php">Logout</a></li></ul>
        </li>
        </li>
	<?php } 
	if($_SESSION['leveluser']=='2'){
	?>
        <li><a class="border link linkback" href="laporan_mhs.php" target="_blank">Data Mahasiswa</a>
            <ul>
            <li><a class="border link linkback" href="?module=laporan" >Filter Data</a></li>
            </ul>
        </li>
        <li><a class="border link linkback" href="laporan_user.php" target="_blank">Data User</a>
        <ul>
            <li><a class="border link linkback" href="?module=laporan&act=user" >Filter Data</a></li>
            </ul>
        </li>
        
		<li><a class="border link linkback" href="laporan_bayar.php" target="_blank" class="li" >Data Transaksi</a>
        	<ul>
			<li><a class="border link linkback" href="?module=laporan&act=byr" class="li" >Filter Data</a></li>
                </ul></li>
            <li><a class="border link linkback" href="laporan_statistik.php" target="_blank" class="li">Statistik</a></li>
            <li><a class="border link linkback" href="#">Manager</a>
            <ul><li><a class="border link linkback" href="logout.php">Logout</a></li></ul>
        </li>
        <?php } ?>
        <li class="clear"></li>
    </ul>
</div>
    <div id="container">
<div id="content">
<div class="form">
	<?php include "link.php"; ?>
</div>
</div>
</div>
    <div id="footer">Copyright &copy; 2013 by |fahm DIGITAL ART&trade;| (persada.fahmi@gmail.com).</div>
</body>
</html>
