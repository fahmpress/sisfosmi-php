<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LAPORAN DATA MAHASISWA</title>
<link rel="stylesheet" href="css/print.css" type="text/css"  />
</head>
<style>
@media print {
input.noPrint { display: none; }
}
</style>
<body class="body">
<div id="wrapper">
    <?php

include"config/koneksi.php";
// mencari total Bakat Menyanyi
$query = "select count(bayar.ket) as total_b1 
    from bayar, jurusan, mahasiswa 
    where mahasiswa.id_jur=jurusan.id_jur and mahasiswa.nim=bayar.nim and bayar.ket='lunas' and jurusan.id_jur='11'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$total_b1 = $data['total_b1'];
// mencari total bakat Nge-Lawak
$query = "select count(bayar.ket) as total_b2 
    from bayar, jurusan, mahasiswa 
    where mahasiswa.id_jur=jurusan.id_jur and mahasiswa.nim=bayar.nim and bayar.ket='lunas' and jurusan.id_jur='21'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$total_b2 = $data['total_b2'];
// mencari total bakat Nge-Dance
$query = "select count(bayar.ket) as total_b3
    from bayar, jurusan, mahasiswa 
    where mahasiswa.id_jur=jurusan.id_jur and mahasiswa.nim=bayar.nim and bayar.ket='lunas' and jurusan.id_jur='31'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$total_b3 = $data['total_b3'];
// mencari total bakat Nge-Dance
$query = "select count(bayar.ket) as total_b4 
    from bayar, jurusan, mahasiswa 
    where mahasiswa.id_jur=jurusan.id_jur and mahasiswa.nim=bayar.nim and bayar.ket='lunas' and jurusan.id_jur='41'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
$total_b4 = $data['total_b4'];
// menghitung total Bakat
$total = $total_b1 + $total_b2 + $total_b3 + $total_b4;
// menghitung prosentase masing2 bakat
$persen_b1 = $total_b1/$total * 100;
$persen_b2 = $total_b2/$total * 100;
$persen_b3 = $total_b3/$total * 100;
$persen_b4 = $total_b4/$total * 100;
// menentukan panjang grafik batang berdasarkan prosentase
if ($persen_b1 == 0)
$panjangGrafik_b1 = 1;
else
$panjangGrafik_b1 = $persen_b1 * 40 / 100;
if ($persen_b2 == 0)
$panjangGrafik_b2 = 1;
else
$panjangGrafik_b2 = $persen_b2 * 40 / 100;
if ($persen_b3 == 0)
$panjangGrafik_b3 = 1;
else
$panjangGrafik_b3 = $persen_b3 * 40 / 100;
if ($persen_b4 == 0)
$panjangGrafik_b4 = 1;
else
$panjangGrafik_b4 = $persen_b4 * 40 / 100;
?>
<style type="text/css">
body {
background-color: #;
}
</style>
<h2 class="head">Statistik Pembayaran Mahasiswa Berdasarkan Jurusan</h2>
<p><b>TEKNIK SIPIL</b> (Jumlah Lunas: <?php echo $total_b1; ?> | <?php echo $persen_b1; ?>%) <div
style="height: 20px; width: <?php echo $panjangGrafik_b1; ?>%; background-color: red;" title="Sipil"
(Jumlah: <?php echo $total_b1; ?> | <?php echo $persen_b1; ?>%)"></div></p>

<p><b>TEKNIK MESIN</b> (Jumlah Lunas: <?php echo $total_b2; ?> | <?php echo $persen_b2; ?>%) <div
style="height: 20px; width: <?php echo $panjangGrafik_b2; ?>%; background-color: blue;" title="Mesin"
(Jumlah: <?php echo $total_b2; ?> | <?php echo $persen_b2; ?>%)"></div></p>

<p><b>TEKNIK KOMPUTER</b> (Jumlah Lunas: <?php echo $total_b3; ?> | <?php echo $persen_b3; ?>%) <div
style="height: 20px; width: <?php echo $panjangGrafik_b3; ?>%; background-color: green;" title="Tekom"
(Jumlah: <?php echo $total_b3; ?> | <?php echo $persen_b3; ?>%)"></div></p>

<p><b>ADMIN BISNIS</b> (Jumlah Lunas: <?php echo $total_b4; ?> | <?php echo $persen_b4; ?>%) <div
style="height: 20px; width: <?php echo $panjangGrafik_b4; ?>%; background-color: yellow;" title="Bisnis"
(Jumlah: <?php echo $total_b4; ?> | <?php echo $persen_b4; ?>%)"></div></p
</div>
</body>
<div>
<input type=button value='Print' onclick='window.print()'>
</div>