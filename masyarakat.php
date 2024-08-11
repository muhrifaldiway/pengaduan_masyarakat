<?php

require 'masyarakat/function.php';
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role_id'] !== 1) {
    header("Location: login.php");
  exit;
} 


$masyarakat = query("SELECT * FROM registrasi WHERE role_id = 1");

$registrasi = query("SELECT pengaduan.id_pengaduan,pengaduan.nik,registrasi.nama,pengaduan.tgl_pengaduan,pengaduan.judul,pengaduan.isi_laporan,pengaduan.foto,pengaduan.status 
FROM pengaduan JOIN registrasi ON pengaduan.nik = registrasi.nik WHERE role_id = 1");

$pengaduan = query("SELECT * FROM pengaduan");
//cek apakah tombol simpan sudah ditekan

if (isset($_POST['kirim'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
      alert('data berhasil ditambahkan!');
      document.location.href = 'masyarakat.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal ditambahkan!');
      document.location.href = 'masyarakat.php';
    </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Pengaduan Masyarakat</title>
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/icon.png">
</head>
<body>
  <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">
    <img src="assets/images/ico/home.png" alt="icon" style="height: 40px; width: 40px;"><b>Masyarakat</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="masyarakat.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tentang.php">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kontak.php">Kontak</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        
      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
<div class="p-5 bg-primary text-white text-center">
  <h1>Pengaduan Masyarakat</h1>
  <p>Laporkan masalah yang anda hadapi pada masyarakat sekitar.</p> 
</div>

  <!-- Section -->
  <br>
  <section id="lapor">
    <div class="container">
      <h2 class="text-center mb-5">Form Pengaduan</h2>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="nik">Nama Masyarakat</label>
                <select name="nik" id="nik" class="form-control" required>
                    <option>Silahkan Pilih !</option>
                    <?php foreach ($masyarakat as $m) :?>
            
                    <option value="<?= $m['nik'];?>"><?= $m['nama'];?></option>
                    
                    <?php endforeach ;?>
                </select>
        </div>
        <div class="form-group col-md-6">
            <label for="tgl_pengaduan">Tanggal Pengaduan</label>
            <input type="date" class="form-control" name="tgl_pengaduan" id="tgl_pengaduan" required>
        </div>
        <div class="form-group col-md-6">
        <label for="judul">Judul Laporan</label>
        <input type="text" class="form-control" name="judul" id="judul" required>
        </div>
        <div class="form-group col-md-6">
        <label for="isi_laporan">Isi Laporan</label>
            <textarea class="form-control" name="isi_laporan" id="isi_laporan" rows="3" required></textarea>
        </div>
        <div class="form-group col-md-6">
        <label for="foto">Foto</label>
            <input type="file" name="foto" id="gambar" onchange="previewImage()"/>
            <img src="assets/images/file/unduhan.png" width="80" style="display: block;" 
            id="preview" alt="Gambar Preview"/>
        </div>
        <div class="form-group col-md-6" hidden>
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option>Silahkan Pilih !</option>
                    <option value="proses" selected>Proses</option>
                    <option value="selesai">Selesai</option>
                </select>
        </div>
        </div>
        <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
        </form>
        <br>
        <hr>
         <!-- Tab Pemesanan -->
    <h2 class="mb-3">Daftar Pengaduan</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Tanggal Pengaduan</th>
          <th scope="col">Judul</th>
          <th scope="col">Status</th>
          <th scope="col">Aksi</th>
        </tr>
        <?php if(empty($pengaduan)): ?>
          <tr>
            <td colspan="4"><p style="color:red; font-style: italic;">data anda tidak ditemukan!</p></td>
          </tr>
        <?php endif;?>
      </thead>
      <tbody>

      <?php $no = 1;
          foreach ($pengaduan as $p) : ?>
          <?php 
          
          $tanggal = date("d-m-Y", strtotime($p['tgl_pengaduan']));
          
          ;?>
        <tr>
          <th scope="row"><?= $no++;?></th>
          <td><?= $tanggal;?></td>
          <td><?= $p['judul'];?></td>
          <td><span class="badge badge-pill badge-warning text-white"><?= $p['status'];?></span></td>
          
          <td>

            <a href="masyarakat/detail.php?id_pengaduan=<?=$p['id_pengaduan'];?>" 
            class="btn btn-primary btn-sm" name="detail">detail</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
        </div>

        </section>
        <!-- End Section -->
        <!-- Footer -->
        <br>
        <footer class="bg-light text-dark py-3">
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