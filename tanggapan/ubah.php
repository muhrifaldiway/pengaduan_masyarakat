<?php

session_start();

require 'function.php';

//jika tidak ada id_tanggapan
if (!isset($_GET['id_tanggapan'])){
	header("Location: index.php");
	exit;
}

//ambil dari url
$id = $_GET['id_tanggapan'];

// query kamar berdasarkan id_tanggapan

$tanggapan = query("SELECT * FROM tanggapan WHERE id_tanggapan = $id");

$pengaduan = query("SELECT pengaduan.id_pengaduan,pengaduan.nik,registrasi.nama,pengaduan.tgl_pengaduan,pengaduan.judul,pengaduan.isi_laporan,pengaduan.foto,pengaduan.status 
FROM pengaduan JOIN registrasi ON pengaduan.nik = registrasi.nik WHERE id_pengaduan");

$masyarakat = query("SELECT registrasi.nama FROM registrasi JOIN pengaduan ON registrasi.nik = pengaduan.nik
                      JOIN tanggapan ON pengaduan.id_pengaduan = tanggapan.pengaduan_id WHERE id_tanggapan = $id");

$petugas = query("SELECT tanggapan.nik,registrasi.nama FROM tanggapan 
                  JOIN registrasi ON tanggapan.nik = registrasi.nik WHERE role_id = 2");


//menambahkan data dan mengirimkan data ke function.php yang ada didalam folder pemesanan
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
      echo "<script>
        alert('data berhasil diubah!');
        document.location.href = '../tanggapan.php';
      </script>";
    }else {
      echo "<script>
        alert('data gagal diubah!');
        document.location.href = '../tanggapan.php';
      </script>";
    }
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <title>Ubah Tanggapan</title>
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/ico/icon.png">
</head>
<body>
  <!-- Navbar -->
  
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">
    <img src="../assets/images/ico/adp.png" alt="icon" style="height: 40px; width: 40px;"><b>Ubah Tanggapan Petugas</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <!-- End Navbar -->
<div class="p-5 bg-primary text-white text-center">
  <h1>Ubah Tanggapan Masyarakat</h1>
  <p>Silahkan liat kembali dan lebih teliti lagi, jika ada yang salah silahkan diubah dan disesuaikan.</p> 
</div>

  <!-- Section -->
  <br>
  <section id="lapor">
    <div class="container">
    <h2 class="mb-3 text-center">Form Tanggapan</h2><br>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-row">
        <?php foreach ($tanggapan as $t) : ?>
            <input type="hidden" class="form-control" name="id_tanggapan" value="<?= $t['id_tanggapan'];?>">
        <div class="form-group col-md-6">
            <input type="hidden" class="form-control" name="pengaduan_id" value="<?= $t['pengaduan_id'];?>">
        </div>
        <div class="form-group col-md-6">
            <input type="hidden" class="form-control" name="nik" id="nik" value="<?= $t['nik'];?>">
        </div>

        <div class="form-group col-md-6">
        <label for="tgl_tanggapan">Judul</label>
                <select name="judul" id="judul" class="form-control">
                      <option value="<?= $t['judul'];?>" selected><?= $t['judul'];?></option>
                </select>
        </div>
        <div class="form-group col-md-6">
            <label for="tgl_tanggapan">Tanggal tanggapan</label>
            <input type="date" class="form-control" name="tgl_tanggapan" id="tgl_tanggapan" value="<?= $t['tgl_tanggapan'];?>">
        </div>
      
        <div class="form-group col-md-6">
        <label for="tanggapan">Tanggapan</label>
            <textarea class="form-control" name="tanggapan" id="tanggapan" rows="3" value="<?= $t['tanggapan'];?>"><?= $t['tanggapan'];?></textarea>
        </div>
       
        </div>

        <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
        <?php
        $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../tanggapan.php';
        ?>
        <a href="<?=$url?>" type="button" class="btn btn-secondary">Kembali</a> 
        </form>
        <?php endforeach; ?> 
        <br>
        <hr>
        
        </section>
        <!-- End Section -->
        <!-- Footer -->
        <br>
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