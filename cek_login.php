<?php
include "config/koneksi.php";

$username = $_POST['username'];
$pass     = $_POST['password'];

// pastikan username dan password adalah berupa huruf atau angka.
$login3=mysql_query("SELECT * FROM mahasiswa WHERE nim='$username'");
$r3=mysql_fetch_array($login3);
$login2=mysql_query("SELECT * FROM bayar WHERE nim='$username'");
$r2=mysql_fetch_array($login2);
$login=mysql_query("select * from user where userid='$username' AND passid='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  $_SESSION[namauser]     = $r[userid];
  $_SESSION[passuser]     = $r[passid];
  $_SESSION[leveluser]    = $r[level_user];
  $_SESSION[idbayar]      = $r2[id_bayar];
  $_SESSION[nama]         = $r3[nama];
  
  
  if($_SESSION[leveluser]==1){
	header('location:media.php?module=home');
  } else if($_SESSION[leveluser]==2){
	header('location:media.php?module=home');
  } if($_SESSION[leveluser]==3){
	header('location:media.php?module=user');
  }
}
else{
  include "error-login.php";
}
?>
