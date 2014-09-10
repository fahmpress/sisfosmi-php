<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>POLITEKNIK SUKABUMI</title>
<link rel="stylesheet" type="text/css" href="style_login.css" />

<link rel="shortcut icon" href="images/images_admin/favicon.ico" />

<script type="text/javascript">
function validasi(form){
if (form.username.value == ""){
alert("Anda belum mengisikan Username");
form.username.focus();
return (false);
}
     
if (form.password.value == ""){
alert("Anda belum mengisikan Password");
form.password.focus();
return (false);
}
return (true);
}
</script>

</head>

<body OnLoad="document.login.username.focus();">
<div id="main">

<div id="header">APLIKASI PEMBAYARAN</div>
<div id="middle">
<form id="form-login" name="login" method="post" action="cek_login.php" onSubmit="return validasi(this)">
<table class="tabel2">  
  <tr>
  <td><div class="userpass" align="left">Username</div></td>
  <td><div class="userpass" align="left">Password</div></td>
  <td></td>
  </tr>
  <tr>
  <td><div align="left"><input type="text" name="username" size="29" id="input" /></div></td>
  <td><div align="left"><input type="password" name="password" size="29" id="input" /></div></td>
  <td><div align="left"><input name="Submit" type="image" value="Submit" src="images/images_login/login_by_fahm.png" id="submit" align="absmiddle" /></div></td>
  </tr>
 </table>
</form>
</div>

<!-- Middle -->
<div id="footer">
*Aplikasi ini khusus untuk mahasiswa Politeknik Sukabumi yang sudah teregistrasi, silahkan hubungi pihak administrasi untuk mendapatkan akun, selanjutnya login menggunakan NIM dan Password*
</div>
<div id="footer2">
Copyright &copy; 2013 by |fahm DIGITAL ART&trade;| (persada.fahmi@gmail.com).
</div>
</div>
</body>
</html>
