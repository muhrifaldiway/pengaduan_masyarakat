<?php

session_start();

require 'function.php';

//jika tidak ada id_tanggapan
if (!isset($_GET['nik'])){
	header("Location: index.php");
	exit;
}

//ambil dari url
$id = $_GET['nik'];

// query kamar berdasarkan nik

$registrasi = query("SELECT * FROM registrasi WHERE nik = '$id'");


//menambahkan data dan mengirimkan data ke function.php yang ada didalam folder pemesanan
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
      echo "<script>
        alert('data berhasil diubah!');
        document.location.href = '../admin.php';
      </script>";
    }else {
      echo "<script>
        alert('data gagal diubah!');
        document.location.href = '../admin.php';
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
  <title>Ubah Registrasi</title>
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/ico/icon.png">
</head>
<body>
  <!-- Navbar -->
  
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">
    <img src="../assets/images/ico/adp.png" alt="icon" style="height: 40px; width: 40px;"><b>Admin</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <!-- End Navbar -->
<div class="p-5 bg-primary text-white text-center">
  <h1>Ubah Registrasi</h1>
  <p>Silahkan liat kembali dan lebih teliti lagi, jika ada yang salah silahkan diubah dan disesuaikan.</p> 
</div>

  <!-- Section -->
  <br>
  <section id="lapor">
    <div class="container">
    <h2 class="mb-3 text-center">Form Registrasi</h2><br>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-row">
        <?php foreach ($registrasi as $r) : ?>
        <input type="hidden" name="nik" value="<?= $r['nik'];?>">

        <div class="form-group col-md-6">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" value="<?= $r['nama'];?>">
        </div>

        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $r['email'];?>">
        </div>

        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="text" class="form-control" name="password" id="password" value="<?= $r['password'];?>">
        </div>

        <div class="form-group col-md-6">
            <label for="telepon">Telepon</label>
            <input type="number" class="form-control" name="telepon" id="telepon" value="<?= $r['telepon'];?>">
        </div>
      
        <div class="form-group col-md-6">
                <label for="role_id">Role_id</label>
                <?php 
                
                  $role_id = array("1", "2", "3");
                  $role = $r['role_id'];
                  $selected_status = $role;
                  
                ?>
                
                <select name="role_id" id="role_id" class="form-control">
                    <?php foreach ($role_id as $rl) { ?>
                      <option value="<?php echo $rl; ?>" <?php if ($rl == $selected_status) echo "selected"; ?>><?php echo $rl; ?></option>
                    <?php } ?>
                </select>
                
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