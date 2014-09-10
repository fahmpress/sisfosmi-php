<?php

$aksi="modul/pembayaran/bayar_proses.php";

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

	$tgl= date('Y-m-d');
	$tampil=mysql_query("select bayar.smstr, bayar.id_bayar, mahasiswa.nama, mahasiswa.nim, jurusan.n_jur, bayar.tgl_bayar, bayar.jml_bayar, bayar.ket
from bayar, jurusan, mahasiswa where bayar.nim=mahasiswa.nim and mahasiswa.id_jur=jurusan.id_jur order by id_bayar desc LIMIT $offset, $dataPerPage");
	echo "<h2 class='head'>DATA PEMBAYARAN</h2>
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
    <td><center>Kontrol</center></td>
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
	<td><span><a href='?module=byr&act=edit&id=$dt[id_bayar]'>Bayar</a>
          <a href='?module=mhs&act=histori&id=$dt[nim]'>Histori</a></span><span>
    </tr>";
  $no++;
  }
echo "  
</table>";

$query = "SELECT COUNT(*) AS jumData FROM jurusan, mahasiswa, bayar where jurusan.id_jur=mahasiswa.id_jur and mahasiswa.nim=bayar.nim" ;
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$jumData = $data['jumData'];
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$dataPerPage);
// menampilkan link previous

if ($noPage > 1) echo "<input type=button value='&lt;&lt;Prev' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=byr&page=".($noPage-1)."';\">";
    
// memunculkan nomor halaman dan linknya
for($page = 1; $page <= $jumPage; $page++)
{
if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
{
if (($showPage == 1) && ($page != 2)) echo "...";
if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) echo "...";
if ($page == $noPage) echo " <b>".$page."</b> ";
else echo "<input type=button value='".$page."' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=byr&page=".$page."';\">";
$showPage = $page;
}
}
// menampilkan link next
if ($noPage < $jumPage) echo "<input type=button value='Next&gt;&gt;' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=byr&page=".($noPage+1)."';\">";
	
	break;
        
         case "input":
             $tgl= date('Y-m-d');
	echo "<h2 class='head'>Pembayaran Baru</h2>
	<form action='$aksi?module=byr&act=input' method='post'>
	<table class='tabelform'>
	<tr>
	<td>Nama</td><td>:</td><td><select name='nim'>
	<option value='' selected >Pilih Nama*</option>";
	$nim=mysql_query("select * from mahasiswa");
	while($j=mysql_fetch_array($nim)){
	echo "<option value='$j[nim]'>$j[nama]</option>";
	}
	echo "</select></td>
	</tr>
	<tr>
	<td>Tanggal Bayar</td><td>:</td><td><input class='input' name='tgl' type='text' value='$tgl' readonly></td>
	</tr>
         <tr>
	<td>Jumlah Bayar</td><td>:</td><td><input class='input' name='jml_byr' type='text' value='$data[jml_bayar]' ></td>
	</tr>
        <tr>
        <td>Semester</td><td>:</td><td>
        <select name='smstr'>
            	<option value='none' selected='selected'>Pilih Semester*</option>
				<option value='1'>1</option>
				<option value='2'>2</option>
				<option value='3'>3</option>
				<option value='4'>4</option>
                                <option value='4'>5</option>
                                <option value='4'>6</option>
                                </select>
        </td></tr>
        <tr>
	<td>Ketarangan</td><td>:</td><td><input name='ket' type='radio' value='LUNAS' />Lunas <input name='ket' type='radio' value='KREDIT' />Kredit</td>
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
        $tgl= date('Y-m-d');
	$edit=mysql_query("select bayar.id_bayar, bayar.smstr, mahasiswa.nama, mahasiswa.nim, bayar.tgl_bayar, bayar.jml_bayar, bayar.ket
        from bayar, mahasiswa where bayar.nim=mahasiswa.nim and id_bayar='$_GET[id]' order by id_bayar asc");
        $data=mysql_fetch_array($edit);
        echo "<h2>Pembayaran</h2>
	<form action='$aksi?module=byr&act=edit' method='post'>
	<table>
        <tr>
	<td>Nama</td><td>:</td><td><input class='input' name='id' type='text' value='$data[id_bayar]' readonly></td>
	</tr>
	<tr>
	<td>Nama</td><td>:</td><td><input class='input' name='nama' type='text' value='$data[nama]' readonly></td>
	</tr>
        <tr>
	<input type='hidden' class='input' name='nim' type='text' value='$data[nim]'></td>
	</tr>
	<tr>
	<td>Tanggal Bayar</td><td>:</td><td><input class='input' name='tgl' type='text' value='$tgl' readonly></td>
	</tr>
        <tr>
	<td>Jumlah Bayar</td><td>:</td><td><input class='input' name='jml_byr' type='text' value='$data[jml_bayar]' ></td>
	</tr>
        <tr>
	<td>Semester</td><td>:</td><td><input class='input' name='smstr' type='text' value='$data[smstr]' readonly></td>
	</tr>
        <tr>
	<td>Ketarangan</td><td>:</td><td><input name='ket' type='radio' value='LUNAS' />Lunas <input name='ket' type='radio' value='KREDIT' />Kredit</td>
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
    
    case "cari":
	echo "<div>
<h2 class='head'>CARI DATA TRANSAKSI</h2>
<form action='?module=byr&act=hasil' method='POST' enctype='multipart/form-data'>";

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
$bagianWhere .= "mahasiswa.nim = '$nim'";
}
}
if (isset($_POST['namaCat']))
{
$nama = $_POST['nama'];
if (empty($bagianWhere))
{
$bagianWhere .= "mahasiswa.nama LIKE '%$nama%'";
}
else
{
$bagianWhere .= " AND nama LIKE '%$nama%'";
}
}



$tgl= date('Y-m-d');
$kueri="select bayar.smstr, bayar.id_bayar, mahasiswa.nama, mahasiswa.nim, jurusan.n_jur, bayar.tgl_bayar, bayar.jml_bayar, bayar.ket
from bayar, jurusan, mahasiswa where bayar.nim=mahasiswa.nim and mahasiswa.id_jur=jurusan.id_jur and .$bagianWhere  order by id_bayar desc";	
$tampil=mysql_query($kueri);
$data=mysql_fetch_array($tampil);
if($data>=1){
	echo "<h2 class='head'>DATA PEMBAYARAN</h2>
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
    <td><center>Kontrol</center></td>
	</tr>
  </thead>";
  $no=1;
  $tampil2=mysql_query($kueri);
  while($dt=mysql_fetch_array($tampil2)){
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
	<td><span><a href='?module=byr&act=edit&id=$dt[id_bayar]'>Bayar</a>
         </tr>";
  $no++;
  }
echo "  
</table>
";}
else{ echo"<h2 class='head'>Data tidak ditemukan</h2> ";
echo "
<div>
	<input type=button value='Cari Lagi' onclick=\"window.location.href='?module=byr&act=cari';\">
        </div>        
    ";
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

	$tgl= date('Y-m-d');
	$tampil=mysql_query("select bayar.smstr, bayar.id_bayar, mahasiswa.nama, mahasiswa.nim, jurusan.n_jur, bayar.tgl_bayar, bayar.jml_bayar, bayar.ket
from bayar, jurusan, mahasiswa where bayar.nim=mahasiswa.nim and mahasiswa.id_jur=jurusan.id_jur and mahasiswa.thn_masuk=$_POST[tahun] and jurusan.id_jur=$_POST[jurusan] and bayar.smstr=$_POST[semester] order by id_bayar desc LIMIT $offset, $dataPerPage");
	echo "<h2 class='head'>DATA PEMBAYARAN</h2>
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
    <td><center>Kontrol</center></td>
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
	<td><span><a href='?module=byr&act=edit&id=$dt[id_bayar]'>Bayar</a>
          <a href='?module=mhs&act=histori&id=$dt[nim]'>Histori</a></span><span>
    </tr>";
  $no++;
  }
echo "  
</table>";

$query = "SELECT COUNT(*) AS jumData FROM jurusan, mahasiswa, bayar where jurusan.id_jur=mahasiswa.id_jur and mahasiswa.nim=bayar.nim and mahasiswa.thn_masuk=$_POST[tahun] and jurusan.id_jur=$_POST[jurusan] and bayar.smstr=$_POST[semester]" ;
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$jumData = $data['jumData'];
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$dataPerPage);
// menampilkan link previous
"<div style='text-align:center;padding:20px;'>";
if ($noPage > 1) echo "<input type=button value='&lt;&lt;Prev' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=byr&page=".($noPage-1)."';\">";
    
// memunculkan nomor halaman dan linknya
for($page = 1; $page <= $jumPage; $page++)
{
if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
{
if (($showPage == 1) && ($page != 2)) echo "...";
if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) echo "...";
if ($page == $noPage) echo " <b>".$page."</b> ";
else echo "<input type=button value='".$page."' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=byr&page=".$page."';\">";
$showPage = $page;
}
}
// menampilkan link next
if ($noPage < $jumPage) echo "<input type=button value='Next&gt;&gt;' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=byr&page=".($noPage+1)."';\">";
"</div>";	
	break; 
       
}
?>
