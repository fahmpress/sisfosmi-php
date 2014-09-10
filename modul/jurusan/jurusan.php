<?php

$aksi="modul/jurusan/jurusan_proses.php";

switch($_GET[act]){
	default:
	$tampil=mysql_query("select * from jurusan order by id_jur ASC");
	echo "<h2 class='head'>DATA JURUSAN</h2>
	<div>
	<input type=button value='Tambah Data' onclick=\"window.location.href='?module=jur&act=input';\">
	</div>
	<table class='tabel'>
	<thead>
  <tr>
    <td>No</td>
    <td>Kode Jurusan</td>
    <td>Nama Jurusan</td>
    <td>Ketua Jurusan</td>
	<td>Control</td>
  </tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td>$no</td>
    <td>$dt[id_jur]</td>
    <td>$dt[n_jur]</td>
      <td>$dt[kajur]</td>
	<td><span><a href='?module=jur&act=edit&id=$dt[id_jur]'>Edit</a></span><span>
	<a href=\"$aksi?module=jur&act=hapus&id=$dt[id_jur]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span></td>
  </tr>";
  $no++;
  }
echo "  
</table>
	";
	
	break;
        
        case "input":
	echo "<h2 class='head'>Tambah Data Jurusan</h2>
	<form action='$aksi?module=jur&act=input' method='post'>
	<table class='tabelform'>
	<tr>
	<td>Kode Jurusan</td><td>:</td><td><input class='input' name='id' type='text'></td>
	</tr>
	<tr>
	<td>Nama Jurusan</td><td>:</td><td><input class='input' name='nama' type='text'></td>
	</tr>
        <tr>
	<td>Ketua Jurusan</td><td>:</td><td><input class='input' name='kajur' type='text'></td>
	</tr>
	<tr>
	<td></td><td></td><td><input type=submit value=Simpan>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>
	";
	break;
    
    case "edit":
	$edit=mysql_query("select * from jurusan where id_jur='$_GET[id]'");
	$data=mysql_fetch_array($edit);
	echo "<h2>Edit Data Jurusan</h2>
	<form action='$aksi?module=jur&act=edit' method='post'>
	<table>
	<tr>
	<td>Kode Jurusan</td><td>:</td><td><input class='input' name='id' type='text' value='$data[id_jur]'></td>
	</tr>
	<tr>
	<td>Nama Jurusan</td><td>:</td><td><input class='input' name='nama' type='text' value='$data[n_jur]'></td>
	</tr>
        <tr>
	<td>Ketua Jurusan</td><td>:</td><td><input class='input' name='kajur' type='text' value='$data[kajur]'></td>
	</tr>
	<tr>
	<td></td><td></td><td><input type=submit value=Update>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>";
	break;
	
	case "hapus":
	
	break;
}
?>
