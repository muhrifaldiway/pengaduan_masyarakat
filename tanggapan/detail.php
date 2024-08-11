<?php

session_start();

require 'function.php';


//jika tidak ada id_kamar
if (!isset($_GET['id_tanggapan'])){
	header("Location: index.php");
	exit;
}

//ambil dari url
$id = $_GET['id_tanggapan'];

// query tanggapan berdasarkan id_tanggapan dan mengambil data dari penggabungan 3 tabel yaitu data
// di tabel registrasi, pengaduan, dan tanggapan.

$tanggapan = query("SELECT * FROM tanggapan WHERE id_tanggapan = $id");

$masyarakat = query("SELECT registrasi.nama,pengaduan.nik FROM registrasi JOIN pengaduan ON registrasi.nik = pengaduan.nik
                      JOIN tanggapan ON pengaduan.id_pengaduan = tanggapan.pengaduan_id WHERE id_tanggapan = $id");


?>


<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <title>Halaman Detail tanggapan</title>
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/ico/icon.png">
</head>
<body>
  
  <!-- Header -->
  <header class="jumbotron jumbotron-fluid bg-primary text-white">
    <div class="container">
      <h1 class="display-4 text-center">Halaman Detail Tanggapan</h1>
      <p class="lead text-center">Selamat datang di halaman detail tanggapan masyarakat.</p>
    </div>
  </header>	
 <!-- Konten Utama -->
      <?php foreach ($tanggapan as $t) : ?>
            <?php 
              
              $tanggal = date("d-m-Y", strtotime($t['tgl_tanggapan']));
              
            ;?>
            <!-- tampilan detail pengaduan -->
            <div class="container my-5">
              <h1 class="text-center mb-3">Detail Tanggapan</h1>
              <div class="card shadow">
                <div class="card-body">
                  <table class="table">
                    <tr>
                      <th>Nik:</th>
                      <?php foreach ($masyarakat as $m) : ?>
                      <td><?= $m['nik'];?></td>
                      <?php endforeach; ?> 
                    </tr>
                    <tr>
                      <th>Nama Pelapor:</th>
                      <?php foreach ($masyarakat as $m) : ?>
                      <td><?= $m['nama'];?></td>
                      <?php endforeach; ?> 
                    </tr>
                    <tr>
                      <th>Judul:</th>
                      <td><?= $t['judul'];?></td>
                    </tr>
                    <tr>
                      <th>Isi Tanggapan:</th>
                      <td><?= $t['tanggapan'];?></td>
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