<?php

session_start();

require 'function.php';


//jika tidak ada id_kamar
if (!isset($_GET['id_pengaduan'])){
	header("Location: index.php");
	exit;
}

//ambil dari url
$id = $_GET['id_pengaduan'];

// query pengaduan berdasarkan id_pengaduan dan mengambil data dari penggabungan 2 tabel yaitu data harga
// di tabel kamar dan jumlah kamar di tabel pengaduan

$pengaduan = query("SELECT pengaduan.id_pengaduan,pengaduan.nik,registrasi.nama,pengaduan.tgl_pengaduan,pengaduan.judul,pengaduan.isi_laporan,pengaduan.foto,pengaduan.status 
FROM pengaduan JOIN registrasi ON pengaduan.nik = registrasi.nik WHERE id_pengaduan = $id");



?>


<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <title>Halaman Admin Detail Pemesanan Hotel</title>
</head>
<body>
  
  <!-- Header -->
  <header class="jumbotron jumbotron-fluid bg-primary text-white">
    <div class="container">
      <h1 class="display-4 text-center">Halaman Detail Pengaduan Masyarakat</h1>
      <p class="lead text-center">Selamat datang di halaman detail pengaduan masyarakat.</p>
    </div>
  </header>	
 <!-- Konten Utama -->
      <?php foreach ($pengaduan as $p) : ?>
            <?php 
              
              $tanggal = date("d-m-Y", strtotime($p['tgl_pengaduan']));
              
            ;?>
            <!-- tampilan detail pengaduan -->
            <div class="container my-5">
              <h1 class="text-center mb-3">Detail Pengaduan</h1>
              <div class="card shadow">
                <div class="card-body">
                  <table class="table">
                    <tr>
                      <th>Foto:</th>
                      <td><img style="width : 300px;" class="card-img-top" src="../assets/images/file/<?= $p['foto'];?>" alt="Card image"></td>
                    </tr>
                    <tr>
                      <th>Nik:</th>
                      <td><?= $p['nik'];?></td>
                    </tr>
                    <tr>
                      <th>Nama Pelapor:</th>
                      <td><?= $p['nama'];?></td>
                    </tr>
                    <tr>
                      <th>Isi Laporan:</th>
                      <td><?= $p['isi_laporan'];?></td>
                    </tr>
                    <tr>
                      <th>Tanggal:</th>
                      <td><?= $tanggal;?></td>
                    </tr>
                    <tr>
                      <th></th>
                    <?php
                    $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../kamar.php';
                    ?>
                      <td> <a href="<?=$url?>" type="button" class="btn btn-secondary">Kembali</a> </td>
                    </tr>
                   
               
                  </table>
                </div>
              </div>
            </div>
      <?php endforeach; ?> 
   
<br>

<!-- halaman detail.php -->





<script src="assets/js/bootstrap.js"></script>
</body>
</html>