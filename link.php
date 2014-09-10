<?php
include "config/koneksi.php";

include "config/fungsi_indotgl.php";
include "config/class_paging.php";
include "config/kode_auto.php";
include "config/fungsi_combobox.php";
include "config/fungsi_nip.php";

	if ($_SESSION['leveluser']=='3'){
		if($_GET['module']=="byr"){
		include "modul/pembayaran/bayar.php";
		}
                else if($_GET['module']=="user"){
		echo "<div><h1 class='head2'></h1></div>";
		}
		else if($_GET['module']=="mhs"){
		include "modul/mahasiswa/mahasiswa.php";
		}
	}
	
if ($_SESSION['leveluser']=='1'){
	if($_GET['module']=="home"){
		echo "<div><h1 class='head2'> </h1></div>";
	}
	
	else if($_GET['module']=="mhs"){
	include "modul/mahasiswa/mahasiswa.php";
	}
        
        else if($_GET['module']=="jur"){
	include "modul/jurusan/jurusan.php";
	}

	else if($_GET['module']=="byr"){
	include "modul/pembayaran/bayar.php";
	}
	else if($_GET['module']=="usrmgr"){
	include "modul/user/user.php";
	}
        else if($_GET['module']=="laporan"){
	include "laporan.php";
	}
        }
 
 if ($_SESSION['leveluser']=='2'){
        if($_GET['module']=="home"){
		echo "<div><h1 class='head2'></h1></div>";
	}
	elseif($_GET['module']=="laporan"){
	include "laporan.php";
	}
                
 }

?>