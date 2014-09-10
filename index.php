<?
session_start();
//periksa apakah user telah login atau memiliki session
if(!isset($_SESSION['passuser']) || !isset($_SESSION['passuser'])) {
include "login.php";
} else {
		if($_SESSION[leveluser]==1){
		header('location:media.php?module=home');}
		
		else if($_SESSION[leveluser]==2){
		header('location:media.php?module=home');}
		
	else if($_SESSION[leveluser]==3){
		header('location:media.php?module=user');}
} 
?>

