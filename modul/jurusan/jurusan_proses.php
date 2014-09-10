<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";

$module=$_GET['module'];
$act=$_GET['act'];


if($module=='jur' AND $act=='input' ){
	mysql_query("insert into jurusan set id_jur='$_POST[id]', n_jur='$_POST[nama]', kajur='$_POST[kajur]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='jur' AND $act=='edit' ){
	mysql_query("update jurusan set n_jur='$_POST[nama]', kajur='$_POST[kajur]' where id_jur='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='jur' AND $act=='hapus' ){
	mysql_query("delete from jurusan where id_jur='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>