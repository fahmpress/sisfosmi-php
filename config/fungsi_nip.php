<?php 
	function ambilNip($var){
	echo "<select name=$var>";
		$ambil=mysql_query("select * from mahasiswa");
		while($dt=mysql_fetch_array($ambil)){
		echo "<option value='$dt[nim]'>$dt[nim]</option>";			
		}
	echo "</select>";
	}
?>