<?php 
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
include "../../config/class_paging.php";
include "../../config/kode_auto.php";
include "../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

if($module=='mhs' AND $act=='hapus' ){ 
	mysql_query("delete from mahasiswa where nim='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}

if($module=='mhs' AND $act=='input' ){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;
	if (!empty($lokasi_file)){  
	$tll="$_POST[tahun]-$_POST[bulan]-$_POST[hari]";
	$tm="$_POST[tm]-$_POST[bm]-$_POST[hm]";
	Uploadfoto($nama_file_unik);
	mysql_query("insert into mahasiswa set nim='$_POST[nim]',
										 nama='$_POST[nama]',
										 tmpt_lahir='$_POST[tls]',
										 tgl_lahir='$tll',
										 jenis_kelamin='$_POST[jk]',
										 alamat='$_POST[almt]',
										 thn_masuk='$_POST[thn_msk]',
										 id_jur='$_POST[jurusan]',
										 foto='$nama_file_unik'
										 ");
	mysql_query("insert into user set userid='$_POST[nim]', passid='$_POST[psl]', level_user='3'");
	
	echo "<script>alert('Input sukses!'); window.location = '../../media.php?module=mhs&act=input'</script>";
	} else {
	$tll="$_POST[tahun]-$_POST[bulan]-$_POST[hari]";
	$tm="$_POST[tm]-$_POST[bm]-$_POST[hm]";
	mysql_query("insert into mahasiswa set nim='$_POST[nim]',
										 nama='$_POST[nama]',
										 tmpt_lahir='$_POST[tls]',
										 tgl_lahir='$tll',
										 jenis_kelamin='$_POST[jk]',
										 alamat='$_POST[almt]',
										 tgl_masuk='$_POST[thn_msk]',
										 id_jur='$_POST[jurusan]',
										 ");
	mysql_query("insert into user set userid='$_POST[nip]', passid='$_POST[psl]', level_user='3'");
	echo "<script>alert('Input sukses!'); window.location = '../../media.php?module=mhs&act=input'</script>";
	}
}

elseif($module=='mhs' AND $act=='edit' ){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file;
	if (!empty($lokasi_file)){  
	$tll="$_POST[tl]-$_POST[btl]-$_POST[ttl]";
	$tm="$_POST[tt]-$_POST[bt]-$_POST[ht]";
	Uploadfoto($nama_file_unik);
	mysql_query("update mahasiswa set 	 nama='$_POST[nama]',
										 tmpt_lahir='$_POST[tls]',
										 tgl_lahir='$tll',
										 jenis_kelamin='$_POST[jk]',
										 alamat='$_POST[almt]',
										 thn_masuk='$_POST[thn_msk]',
										 id_jur='$_POST[jurusan]',
										 foto='$nama_file_unik'
										 where nim='$_POST[nim]'");
	
	header('location:../../media.php?module=mhs&act=detail&id='.$_POST['nim']);
	} else {
	$tll="$_POST[tl]-$_POST[btl]-$_POST[ttl]";
	$tm="$_POST[tt]-$_POST[bt]-$_POST[ht]";
	mysql_query("update mahasiswa set 	 nama='$_POST[nama]',
										 tmpt_lahir='$_POST[tls]',
										 tgl_lahir='$tll',
										 jenis_kelamin='$_POST[jk]',
										 alamat='$_POST[almt]',
										thn_masuk='$_POST[thn_msk]',
										 id_jur='$_POST[jurusan]',
										 foto='$nama_file_unik'
										 where nim='$_POST[nim]'");
	header('location:../../media.php?module=mhs&act=detail&id='.$_POST['nim']);
	}
}

elseif($module=='mhs' AND $act=='hapus' ){
	mysql_query("delete from mahasiswa where nip = '$_GET[id]'");
        mysql_query("delete from user where userid='$_GET[id]'");
	header('location:../../media.php?module='.$module);
}

elseif($module=='mhs' AND $act=='pwd' ){
	$cek=mysql_query("select * from user where userid='$_POST[nim]' and passid='$_POST[pl]' ");
	if(mysql_num_rows($cek)==0){
	echo "<script>alert('Gagal ganti password !! pasword lama salah ! ');window.location.href='../../media.php?module=mhs&act=detail&id=$_POST[nim]';</script>";
	} else {
		mysql_query("update user set passid='$_POST[pb]' where userid='$_POST[nim]'");
		echo "<script>alert('Password sukses diubah !!');window.location.href='../../media.php?module=mhs&act=detail&id=$_POST[nim]';</script>";
	}
	
}


?>