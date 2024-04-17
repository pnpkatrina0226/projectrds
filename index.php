<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// pagination 
// konfigurasi
// $JumlahDataPerhalaman = 2;
// $JumlahData = count(query("SELECT * FROM mahasiswa"));
// $JumlahHalaman = ($JumlahData / $JumlahDataPerhalaman);
// $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1; 
// $awalData = ( $JumlahDataPerhalaman * $halamanAktif) - $JumlahDataPerhalaman;

$mahasiswa = query("SELECT * FROM mahasiswa ");

// tombol cari ditekan
if( isset($_POST["cari"]) ){
    $mahasiswa = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Index</title>
    <style>
        .loader{
          width: 30px;
          position: absolute;
          top: 150px; 
          left: 30px 50px; 
          z-index: -1; 
          display: none;
        }
    </style>
    <link rel="stylesheet" href="css/style3.css">

    <script src="js/jquery-3.7.1.min.js"></script>    
    <script src="js/script.js"></script>
</head>

<body>
 
<a href="logout.php">Logout</a>
<h1>Daftar Mahasiswa</h1>
<a href="Tambah.php">Tambah Data Mahasiswa</a>
<br><br>

<form action="" method="post">

    <input type="text" name="keyword" size="40" autofocus
    placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
    <button type="submit" name="cari" id="tombol-cari">Cari!</button>

    <img src="img/loader1.gif" class="loader">
</form>
<br>

<div id="container">
<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>Nim</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Prodi</th>
    </tr>
    
    <?php $i = 1; ?>

    <?php foreach($mahasiswa as $row)  : ?>
    <tr>
        <td><?= $i; ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="
            return confirm('yakin?');">hapus</a>
        </td>
        <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
        <td><?= $row["nim"];?></td>
        <td><?= $row["nama"];?></td>
        <td><?= $row["email"];?></td>
        <td><?= $row["prodi"];?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    </div>
</table>
</body>
</html>
