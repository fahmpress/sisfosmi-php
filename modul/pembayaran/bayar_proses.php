<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";

$module=$_GET['module'];
$act=$_GET['act'];


if($module=='byr' AND $act=='edit' ){
	mysql_query("update bayar set nim='$_POST[nim]', tgl_bayar='$_POST[tgl]', jml_bayar='$_POST[jml_byr]', smstr='$_POST[smstr]', ket='$_POST[ket]' where id_bayar='$_POST[id]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='byr' AND $act=='input' ){
	mysql_query("insert into bayar set nim='$_POST[nim]', tgl_bayar='$_POST[tgl]', jml_bayar='$_POST[jml_byr]', smstr='$_POST[smstr]', ket='$_POST[ket]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='byr' AND $act=='hapus' ){
	mysql_query("delete from jurusan where id_jur='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}


?>