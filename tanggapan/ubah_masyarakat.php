<?php

session_start();

require 'function.php';

//jika tidak ada id_pengaduan
if (!isset($_GET['id_pengaduan'])){
	header("Location: index.php");
	exit;
}

//ambil dari url
$id = $_GET['id_pengaduan'];

// query kamar berdasarkan id_pengaduan

$pengaduan = query("SELECT * FROM pengaduan WHERE id_pengaduan = $id");




//menambahkan data dan mengirimkan data ke function.php yang ada didalam folder pemesanan
if (isset($_POST['ubah'])) {
    if (ubah_masyarakat($_POST) > 0) {
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
  <title>Ubah pengaduan masyarakat</title>
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/ico/icon.png">
</head>
<body>
  <!-- Navbar -->
  
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">
      <img src="../assets/images/ico/adp.png" alt="icon" style="height: 40px; width: 40px;"><b>Ubah Pengaduan Masyarakat</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
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
      <?php foreach ($pengaduan as $p) : ?>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-row">
        <div class="form-group col-md-6" hidden>
            <input class="form-control" name="id_pengaduan" id="id_pengaduan" value="<?= $p['id_pengaduan'];?>">
        </div>
        <div class="form-group col-md-6">
            <label for="nik">Nik</label>
            <input type="text" class="form-control" name="nik" id="nik" value="<?= $p['nik'];?>" >
        </div>
        <div class="form-group col-md-6">
            <label for="tgl_pengaduan">Tanggal Pengaduan</label>
            <input type="date" class="form-control" name="tgl_pengaduan" id="tgl_pengaduan" value="<?= $p['tgl_pengaduan'];?>">
        </div>
        <div class="form-group col-md-6">
        <label for="judul">Judul Laporan</label>
        <input type="text" class="form-control" name="judul" id="judul" value="<?= $p['judul'];?>">
        </div>
        <div class="form-group col-md-6">
        <label for="isi_laporan">Isi Laporan</label>
            <textarea class="form-control" name="isi_laporan" id="isi_laporan" rows="3" value="<?= $p['isi_laporan'];?>"><?= $p['isi_laporan'];?></textarea>
        </div>
        <div class="form-group col-md-6">
        <label for="foto">Foto</label>
            <input type="hidden" name="foto_lama" value="<?=$p['foto'];?>">
            <input type="file" name="foto" id="gambar" onchange="previewImage()"/>
            <img src="../assets/images/file/<?= $p['foto'];?>" width="80" style="display: block;" 
            id="preview" alt="Gambar Preview"/>
        </div>
        <div class="form-group col-md-6">
                <label for="status">Status</label>
                <?php 
                
                  $status = array("proses", "selesai");
                  $s = $p['status'];
                  $selected_status = $s;
                  
                ?>
                
                <select name="status" id="status" class="form-control">
                    <?php foreach ($status as $s) { ?>
                      <option value="<?php echo $s; ?>" <?php if ($s == $selected_status) echo "selected"; ?>><?php echo $s; ?></option>
                    <?php } ?>
                </select>
                
        </div>
        </div>
        <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
        <?php
        $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../kamar.php';
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