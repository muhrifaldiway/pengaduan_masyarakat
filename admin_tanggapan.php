<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'tanggapan/function.php';

$pengaduan = query("SELECT pengaduan.id_pengaduan,pengaduan.nik,registrasi.nama,pengaduan.tgl_pengaduan,pengaduan.judul,pengaduan.isi_laporan,pengaduan.foto,pengaduan.status 
FROM pengaduan JOIN registrasi ON pengaduan.nik = registrasi.nik WHERE id_pengaduan");

$petugas = query("SELECT * FROM registrasi WHERE role_id = 2");

$admin = query("SELECT * FROM registrasi WHERE role_id = 3");

$tanggapan = query("SELECT * FROM tanggapan");
//cek apakah tombol simpan sudah ditekan

if (isset($_POST['kirim'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
      alert('data berhasil ditambahkan!');
      document.location.href = 'admin_tanggapan.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal ditambahkan!');
      document.location.href = 'admin_tanggapan.php';
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
  <title>Tanggapan Pengaduan Masyarakat</title>
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/icon.png">
</head>
<body>
  <!-- Navbar -->
  
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
    <img src="assets/images/ico/adp.png" alt="icon" style="height: 40px; width: 40px;"><b>Admin Tanggapan</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        
      </ul>
    </div>
  </nav>
  <!-- End Navbar -->
  
<div class="p-5 bg-primary text-white text-center">
  <h1>Tanggapan Pengaduan Masyarakat</h1>
  <p>Tanggapi masalah yang ada pada masyarakat sekitar.</p> 
</div>
<section id="lapor">
    <div class="container">
      <!-- Section -->
      
      <br>
      <h2 class="mb-3 text-center">Form Tanggapan</h2><br>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-row">
        <div class="form-group col-md-6">
                <label for="pengaduan_id">Nama Masyarakat</label>
                <select name="pengaduan_id" id="pengaduan_id" class="form-control" required>
                    <option>Silahkan Pilih !</option>
                    <?php foreach ($pengaduan as $p) :?>
            
                      <option value="<?= $p['id_pengaduan'];?>"><?= $p['nama'];?></option>
                    
                    <?php endforeach ;?>
                </select>
        </div>

        <div class="form-group col-md-6">
                <label for="nik">Nama Petugas</label>
                <select name="nik" id="nik" class="form-control" required>
                    <option>Silahkan Pilih !</option>
                    <?php foreach ($admin as $ad) :?>
                      <option value="<?= $ad['nik'];?>"><?= $ad['nama'];?></option>
                    <?php endforeach ;?>
                </select>
        </div>

        <div class="form-group col-md-6">
                <label for="judul">Judul Pengaduan</label>
                <select name="judul" id="judul" class="form-control" required>
                    <option>Silahkan Pilih !</option>
                    <?php foreach ($pengaduan as $p) :?>
            
                      <option value="<?= $p['judul'];?>"><?= $p['judul'];?></option>
                    
                    <?php endforeach ;?>
                </select>
        </div>

        <div class="form-group col-md-6">
            <label for="tgl_tanggapan">Tanggal tanggapan</label>
            <input type="date" class="form-control" name="tgl_tanggapan" id="tgl_tanggapan" required>
        </div>
      
        <div class="form-group col-md-6">
        <label for="tanggapan">Tanggapan</label>
            <textarea class="form-control" name="tanggapan" id="tanggapan" rows="3" required></textarea>
        </div>
       
        </div>
        <button type="submit" name="kirim" class="btn btn-primary">Kirim</button>
        </form>


      <br><br><br>
      <h2 class="mb-3 text-center">Daftar Pengaduan</h2><br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nik</th>
              <th scope="col">Nama Pelapor</th>
              <th scope="col">Tanggal Pengaduan</th>
              <th scope="col">Judul</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>

          <?php $no = 1;
              foreach ($pengaduan as $p) : ?>
              <?php 
              
              $tanggal = date("d-m-Y", strtotime($p['tgl_pengaduan']));
              
              ;?>
            <tr>
              <th scope="row"><?= $no++;?></th>
              <td><?= $p['nik'];?></td>
              <td><?= $p['nama'];?></td>
              <td><?= $tanggal;?></td>
              <td><?= $p['judul'];?></td>
              <td><span class="badge badge-pill badge-warning text-white"><?= $p['status'];?></span></td>
              
              <td>
                <a href="masyarakat/detail.php?id_pengaduan=<?=$p['id_pengaduan'];?>" 
                class="btn btn-primary btn-sm" name="detail">detail</a>
                <a href="admin/ubah_masyarakat.php?id_pengaduan=<?=$p['id_pengaduan'];?>" 
                class="btn btn-success btn-sm" name="ubah">ubah</a>
                <a href="admin/hapus_pengaduan.php?id_pengaduan=<?=$p['id_pengaduan'];?>" onclick="return confirm('apakah anda yakin?');"
                class="btn btn-danger btn-sm" name="hapus_pengaduan">hapus</a>

              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <br>
        
        <br><br>

      <h2 class="mb-3 text-center">Daftar Tanggapan</h2><br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Judul</th>
              <th scope="col">Tanggal Tanggapan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>

          <?php $no = 1;
              foreach ($tanggapan as $t) : ?>
              <?php 
              
              $tanggal = date("d-m-Y", strtotime($t['tgl_tanggapan']));
              
              ;?>
            <tr>
              <th scope="row"><?= $no++;?></th>
              <td><?= $t['judul'];?></td>
              <td><?= $tanggal;?></td>
              <td>
                <a href="admin/detail_tanggapan.php?id_tanggapan=<?=$t['id_tanggapan'];?>" 
                class="btn btn-primary btn-sm" name="detail">detail</a>
                <a href="admin/ubah_tanggapan.php?id_tanggapan=<?=$t['id_tanggapan'];?>" 
                class="btn btn-success btn-sm" name="ubah">ubah</a>
                <a href="admin/hapus_tanggapan.php?id_tanggapan=<?=$t['id_tanggapan'];?>" onclick="return confirm('apakah anda yakin?');"
                class="btn btn-danger btn-sm" name="hapus">hapus</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <br>
        </section>
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