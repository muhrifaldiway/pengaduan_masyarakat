<?php

session_start();

if (!isset($_SESSION['login'])|| $_SESSION['role_id'] !== 3) {
  header("Location: login.php");
  exit;
}

require 'admin/function.php';

$registrasi = query("SELECT * FROM registrasi");
//cek apakah tombol simpan sudah ditekan

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Admin Pengaduan Masyarakat</title>
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/icon.png">
</head>
<body>
  <!-- Navbar -->
  
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">
    <img src="assets/images/ico/adp.png" alt="icon" style="height: 40px; width: 40px;"><b>Admin</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="admin_tanggapan.php">Petugas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
  
<div class="p-5 bg-primary text-white text-center">
  <h1>Admin Pengaduan Masyarakat</h1>
  <p>selamat datang dihalaman admin pengaduan masyarakat.</p> 
</div>
<section id="lapor">
    <div class="container">
      <!-- Section -->
      
      <br><br><br>
      <h2 class="mb-3 text-center">Daftar Registrasi</h2><br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nik</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">Telepon</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>

          <?php $no = 1;
              foreach ($registrasi as $r) : ?>
            <tr>
              <th scope="row"><?= $no++;?></th>
              <td><?= $r['nik'];?></td>
              <td><?= $r['nama'];?></td>
              <td><?= $r['email'];?></td>
              <td><?= $r['telepon'];?></td>
              
              <td>

                <a href="admin/detail.php?nik=<?=$r['nik'];?>"class="btn btn-primary btn-sm" name="detail">detail</a>
                <a href="javascript:window.print()" type="button" class="btn btn-warning btn-sm text-white">
                    Cetak
                </a> 
                <a href="admin/ubah.php?nik=<?=$r['nik'];?>"class="btn btn-success btn-sm" name="ubah">ubah</a>

                <a href="admin/hapus.php?nik=<?=$r['nik'];?>" onclick="return confirm('apakah anda yakin?');"
                class="btn btn-danger btn-sm" name="hapus">hapus</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <br>
        
        
        <br><br><br><br><br><br><br><br>
        <footer class="bg-light py-3">
            <div class="container">
            <p class="text-center">&copy; 2023 Pengaduan Masyarakat</p>
            </div>
        </footer>
        <!-- End Footer -->
        <script>
        function previewImage() {
            var preview = document.getElementById('preview');
            var file = document.getElementById('gambar').files[0];
            var reader = new FileReader();
            
            reader.onloadend = function() {
            preview.src = reader.result;
            }
            
            if (file) {
            reader.readAsDataURL(file);
            } else {
            preview.src = "";
            }
        }
        </script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>