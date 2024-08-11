<?php

session_start();

require 'function.php';


//jika tidak ada id_kamar
if (!isset($_GET['nik'])){
	header("Location: index.php");
	exit;
}


//ambil dari url
$id = $_GET['nik'];

// query tanggapan berdasarkan nik dan mengambil data dari penggabungan 3 tabel yaitu data
// di tabel registrasi, pengaduan, dan tanggapan.

$user = query("SELECT * FROM registrasi WHERE nik = '$id'");

?>


<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <title>Halaman Detail Admin</title>
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/ico/icon.png">
</head>
<body>
  
  <!-- Header -->
  <header class="jumbotron jumbotron-fluid bg-primary text-white">
    <div class="container">
      <h1 class="display-4 text-center">Halaman Detail Admin</h1>
      <p class="lead text-center">Selamat datang di halaman detail admin.</p>
    </div>
  </header>	
 <!-- Konten Utama -->
      <?php foreach ($user as $r) : ?>

            <!-- tampilan detail pengaduan -->
            <div class="container my-5">
              <h1 class="text-center mb-3">Detail Registrasi</h1>
              <div class="card shadow">
                <div class="card-body">
                  <table class="table">
                    <tr>
                      <th>Nik:</th>
                      <td><?= $r['nik'];?></td>
                    </tr>
                    <tr>
                      <th>Nama:</th>
                      <td><?= $r['nama'];?></td>
                    </tr>
                    <tr>
                      <th>Email:</th>
                      <td><?= $r['email'];?></td>
                    </tr>
                    <tr>
                      <th>Password:</th>
                      <td><?= $r['password'];?></td>
                    </tr>
                    <tr>
                      <th>Telepon:</th>
                      <td><?= $r['telepon'];?></td>
                    </tr>
                    <tr>
                      <th>Role_id:</th>
                      <td><?= $r['role_id'];?></td>
                    </tr>
                    <tr>
                      <th></th>
                    <?php
                    $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../admin.php';
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