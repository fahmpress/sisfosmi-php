<?php

$aksi="modul/user/user_proses.php";

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

	$tampil=mysql_query("select user.userid, user.passid, user.level_user, mahasiswa.nama 
            from mahasiswa, user where user.userid=mahasiswa.nim order by userid desc LIMIT $offset, $dataPerPage");
	echo "<h2 class='head'>DATA USER</h2>
	<form action='?module=usrmgr&act=filter' method='POST'>
	<table class='tabel2'>
        <tr>
        <td width='20'><left><input type=button value='Cari' onclick=\"window.location.href='?module=usrmgr&act=cari';\"></left></td>
        <td><div align='right'> Filter data : ";
combojur(jurusan);
$now =  date("Y");
combothn(2005, $now, tahun); "></td>";
echo"<input type=submit name=submit value=Tampilkan></tr></table></form>  
	<table class='tabel'>
	<thead>
  <tr>
    <td>No</td>
    <td>Nama Mahasiswa</td>
    <td>Username</td>
    <td>Password</td>
	<td>Control</td>
  </tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td>$no</td>
    <td>$dt[nama]</td>
    <td>$dt[userid]</td>
      <td>$dt[passid]</td>
	<td><span><a href='?module=usrmgr&act=edit&id=$dt[userid]'>Edit</a></span><span>
	</tr>";
  $no++;
  }
echo "  
</table>";

$query = "SELECT COUNT(*) AS jumData from mahasiswa, user where user.userid=mahasiswa.nim" ;
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$jumData = $data['jumData'];
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$dataPerPage);
// menampilkan link previous
if ($noPage > 1) echo "<input type=button value='&lt;&lt;Prev' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=usrmgr&page=".($noPage-1)."';\">";
// memunculkan nomor halaman dan linknya
for($page = 1; $page <= $jumPage; $page++)
{
if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
{
if (($showPage == 1) && ($page != 2)) echo "...";
if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) echo "...";
if ($page == $noPage) echo " <b>".$page."</b> ";
else echo "<input type=button value='".$page."' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=usrmgr&page=".$page."';\">";
$showPage = $page;
}
}
// menampilkan link next
if ($noPage < $jumPage) echo "<input type=button value='Next&gt;&gt;' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=usrmgr&page=".($noPage+1)."';\">";
	
	break;
        
         case "edit":
	$edit=mysql_query("select user.userid, user.passid, user.level_user, mahasiswa.nama from mahasiswa, user where user.userid=mahasiswa.nim and user.userid='$_GET[id]' order by user.userid asc");
	$data=mysql_fetch_array($edit);
	echo "<h2>Edit Data User</h2>
	<form action='$aksi?module=usrmgr&act=edit' method='post'>
	<table>
	<tr>
	<td>Nama</td><td>:</td><td><input class='input' name='nama' type='text' value='$data[nama]' readonly></td>
	</tr>
	<tr>
	<td>Username</td><td>:</td><td><input class='input' name='userid' type='text' value='$data[userid]' readonly></td>
	</tr>
        <tr>
	<td>Password</td><td>:</td><td><input class='input' name='pass' type='text' value='$data[passid]'></td>
	</tr>
	<tr>
	<td></td><td></td><td><input type=submit value=Update>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>";
	break;
    
     case "cari":
	echo "<div>
<h2 class='head'>CARI DATA USER</h2>
<form action='?module=usrmgr&act=hasil' method='POST' enctype='multipart/form-data'>";

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


        $kueri= "select user.userid, user.passid, user.level_user, mahasiswa.nama from mahasiswa, user where user.userid=mahasiswa.nim and .$bagianWhere order by user.userid asc";
	$tampil=mysql_query($kueri);
        $data=mysql_fetch_array($tampil);
        if(data>=1){
	echo "<h2 class='head'>DATA USER</h2>
	<form action='?module=usrmgr&act=filter' method='POST'>
	<table class='tabel2'>
        <tr>
        <td width='20'><left><input type=button value='Cari' onclick=\"window.location.href='?module=usrmgr&act=cari';\"></left></td>
        <td><div align='right'> Filter data : ";
combojur(jurusan);
$now =  date("Y");
combothn(2005, $now, tahun); "></td>";
echo"<input type=submit name=submit value=Tampilkan></tr></table></form> 
       	<table class='tabel'>
	<thead>
  <tr>
    <td>No</td>
    <td>Nama</td>
    <td>Username</td>
    <td>Password</td>
    	<td>Control</td>
  </tr>
  </thead>";
  $no=1;
  $tampil2=mysql_query($kueri);
  while($dt=mysql_fetch_array($tampil2)){
  echo "<tr>
    <td>$no</td>
    <td>$dt[nama]</td>
    <td>$dt[userid]</td>
    <td>$dt[passid]</td>
      	<td><span><a href='?module=usrmgr&act=edit&id=$dt[userid]'>Edit</a></span><span>
    </tr>";
  $no++;
  }
echo "  
</table>";
}else{ echo "<h2 class='head'>DATA TIDAK DITEMUKAN</h2>";
echo "
<div>
	<input type=button value='Cari Lagi' onclick=\"window.location.href='?module=usrmgr&act=cari';\">
        </div>";  
}"
	";
	
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

	$tampil=mysql_query("select jurusan.id_jur, user.userid, user.passid, user.level_user, mahasiswa.nama 
            from mahasiswa, user, jurusan where user.userid=mahasiswa.nim and mahasiswa.id_jur=jurusan.id_jur and jurusan.id_jur=$_POST[jurusan] and mahasiswa.thn_masuk=$_POST[tahun] order by userid desc LIMIT $offset, $dataPerPage");
	echo "<h2 class='head'>DATA USER</h2>
	<form action='?module=usrmgr&act=filter' method='POST'>
	<table class='tabel2'>
        <tr>
        <td width='20'><left><input type=button value='Cari' onclick=\"window.location.href='?module=usrmgr&act=cari';\"></left></td>
        <td><div align='right'> Filter data : ";
combojur(jurusan);
$now =  date("Y");
combothn(2005, $now, tahun); "></td>";
echo"<input type=submit name=submit value=Tampilkan></tr></table></form>  
	<table class='tabel'>
	<thead>
  <tr>
    <td>No</td>
    <td>Nama Mahasiswa</td>
    <td>Username</td>
    <td>Password</td>
	<td>Control</td>
  </tr>
  </thead>";
  $no=1;
  while($dt=mysql_fetch_array($tampil)){
  echo "<tr>
    <td>$no</td>
    <td>$dt[nama]</td>
    <td>$dt[userid]</td>
      <td>$dt[passid]</td>
	<td><span><a href='?module=usrmgr&act=edit&id=$dt[userid]'>Edit</a></span><span>
	</tr>";
  $no++;
  }
echo "  
</table>";

$query = "SELECT COUNT(*) AS jumData from mahasiswa, user where user.userid=mahasiswa.nim and jurusan.id_jur=$_POST[jurusan] and mahasiswa.thn_masuk=$_POST[tahun]" ;
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$jumData = $data['jumData'];
// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
$jumPage = ceil($jumData/$dataPerPage);
// menampilkan link previous
if ($noPage > 1) echo "<input type=button value='&lt;&lt;Prev' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=usrmgr&page=".($noPage-1)."';\">";
// memunculkan nomor halaman dan linknya
for($page = 1; $page <= $jumPage; $page++)
{
if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
{
if (($showPage == 1) && ($page != 2)) echo "...";
if (($showPage != ($jumPage - 1)) && ($page == $jumPage)) echo "...";
if ($page == $noPage) echo " <b>".$page."</b> ";
else echo "<input type=button value='".$page."' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=usrmgr&page=".$page."';\">";
$showPage = $page;
}
}
// menampilkan link next
if ($noPage < $jumPage) echo "<input type=button value='Next&gt;&gt;' 
    onclick=\"window.location.href='".$_SERVER['PHP_SELF']."?module=usrmgr&page=".($noPage+1)."';\">";
	
	break;
        
}
   ?>