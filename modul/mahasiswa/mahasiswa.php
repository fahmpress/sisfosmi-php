<?php
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";

$aksi="modul/mahasiswa/mahasiswa_proses.php";

switch($_GET[act]){
	default:
            
            $dataPerPage = 10;
            if(isset($_GET['page']))
{
$noPage = $_GET['page'];
}
else $noPage = 1;
// perhitungan offset
$offset = ($noPage - 1) * $dataPerPage;
            
	$tampil=mysql_query("select * from mahasiswa,jurusan where mahasiswa.id_jur=jurusan.id_jur order by nim DESC LIMIT $offset, $dataPerPage");
	echo "<h2 class='head'>DATA MAHASISWA</h2>
        <form action='?module=mhs&act=filter' method='POST'>
	<table class='tabel2'>
        <tr>
        <td width='20'><left><input type=button value='Cari' onclick=\"window.location.href='?module=mhs&act=cari';\"></left></td>
        <td width='20'><left><input type=button value='Tambah Data' onclick=\"window.location.href='?module=mhs&act=input';\"></left></td>
        <td><div align='right'> Filter data : ";
combojur(jurusan);
$now =  date("Y");
combothn(2005, $now, tahun); "></td>";
echo"<input type=submit name=submit value=Tampilkan></tr></table></form>   

	<table class='tabel'>
	<thead>
  <tr>
    <td>No</td>
    <td>NIM</td>
    <td>Nama</td>
	<td>Tahun Masuk</td>
	<td>Jurusan</td>
	<td>Control</td>
  </tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td>$no</td>
    <td>$dt[nim]</td>
    <td>$dt[nama]</td>
	<td>".tgl_indo($dt['thn_masuk'])."</td>
  	<td>$dt[n_jur]</td>
	<td><span><a href='?module=mhs&act=edit&id=$dt[nim]'>Edit</a></span><span>
	<a href=\"$aksi?module=mhs&act=hapus&id=$dt[nim]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span>
	<span><a href='?module=mhs&act=detail&id=$dt[nim]'>Detail</a></span></td>
  </tr>";
  $no++;
  }
echo "  
</table>";

$query = "SELECT COUNT(*) AS jumData from mahasiswa,jurusan where mahasiswa.id_jur=jurusan.id_jur" ;
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$jumData = $data['jumData'];
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$dataPerPage);
// menampilkan link previous
if ($noPage > 1) echo "<input type=button value='&lt;&lt;Prev' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=mhs&page=".($noPage-1)."';\">";
// memunculkan nomor halaman dan linknya
for($page = 1; $page <= $jumPage; $page++)
{
if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
{
if (($showPage == 1) && ($page != 2)) echo "...";
if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) echo "...";
if ($page == $noPage) echo " <b>".$page."</b> ";
else echo "<input type=button value='".$page."' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=mhs&page=".$page."';\">";
$showPage = $page;
}
}
// menampilkan link next
if ($noPage < $jumPage) echo "<input type=button value='Next&gt;&gt;' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=mhs&page=".($noPage+1)."';\">";
	
	break;
	
	case "input":
	echo "<h2 class='head'>TAMBAH DATA MAHASISWA</h2>
	<form action='$aksi?module=mhs&act=input' method='post' enctype='multipart/form-data' class='f-r' >
	<table class='tabelform tabpad'>
	<tr>
	<td>NIM</td><td>:</td><td><input name='nim' type='text'></td>
	</tr>
	<tr>
	<td>Password Login</td><td>:</td><td><input class='input' name='psl' type='password'></td>
	</tr>
	<tr>
	<td>Nama Mahasiswa</td><td>:</td><td><input class='input' name='nama' type='text'></td>
	</tr>
	<tr>
	<td>Tempat Lahir</td><td>:</td><td><input class='input' name='tls' type='text'></td>
	</tr>
	<tr>
	<td>Tanggal Lahir</td><td>:</td><td>
	<select name='hari'>
                <option value='none' selected='selected'>Tgl*</option>";
			for($h=1; $h<=31; $h++) 
			{ 
				echo"<option value=",$h,">",$h,"</option>";
			} 
	echo"</select>
	<select name='bulan'>
            	<option value='none' selected='selected'>Bulan*</option>
				<option value='1'>Januari</option>
				<option value='2'>Februari</option>
				<option value='3'>Maret</option>
				<option value='4'>April</option>
				<option value='5'>Mei</option>
				<option value='6'>Juni</option>
				<option value='7'>Juli</option>
				<option value='8'>Agustus</option>
				<option value='9'>September</option>
				<option value='10'>Oktober</option>
				<option value='11'>November</option>
				<option value='12'>Desember</option>
			</select>
	<select name='tahun'>
            <option value='none' selected='selected'>Tahun*</option>";
			$now =  date("Y");
			$saiki = 1965;
			for($l=$saiki; $l<=$now; $l++)
			{
				echo"<option value=",$l,">",$l,"</option>";
			}	
	echo "</select>
	</td>
	</tr>
	
	<tr>
	<td>Jenis Kelamin</td><td>:</td><td><input name='jk' type='radio' value='L' />Pria <input name='jk' type='radio' value='P' />Wanita</td>
	</tr>
	
	<tr>
	<td>Alamat</td><td>:</td><td><textarea name='almt' ></textarea></td>
	</tr>
	
	<tr>
	<td>Tahun Masuk</td><td>:</td><td>
	<select name='thn_msk'>
            <option value='none' selected='selected'>Tahun*</option>";
			$now =  date("Y");
			$saiki = 2000;
			for($l=$saiki; $l<=$now; $l++)
			{
				echo"<option value=",$l,">",$l,"</option>";
			}	
	echo "</select>
	
	<tr>
	<td>Jurusan</td><td>:</td><td><select name='jurusan'>
	<option value='' selected >Pilih Jurusan</option>";
	$jur=mysql_query("select * from jurusan");
	while($j=mysql_fetch_array($jur)){
	echo "<option value='$j[id_jur]'>$j[n_jur]</option>";
	}
	echo "</select></td>
	</tr>
			
	<tr>
	<td>Foto</td><td>:</td><td><input name='fupload' type='file' /></td>
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
	$ambil=mysql_query("select * from mahasiswa where nim='$_GET[id]'");
	$t=mysql_fetch_array($ambil);
	echo "<h2 class='head'>Edit Data Mahasiswa</h2>
	<form action='$aksi?module=mhs&act=edit' method='post' enctype='multipart/form-data' >
	<table class='tabelform tabpad'>
	
       
        
        <tr>
	<td>NIM</td><td>:</td><td><input name='nim' type='text' value='$t[nim]' readonly></td>
	</tr>
	<tr>
	<td>Nama Mahasiswa</td><td>:</td><td><input class='input' name='nama' type='text' value='$t[nama]'></td>
	</tr>
	<tr>
	<td>Tempat Lahir</td><td>:</td><td><input class='input' name='tls' type='text' value='$t[tmpt_lahir]'></td>
	</tr>
	<tr>
	<td>Tanggal Lahir</td><td>:</td><td>"; 
	$tg=explode("-",$t['tgl_lahir']);
	$tl=$tg[0];
	$btl=$tg[1];
	$htl=$tg[2];
	combotgl(1, 31, ttl, $htl);
	combonamabln(1,12,btl,$btl);
	combothn(1965, 2000, tl, $tl);
	echo "</td>
	</tr>
	
	<tr>
	<td>Jenis Kelamin</td><td>:</td><td>";
	echo "<input name='jk' type='radio' value='L'"; if($t['jenis_kelamin']=='L'){ echo "checked";} echo "/>Pria ";
	echo "<input name='jk' type='radio' value='P'"; if($t['jenis_kelamin']=='P'){ echo "checked";} echo "/>Wanita ";
	
	echo "</td></tr>
	
	<tr>
	<td>Alamat</td><td>:</td><td><textarea name='almt' >$t[alamat]</textarea></td>
	</tr>
	
	<tr>
        <td>Tempat Lahir</td><td>:</td><td><input class='input' name='thn_msk' type='text' value='$t[thn_masuk]'></td>
	</tr>
	
	<tr>
	<td>Bagian</td><td>:</td><td><select name='jurusan'>
	<option value='' selected >Pilih Jurusan</option>";
	$jur=mysql_query("select * from jurusan");
	while($j=mysql_fetch_array($jur)){
	if($t['id_jur']==$j['id_jur']){
	echo "<option value='$j[id_jur]' selected='$t[id_jur]'>$j[n_jur]</option>";
	} else {
	echo "<option value='$j[id_jur]'>$j[n_jur]</option>";
	}
	}
	echo "</select></td>
	</tr>
	
	<tr>
	<td>Foto</td><td>:</td><td><img src='image_mhs/small_$t[foto]' /></td>
	</tr>
	
	<tr>
	<td>Ganti Foto</td><td>:</td><td><input name='fupload' type='file' /></td>
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
	
	case "detail":
	$ambil=mysql_query("select * from mahasiswa where nim='$_GET[id]'");
	$t=mysql_fetch_array($ambil);
	echo "<h2 class='head'>Data Mahasiswa</h2>
	<div class='rp' >
	<div class='foto'>";
	if($t[foto]==""){
		echo "<img src='image_mhs/no.jpg' width='200' height='240' />";
	} else {
	echo "<img src='image_mhs/small_$t[foto]' width='200' height='240' />";
	}
	echo "</div>
	<table class='tabelform tabpad'>
	<tr>
	<td>NIM</td><td>:</td><td>$t[nim]</td>
	</tr>
	<tr>
	<td>Nama</td><td>:</td><td>$t[nama]</td>
	</tr>
	<tr>
	<td>Tempat Lahir</td><td>:</td><td>$t[tmpt_lahir]</td>
	</tr>
	<tr>
	<td>Tanggal Lahir</td><td>:</td><td>"; 
	echo "".tgl_indo($t['tgl_lahir'])."";
	echo "</td>
	</tr>
	
	<tr>
	<td>Jenis Kelamin</td><td>:</td><td>";
	if($t['jenis_kelamin']=='L'){
	echo "Pria";
	} else {
	echo "Wanita";
	}	
	echo "</td></tr>
	
	<tr>
	<td>Alamat</td><td>:</td><td>$t[alamat]</td>
	</tr>
	
	<tr>
	<td>Tahun Masuk</td><td>:</td><td>$t[thn_masuk]</td>
	</tr>
	
	<tr>
	<td>Jurusan</td><td>:</td><td>";
	$bag=mysql_query("select * from jurusan where id_jur='$t[id_jur]'");
	$b=mysql_fetch_array($bag);
	echo "$b[n_jur]";	
	echo "</td>
	</tr>
	
	<tr>
	<td colspan='3'>[ <a href='?module=mhs&act=edit&id=$t[nim]'> Edit Data </a>] [ <a href='?module=mhs&act=pwd&id=$t[nim]'> Ganti Password </a>]</td>
	</tr>
	
		
	<div class='rp2'>
	<h2 class=''></h2>
	<table class='tabel'>	
	<thead>
	<tr>
	
	</tr>	
	</thead>";
	
	echo "
	</table>
	</div>
		<div style='clear:both'></div>
	";	
	break;
	
	
	
	case "pwd":
	echo "<h2 class='head'>GANTI PASSWORD</h2>
	<form action='$aksi?module=mhs&act=pwd' method='post' enctype='multipart/form-data' >
	<table class='tabelform tabpad'>
	<tr>
	<td></td><td></td><td><input name='nim' type='hidden' value='$_GET[id]' readonly>
	</td>
	</tr>
	<tr>
	<td>Password Lama</td><td>:</td><td><input class='input' name='pl' type='password'><span> </span></td>
	</tr>
	<tr>
	<td>Password Baru</td><td>:</td><td><input class='input' name='pb' type='password'><span> </span></td>
	</tr>
	<td></td><td></td><td><input type=submit value=Simpan>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>
	";
	break;
	
	case "cari":
	echo "<div>
<h2 class='head'>CARI DATA MAHASISWA</h2>
<form action='?module=mhs&act=hasil' method='POST' enctype='multipart/form-data'>";

echo "<table>
<tr><td><input type='checkbox' name='nisCat'> NIM</td><td><input type='text'
name='nis'></td></tr>
<tr><td><input type='checkbox' name='namaCat'> Nama Mahasiswa</td><td><input type='text'
name='nama'></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Cari'></td></tr>
</table>
";
	break;
    
    case "hasil":
	$bagianWhere = "";

if (isset($_POST['nisCat']))
{
$nim = $_POST['nis'];
if (empty($bagianWhere))
{
$bagianWhere .= "nim = '$nim'";
}
}
if (isset($_POST['namaCat']))
{
$nama = $_POST['nama'];
if (empty($bagianWhere))
{
$bagianWhere .= "nama LIKE '%$nama%'";
}
else
{
$bagianWhere .= " AND nama LIKE '%$nama%'";
}
}


$query = "SELECT * FROM mahasiswa WHERE ".$bagianWhere;
$hasil = mysql_query($query);
$data=mysql_fetch_array($hasil);
if($data>=1){
echo "<h2 class='head'>HASIL PENCARIAN</h2>
	<table class='tabel'>
	<thead>
<tr>
<td>No</td>
    <td>NIM</td>
    <td>Nama Mahasiswa</td>
    <td>Tanggal Lahir</td>
    <td>Jenis Kelamin</td>
	<td>Angkatan</td>
        <td>Jurusan</td>
	<td>Control</td>
  </tr>
  </thead>";
 $no=1;
 $hasil2 = mysql_query($query);
  while($dt=mysql_fetch_array($hasil2)){
  echo "<tr>
    <td>$no</td>
    <td>$dt[nim]</td>
    <td>$dt[nama]</td>
      <td>".tgl_indo($dt['tgl_lahir'])."</td>
      <td>$dt[jenis_kelamin]</td>
	<td>$dt[thn_masuk]</td>
  	<td>$dt[n_jur]</td>
	<td><span><a href='?module=mhs&act=edit&id=$dt[nim]'>Edit</a></span><span>
	<a href=\"$aksi?module=mhs&act=hapus&id=$dt[nim]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span>
	<span><a href='?module=mhs&act=detail&id=$dt[nim]'>Detail</a></span></td>
  </tr>";
  $no++;
  }
  echo "
</table>";
}else{ 
    echo "<h2 class='head'>Data tidak ditemukan</h2>";
    echo "
<div>
	<input type=button value='Cari Lagi' onclick=\"window.location.href='?module=mhs&act=cari';\">
        </div>        
    ";
}
	break;
        
        case "histori":
             
       $tampil=mysql_query("select bayar.smstr, bayar.id_bayar, mahasiswa.nama, mahasiswa.nim, jurusan.n_jur, bayar.tgl_bayar, bayar.jml_bayar, bayar.ket
from bayar, jurusan, mahasiswa where bayar.nim=mahasiswa.nim and mahasiswa.id_jur=jurusan.id_jur and mahasiswa.nim='$_GET[id]' order by id_bayar asc");
               echo "<h2 class='head'>HISTORI PEMBAYARAN</h2>
               <form action='?module=byr&act=filter' method='POST'>
	<table class='tabel2'>
        <tr>
        <td width='20'><left><input type=button value='Cari' onclick=\"window.location.href='?module=byr&act=cari';\"></left></td>
        <td width='20'><left><input type=button value='Pembayaran Baru' onclick=\"window.location.href='?module=byr&act=input';\"></left></td>
        <td><div align='right'> Filter data : ";
combojur(jurusan);
$now =  date("Y");
combothn(2005, $now, tahun);
combosemester(semester);"></td>";
echo"<input type=submit name=submit value=Tampilkan></tr></table></form>  
	<table class='tabel'>
	<thead>
       
  <tr>
    <td><center>No</center></td>
    <td><center>ID Transaksi</center></td>
    <td><center>NIM</center></td>
    <td><center>Nama Mahasiswa</center></td>
    <td><center>Jurusan</center></td>
    <td><center>Semester</center></td>
    <td><center>Tanggal Bayar</center></td>
    <td><center>Jumlah Bayar</center></td>
    <td><center>Keterangan</center></td>
    </tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td><center>$no</center></td>
      <td><center>$dt[id_bayar]</center></td>
    <td><center>$dt[nim]</center></td>
    <td>$dt[nama]</td>
      <td>$dt[n_jur]</td>
      <td><center>$dt[smstr]</center></td>
     <td><center>".tgl_indo($dt['tgl_bayar'])."</center></td>
      <td><center>$dt[jml_bayar]</center></td>
      <td><center>$dt[ket]</center></td>
	</tr>";
  $no++;
  }
echo "  
</table>";
                               
	break;
        
        case "byrusr":
       $kueri="select bayar.smstr, bayar.id_bayar, mahasiswa.nama, mahasiswa.nim, jurusan.n_jur, bayar.tgl_bayar, bayar.jml_bayar, bayar.ket
from bayar, jurusan, mahasiswa where bayar.nim=mahasiswa.nim and mahasiswa.id_jur=jurusan.id_jur and mahasiswa.nim='$_GET[id]' order by id_bayar asc";      
       $tampil=mysql_query($kueri);
       $data=mysql_fetch_array($tampil);
       if($data>=1){
           echo "<h2 class='head'>DATA PEMBAYARAN</h2>
               <table style='border:0px;font-family: 'IstokWebRegular';'>
               <tr>
               <td>Nama     </td><td>:</td><td>$data[nama]</td>
               </tr>
               <tr>
               <td>Jurusan  </td><td>:</td><td>$data[n_jur]</td>
               </tr>
               </table>
               <table class='tabel'>
	<thead>
       
  <tr>
    <td><center>No</center></td>
    <td><center>ID Transaksi</center></td>
    <td><center>Semester</center></td>
    <td><center>Tanggal Bayar</center></td>
    <td><center>Jumlah Bayar</center></td>
    <td><center>Keterangan</center></td>
    </tr>
  </thead>";
  $no=1;
  $tampil2=mysql_query($kueri);
  while($dt=mysql_fetch_array($tampil2)){
  echo "<tr>
    <td><center>$no</center></td>
      <td><center>$dt[id_bayar]</center></td>
    <td><center>$dt[smstr]</center></td>
     <td><center>".tgl_indo($dt['tgl_bayar'])."</center></td>
      <td><center>$dt[jml_bayar]</center></td>
      <td><center>$dt[ket]</center></td>
	</tr>";
  $no++;
  }
echo "  
</table>";
       }else{
           echo "<h2 class='head'>ANDA BELUM PERNAH MELAKUKAN TRANSAKSI</h2>";
       }

	break;
        
        case "filter":
            
            $dataPerPage = 10;
            if(isset($_GET['page']))
{
$noPage = $_GET['page'];
}
else $noPage = 1;
// perhitungan offset
$offset = ($noPage - 1) * $dataPerPage;
            
	$tampil=mysql_query("select * from mahasiswa,jurusan where mahasiswa.id_jur=jurusan.id_jur and jurusan.id_jur=$_POST[jurusan] and mahasiswa.thn_masuk=$_POST[tahun] order by nim DESC LIMIT $offset, $dataPerPage");
	echo "<h2 class='head'>DATA MAHASISWA</h2>
        <form action='?module=mhs&act=filter' method='POST'>
	<table class='tabel2'>
        <tr>
        <td width='20'><left><input type=button value='Cari' onclick=\"window.location.href='?module=mhs&act=cari';\"></left></td>
        <td width='20'><left><input type=button value='Tambah Data' onclick=\"window.location.href='?module=mhs&act=input';\"></left></td>
        <td><div align='right'> Filter data : ";
combojur(jurusan);
$now =  date("Y");
combothn(2005, $now, tahun); "></td>";
echo"<input type=submit name=submit value=Tampilkan></tr></table></form>      

	<table class='tabel'>
	<thead>
  <tr>
    <td>No</td>
    <td>NIM</td>
    <td>Nama</td>
	<td>Tahun Masuk</td>
	<td>Jurusan</td>
	<td>Control</td>
  </tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td>$no</td>
    <td>$dt[nim]</td>
    <td>$dt[nama]</td>
	<td>".tgl_indo($dt['thn_masuk'])."</td>
  	<td>$dt[n_jur]</td>
	<td><span><a href='?module=mhs&act=edit&id=$dt[nim]'>Edit</a></span><span>
	<a href=\"$aksi?module=mhs&act=hapus&id=$dt[nim]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\">Hapus</a></span>
	<span><a href='?module=mhs&act=detail&id=$dt[nim]'>Detail</a></span></td>
  </tr>";
  $no++;
  }
echo "  
</table>";

$query = "SELECT COUNT(*) AS jumData from mahasiswa,jurusan where mahasiswa.id_jur=jurusan.id_jur and jurusan.id_jur=$_POST[jurusan] and mahasiswa.thn_masuk=$_POST[tahun]" ;
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$jumData = $data['jumData'];
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$dataPerPage);
// menampilkan link previous
if ($noPage > 1) echo "<input type=button value='&lt;&lt;Prev' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=mhs&page=".($noPage-1)."';\">";
// memunculkan nomor halaman dan linknya
for($page = 1; $page <= $jumPage; $page++)
{
if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
{
if (($showPage == 1) && ($page != 2)) echo "...";
if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) echo "...";
if ($page == $noPage) echo " <b>".$page."</b> ";
else echo "<input type=button value='".$page."' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=mhs&page=".$page."';\">";
$showPage = $page;
}
}
// menampilkan link next
if ($noPage < $jumPage) echo "<input type=button value='Next&gt;&gt;' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=mhs&page=".($noPage+1)."';\">";
	
	break;
}


?>