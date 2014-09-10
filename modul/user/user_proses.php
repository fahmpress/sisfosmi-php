<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";

$module=$_GET['module'];
$act=$_GET['act'];


if($module=='usrmgr' AND $act=='edit' ){
	mysql_query("update user set passid='$_POST[pass]' where userid='$_POST[userid]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='usrmgr' AND $act=='hapus' ){
	mysql_query("delete from user where userid='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>