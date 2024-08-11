# WEBSITE PENGADUAN MASYARAKAT

Berikut struktur folder dan file dalam website ini:

```
📦Pengaduan Masyarakat
 ┣ 📦admin
    ┣ 📜cetak.php
    ┗ 📜detail_tanggapan.php
    ┗ 📜detail.php
    ┗ 📜function.php
    ┗ 📜hapus_pengaduan.php
    ┗ 📜hapus_tanggapan.php
    ┗ 📜hapus.php
    ┗ 📜ubah_masyarakat.php
    ┗ 📜ubah_tanggapan.php
    ┗ 📜ubah.php
 ┣ 📦assets
 ┣ 📦login
    ┗ 📜function.php
 ┣ 📦masyarakat
    ┗ 📜detail.php
    ┗ 📜function.php
    ┗ 📜hapus.php
    ┗ 📜ubah.php
 ┣ 📦registrasi
    ┗ 📜function.php
 ┣ 📦tanggapan
    ┣ 📜cetak.php
    ┗ 📜detail.php
    ┗ 📜function.php
    ┗ 📜hapus_pengaduan.php
    ┗ 📜hapus.php
    ┗ 📜ubah_masyarakat.php
    ┗ 📜ubah.php
 ┃
 ┣ 📜admin_tanggapan.php
 ┗ 📜admin.php
 ┗ 📜kontak.php
 ┗ 📜login.php
 ┗ 📜logout.php
 ┗ 📜masyarakat.php
 ┗ README.md
 ┗ 📜registrasi.php
 ┗ 📜tanggapan.php
 ┗ 📜tentang.php
```

## Folder ADMIN
## cetak.php
```php

    <?php

    require 'function.php';

    $id = $_GET['id_pemesanan'];

    $pemesanan = query("SELECT pemesanan.tgl_cekin, pemesanan.tgl_cekout, pemesanan.jumlah_kamar, pemesanan.nama, pemesanan.email, kamar.harga, pemesanan.status 
    FROM pemesanan JOIN kamar ON pemesanan.kamar_id = kamar.id_kamar WHERE id_pemesanan = $id;");


    header('Content-Type: application/pdf');
    readfile('dokumen.pdf');

    ;?>

```
## detail_tanggapan.php
```php

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

```

## detail.php
```php

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

```

## function.php

```php
<?php

	function koneksi() {

	return mysqli_connect('localhost', 'root', '', 'pengaduan_masyarakat');

}

function query($query){

	$conn = koneksi();
	
	$result = mysqli_query($conn, $query);
	
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		
		$rows[] = $row;
	}


	return $rows; 

}

function upload(){

	//var_dump($_FILES);
	//die;

	$nama_file = $_FILES['foto']['name'];
	$tipe_file = $_FILES['foto']['type'];
	$ukuran_file = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmp_file = $_FILES['foto']['tmp_name'];

	// ketika tidak ada gambar yang dipilih

	if ($error == 4) {
		
		return 'unduhan.png';
	}

	//cek ekstenti file
	$daftar_foto = ['jpg','jpeg','png'];
	$ekstenti_file = explode('.', $nama_file);
	$ekstenti_file = strtolower(end($ekstenti_file));
	if (!in_array($ekstenti_file, $daftar_foto)) {
		echo "<script>
	      alert('yang anda pilih bukan foto!');
	      document.location.href = 'tanggapan.php';
	    </script>";
		return false;
	}

	//cek ukuran file

	if ($ukuran_file > 2000000){
		echo "<script>
	      alert('ukuran file besar!');
	      document.location.href = 'tanggapan.php';
	    </script>";
		return false;
	}

	//upload file
	//generate nama_file
	$nama_file_baru = uniqid();
	$nama_file_baru .= '.';
	$nama_file_baru .= $ekstenti_file;
	move_uploaded_file($tmp_file, '../assets/images/file/'. $nama_file_baru);

	return $nama_file_baru;
}



function ubah($data){

	$conn = koneksi();

	$id = $data['nik'];
	$nama = htmlspecialchars($data['nama']);
	$email = htmlspecialchars($data['email']);
	$password = htmlspecialchars($data['password']);
	$telepon = htmlspecialchars($data['telepon']);
	$role_id = htmlspecialchars($data['role_id']);

	$query = "UPDATE registrasi SET
			  nama = '$nama',
			  email = '$email',
			  password = '$password',
			  telepon = '$telepon',
			  role_id = '$role_id'
			  WHERE nik = '$id'; 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function ubah_masyarakat($data){

	$conn = koneksi();

	$id = $data['id_pengaduan'];
	$nik = $data['nik'];
	$tgl_pengaduan = htmlspecialchars($data['tgl_pengaduan']);
	$judul = htmlspecialchars($data['judul']);
	$isi_laporan = htmlspecialchars($data['isi_laporan']);
	$foto_lama = htmlspecialchars($data['foto_lama']);
	$status = htmlspecialchars($data['status']);

	$foto = upload();
	if (!$foto) {
		return false;
	}

	if ($foto == 'unduhan.png'){
		
		$foto = $foto_lama;
	}
	

	$query = "UPDATE pengaduan SET
			  nik = '$nik',
			  tgl_pengaduan = '$tgl_pengaduan',
			  judul = '$judul',
			  isi_laporan = '$isi_laporan',
			  foto = '$foto',
			  status = '$status'
			  WHERE id_pengaduan = $id; 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function ubah_tanggapan($data){

	$conn = koneksi();

	$id = $data['id_tanggapan'];
	$pengaduan_id = htmlspecialchars($data['pengaduan_id']);
	$nik = htmlspecialchars($data['nik']);
	$judul = htmlspecialchars($data['judul']);
	$tgl_tanggapan = htmlspecialchars($data['tgl_tanggapan']);
	$tanggapan = htmlspecialchars($data['tanggapan']);


	$query = "UPDATE tanggapan SET
			
			  pengaduan_id = '$pengaduan_id',
			  nik = '$nik',
			  judul = '$judul',
			  tgl_tanggapan = '$tgl_tanggapan',
			  tanggapan = '$tanggapan'
			  
			  WHERE id_tanggapan = $id; 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}



function hapus($id){
	
	$conn = koneksi();

	mysqli_query($conn, "DELETE FROM registrasi WHERE nik = '$id'") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function hapus_pengaduan($id){
	
	$conn = koneksi();

	mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan = $id") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function hapus_tanggapan($id){
	
	$conn = koneksi();

	mysqli_query($conn, "DELETE FROM tanggapan WHERE id_tanggapan = $id") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


```

## hapus_pengaduan.php

```php

<?php

require 'function.php';

//jika tidak ada id_pemesanan
if (!isset($_GET['id_pengaduan'])){
	header("Location: index.php");
	exit;
}


//ambil dari url
$id = $_GET['id_pengaduan'];


  if (hapus_pengaduan($id) > 0) {
    echo "<script>
      alert('data berhasil dihapus!');
      document.location.href = '../admin_tanggapan.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal dihapus!');
      document.location.href = '../admin_tanggapan.php';
    </script>";
  }


?>

```
## hapus_tanggapan.php

```php

<?php

require 'function.php';

//jika tidak ada id_pemesanan
if (!isset($_GET['id_tanggapan'])){
	header("Location: index.php");
	exit;
}


//ambil dari url
$id = $_GET['id_tanggapan'];


  if (hapus_tanggapan($id) > 0) {
    echo "<script>
      alert('data berhasil dihapus!');
      document.location.href = '../admin_tanggapan.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal dihapus!');
      document.location.href = '../admin_tanggapan.php';
    </script>";
  }


?>

```
## hapus.php

```php

<?php

require 'function.php';

//jika tidak ada id_pemesanan
if (!isset($_GET['nik'])){
	header("Location: index.php");
	exit;
}


//ambil dari url
$id = $_GET['nik'];


  if (hapus($id) > 0) {
    echo "<script>
      alert('data berhasil dihapus!');
      document.location.href = '../admin.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal dihapus!');
      document.location.href = '../admin.php';
    </script>";
  }


?>

```
## ubah_masyarakat.php

```php

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
        document.location.href = '../admin_tanggapan.php';
      </script>";
    }else {
      echo "<script>
        alert('data gagal diubah!');
        document.location.href = '../admin_tanggapan.php';
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
  <title>Admin Ubah Pengaduan</title>
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/ico/icon.png">
</head>
<body>
  <!-- Navbar -->
  
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">
      <img src="../assets/images/ico/adp.png" alt="icon" style="height: 40px; width: 40px;"><b>Admin Ubah Pengaduan</b></a>
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

```
## ubah_tanggapan.php

```php

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
    if (ubah_tanggapan($_POST) > 0) {
      echo "<script>
        alert('data berhasil diubah!');
        document.location.href = '../admin_tanggapan.php';
      </script>";
    }else {
      echo "<script>
        alert('data gagal diubah!');
        document.location.href = '../admin_tanggapan.php';
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
  <title>Admin Ubah Tanggapan</title>
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/ico/icon.png">
</head>
<body>
  <!-- Navbar -->
  
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">
    <img src="../assets/images/ico/adp.png" alt="icon" style="height: 40px; width: 40px;"><b>Ubah Tanggapan Admin</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
  <!-- End Navbar -->
<div class="p-5 bg-primary text-white text-center">
  <h1>Ubah Tanggapan Admin</h1>
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

```
## ubah.php

```php

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

```

## folder LOGIN
## function.php

```php

<?php

	function koneksi() {

	return mysqli_connect('localhost', 'root', '', 'pengaduan_masyarakat');

}

function query($query){

	$conn = koneksi();
	
	$result = mysqli_query($conn, $query);
	
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		
		$rows[] = $row;
	}


	return $rows; 

}

function login($data)
{
	
		$conn = koneksi();
	
		$email = htmlspecialchars($data['email']);
		$password = htmlspecialchars($data['password']);
	
		if (query("SELECT * FROM registrasi WHERE email = '$email' && password = '$password'
		&& role_id = 1")) {
			//set session
			$_SESSION['role_id'] = 1;
			$_SESSION['login'] = true;
			header("Location: masyarakat.php");
			exit;
		} elseif (query("SELECT * FROM registrasi WHERE email = '$email' && password = '$password'
		&& role_id = 2")) {
			//set session
			$_SESSION['role_id'] = 2;
			$_SESSION['login'] = true;
			header("Location: tanggapan.php");
			exit;
		} elseif (query("SELECT * FROM registrasi WHERE email = '$email' && password = '$password'
		&& role_id = 3")) {
			//set session
			$_SESSION['role_id'] = 3;
			$_SESSION['login'] = true;
			header("Location: admin.php");
			exit;
		} else {
			return [
				'error' => true,
				'pesan' => 'Username / Password Salah!'
			];
		}
	}

```

## FOLDER masyarakat
## detail.php

```php

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
  <header class="jumbotron jumbotron-fluid bg-dark text-white">
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

```

## function.php

```php

<?php

	function koneksi() {

	return mysqli_connect('localhost', 'root', '', 'pengaduan_masyarakat');

}

function query($query){

	$conn = koneksi();
	
	$result = mysqli_query($conn, $query);
	
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		
		$rows[] = $row;
	}


	return $rows; 

}


function upload(){

	//var_dump($_FILES);
	//die;

	$nama_file = $_FILES['foto']['name'];
	$tipe_file = $_FILES['foto']['type'];
	$ukuran_file = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmp_file = $_FILES['foto']['tmp_name'];

	// ketika tidak ada gambar yang dipilih

	if ($error == 4) {
		
		return 'unduhan.png';
	}

	//cek ekstenti file
	$daftar_foto = ['jpg','jpeg','png'];
	$ekstenti_file = explode('.', $nama_file);
	$ekstenti_file = strtolower(end($ekstenti_file));
	if (!in_array($ekstenti_file, $daftar_foto)) {
		echo "<script>
	      alert('yang anda pilih bukan foto!');
	      document.location.href = 'masyarakat.php';
	    </script>";
		return false;
	}

	//cek ukuran file

	if ($ukuran_file > 2000000){
		echo "<script>
	      alert('ukuran file besar!');
	      document.location.href = 'masyarakat.php';
	    </script>";
		return false;
	}

	//upload file
	//generate nama_file
	$nama_file_baru = uniqid();
	$nama_file_baru .= '.';
	$nama_file_baru .= $ekstenti_file;
	move_uploaded_file($tmp_file, 'assets/images/file/'. $nama_file_baru);

	return $nama_file_baru;
}

function upload_ubah(){

	//var_dump($_FILES);
	//die;

	$nama_file = $_FILES['foto']['name'];
	$tipe_file = $_FILES['foto']['type'];
	$ukuran_file = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmp_file = $_FILES['foto']['tmp_name'];

	// ketika tidak ada gambar yang dipilih

	if ($error == 4) {
		
		return 'unduhan.png';
	}

	//cek ekstenti file
	$daftar_foto = ['jpg','jpeg','png'];
	$ekstenti_file = explode('.', $nama_file);
	$ekstenti_file = strtolower(end($ekstenti_file));
	if (!in_array($ekstenti_file, $daftar_foto)) {
		echo "<script>
	      alert('yang anda pilih bukan foto!');
	      document.location.href = 'masyarakat.php';
	    </script>";
		return false;
	}

	//cek ukuran file

	if ($ukuran_file > 2000000){
		echo "<script>
	      alert('ukuran file besar!');
	      document.location.href = 'masyarakat.php';
	    </script>";
		return false;
	}

	//upload file
	//generate nama_file
	$nama_file_baru = uniqid();
	$nama_file_baru .= '.';
	$nama_file_baru .= $ekstenti_file;
	move_uploaded_file($tmp_file, '../assets/images/file/'. $nama_file_baru);

	return $nama_file_baru;
}


function tambah($data){

	$conn = koneksi();

	$nik = htmlspecialchars($data['nik']);
	$tgl_pengaduan = htmlspecialchars($data['tgl_pengaduan']);
	$judul = htmlspecialchars($data['judul']);
	$isi_laporan = htmlspecialchars($data['isi_laporan']);

	$foto = upload();

	$status = htmlspecialchars($data['status']);

	$query = "INSERT INTO
				pengaduan
			  VALUES
			  (null, '$nik','$tgl_pengaduan','$judul','$isi_laporan','$foto','$status'); 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function hapus($id){
	
	$conn = koneksi();

	mysqli_query($conn, "DELETE FROM kamar WHERE id_kamar = $id") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function ubah($data){

	$conn = koneksi();

	$id = $data['id_pengaduan'];
	$nik = htmlspecialchars($data['nik']);
	$tgl_pengaduan = htmlspecialchars($data['tgl_pengaduan']);
	$judul = htmlspecialchars($data['judul']);
	$isi_laporan = htmlspecialchars($data['isi_laporan']);
	$foto_lama = htmlspecialchars($data['foto_lama']);
	$status = htmlspecialchars($data['status']);

	$foto = upload_ubah();
	if (!$foto) {
		return false;
	}

	if ($foto == 'unduhan.png'){
		
		$foto = $foto_lama;
	}
	

	$query = "UPDATE pengaduan SET
			  nik = '$nik',
			  tgl_pengaduan = '$tgl_pengaduan',
			  judul = '$judul',
			  isi_laporan = '$isi_laporan',
			  foto = '$foto',
			  status = '$status'
			  WHERE id_pengaduan = $id; 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

```

## hapus.php

```php

<?php

require 'function.php';

//jika tidak ada id_pemesanan
if (!isset($_GET['id_pemesanan'])){
	header("Location: index.php");
	exit;
}


//ambil dari url
$id = $_GET['id_pemesanan'];


  if (hapus($id) > 0) {
    echo "<script>
      alert('data berhasil dihapus!');
      document.location.href = '../pemesanan.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal dihapus!');
      document.location.href = '../pemesanan.php';
    </script>";
  }


?>

```

## ubah.php

```php

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
    if (ubah($_POST) > 0) {
      echo "<script>
        alert('data berhasil diubah!');
        document.location.href = '../masyarakat.php';
      </script>";
    }else {
      echo "<script>
        alert('data gagal diubah!');
        document.location.href = '../masyarakat.php';
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
  <title>Pengaduan Masyarakat</title>
</head>
<body>
  <!-- Navbar -->
  
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Masyarakat</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Kontak</a>
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
        <?php foreach ($pengaduan as $p) : ?>
        <div class="form-group col-md-6" hidden>
            <input type="number" class="form-control" name="id_pengaduan" id="id_pengaduan" value="<?= $p['id_pengaduan'];?>">
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
        <div class="form-group col-md-6" hidden>
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="<?= $p['status'];?>"><?= $p['status'];?></option>
                    <option value="selesai">selesai</option>
                </select>
        </div>
        </div>
        <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
        <?php
        $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../masyarakat.php';
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

```

## registrasi
## function.php

```php

<?php

	function koneksi() {

	return mysqli_connect('localhost', 'root', '', 'pengaduan_masyarakat');

}

function query($query){

	$conn = koneksi();
	
	$result = mysqli_query($conn, $query);
	
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		
		$rows[] = $row;
	}


	return $rows; 

}

function registrasi($data)
	{
		$conn = koneksi();

		$nik = htmlspecialchars($data['nik']);
		$nama = htmlspecialchars($data['nama']);
		$email = htmlspecialchars(strtolower($data['email']));
		$password = htmlspecialchars($data['password']);
		$telepon = htmlspecialchars($data['telepon']);
		$role_id = htmlspecialchars($data['role_id']);


		//jika username sudah ada

		if (query("SELECT * FROM registrasi WHERE email = '$email'")) {
			echo"<script>
					alert('email sudah ada !');
					document.location.href = 'registrasi.php';
					</script>";
			return false;
		}

		// jika username & password sudah sesuai 
		// enskripsi password
		//$password_baru = password_hash($password, PASSWORD_DEFAULT);
		//insert ke tabel user
		$query = "INSERT INTO registrasi
					VALUES
				  ('$nik','$nama','$email','$password','$telepon','$role_id')
				";
		mysqli_query($conn, $query) or die(mysqli_error($conn));
		return mysqli_affected_rows($conn);
	}

```

## folder TANGGAPAN
## cetak.php

```php

<?php

require 'function.php';

$id = $_GET['id_pemesanan'];

$pemesanan = query("SELECT pemesanan.tgl_cekin, pemesanan.tgl_cekout, pemesanan.jumlah_kamar, pemesanan.nama, pemesanan.email, kamar.harga, pemesanan.status 
FROM pemesanan JOIN kamar ON pemesanan.kamar_id = kamar.id_kamar WHERE id_pemesanan = $id;");


header('Content-Type: application/pdf');
readfile('dokumen.pdf');

;?>

```
## detail.php

```php

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

```

## function.php

```php

<?php

	function koneksi() {

	return mysqli_connect('localhost', 'root', '', 'pengaduan_masyarakat');

}

function query($query){

	$conn = koneksi();
	
	$result = mysqli_query($conn, $query);
	
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		
		$rows[] = $row;
	}


	return $rows; 

}

function upload(){

	//var_dump($_FILES);
	//die;

	$nama_file = $_FILES['foto']['name'];
	$tipe_file = $_FILES['foto']['type'];
	$ukuran_file = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmp_file = $_FILES['foto']['tmp_name'];

	// ketika tidak ada gambar yang dipilih

	if ($error == 4) {
		
		return 'unduhan.png';
	}

	//cek ekstenti file
	$daftar_foto = ['jpg','jpeg','png'];
	$ekstenti_file = explode('.', $nama_file);
	$ekstenti_file = strtolower(end($ekstenti_file));
	if (!in_array($ekstenti_file, $daftar_foto)) {
		echo "<script>
	      alert('yang anda pilih bukan foto!');
	      document.location.href = 'tanggapan.php';
	    </script>";
		return false;
	}

	//cek ukuran file

	if ($ukuran_file > 2000000){
		echo "<script>
	      alert('ukuran file besar!');
	      document.location.href = 'tanggapan.php';
	    </script>";
		return false;
	}

	//upload file
	//generate nama_file
	$nama_file_baru = uniqid();
	$nama_file_baru .= '.';
	$nama_file_baru .= $ekstenti_file;
	move_uploaded_file($tmp_file, '../assets/images/file/'. $nama_file_baru);

	return $nama_file_baru;
}


function tambah($data){

	$conn = koneksi();

	$pengaduan_id = htmlspecialchars($data['pengaduan_id']);
	$nik = htmlspecialchars($data['nik']);
	$judul = htmlspecialchars($data['judul']);
	$tgl_tanggapan = htmlspecialchars($data['tgl_tanggapan']);
	$tanggapan = htmlspecialchars($data['tanggapan']);

	$query = "INSERT INTO
				tanggapan
			  VALUES
			  (null, '$pengaduan_id','$nik','$judul','$tgl_tanggapan','$tanggapan'); 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function hapus($id){
	
	$conn = koneksi();

	mysqli_query($conn, "DELETE FROM tanggapan WHERE id_tanggapan = $id") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function hapus_pengaduan($id){
	
	$conn = koneksi();

	mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan = $id") or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}


function ubah($data){

	$conn = koneksi();

	$id = $data['id_tanggapan'];
	$pengaduan_id = htmlspecialchars($data['pengaduan_id']);
	$nik = htmlspecialchars($data['nik']);
	$judul = htmlspecialchars($data['judul']);
	$tgl_tanggapan = htmlspecialchars($data['tgl_tanggapan']);
	$tanggapan = htmlspecialchars($data['tanggapan']);


	$query = "UPDATE tanggapan SET
			
			  pengaduan_id = '$pengaduan_id',
			  nik = '$nik',
			  judul = '$judul',
			  tgl_tanggapan = '$tgl_tanggapan',
			  tanggapan = '$tanggapan'
			  
			  WHERE id_tanggapan = $id; 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

function ubah_masyarakat($data){

	$conn = koneksi();

	$id = $data['id_pengaduan'];
	$nik = $data['nik'];
	$tgl_pengaduan = htmlspecialchars($data['tgl_pengaduan']);
	$judul = htmlspecialchars($data['judul']);
	$isi_laporan = htmlspecialchars($data['isi_laporan']);
	$foto_lama = htmlspecialchars($data['foto_lama']);
	$status = htmlspecialchars($data['status']);

	$foto = upload();
	if (!$foto) {
		return false;
	}

	if ($foto == 'unduhan.png'){
		
		$foto = $foto_lama;
	}
	

	$query = "UPDATE pengaduan SET
			  nik = '$nik',
			  tgl_pengaduan = '$tgl_pengaduan',
			  judul = '$judul',
			  isi_laporan = '$isi_laporan',
			  foto = '$foto',
			  status = '$status'
			  WHERE id_pengaduan = $id; 
			";
	mysqli_query($conn, $query)or die(mysqli_error($conn));

	return mysqli_affected_rows($conn);
}

```

## hapus_pengaduan.php
```php

<?php

require 'function.php';

//jika tidak ada id_pemesanan
if (!isset($_GET['id_pengaduan'])){
	header("Location: index.php");
	exit;
}


//ambil dari url
$id = $_GET['id_pengaduan'];


  if (hapus_pengaduan($id) > 0) {
    echo "<script>
      alert('data berhasil dihapus!');
      document.location.href = '../tanggapan.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal dihapus!');
      document.location.href = '../tanggapan.php';
    </script>";
  }


?>

```
## hapus.php

```php

<?php

require 'function.php';

//jika tidak ada id_pemesanan
if (!isset($_GET['id_tanggapan'])){
	header("Location: index.php");
	exit;
}


//ambil dari url
$id = $_GET['id_tanggapan'];


  if (hapus($id) > 0) {
    echo "<script>
      alert('data berhasil dihapus!');
      document.location.href = '../tanggapan.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal dihapus!');
      document.location.href = '../tanggapan.php';
    </script>";
  }


?>

```

## ubah_masyarakat.php
```php

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

```

## ubah.php

```php

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

```

## admin_tanggapan.php

```php

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
                <a href="admin/hapus_tanggapan.php?id_tanggapan=<?=$t['id_tanggapan'];?>" 
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

```

## admin.php

```php

<?php

session_start();

if (!isset($_SESSION['login'])) {
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

```

## kontak.php

```php

<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

?>


<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">

  <title>Halaman Kontak</title>
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/icon.png">
</head>
<body>
  
  <!-- Header -->
  <header class="jumbotron jumbotron-fluid bg-dark text-white">
    <div class="container">
      <h1 class="display-4 text-center">Halaman Kontak Pengaduan Masyarakat</h1>
      <p class="lead text-center">Selamat datang di halaman kontak Kami.</p>
    </div>
  </header>	
 <!-- Konten Utama -->
     

            <!-- tampilan detail pengaduan -->
            <div class="container my-5">
              <h1 class="text-center mb-3">Kontak Kami</h1>
              <div class="card shadow">
                <div class="card-body">
                  <table class="table">
                    <p class="text-center">
                          Email: <a href="mailto:contactsite@example.com">pengaduanmasyarakat@gmail.com</a>
                    <br>  Telepon: <a href="tel:+12023041208">+1 (202) 304-1208</a>
                    <br>  Alamat: Jl.Samprian, Ampana Kota 12345
                    </p>
                      
                    <?php
                    $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../masyarakat.php';
                    ?>
                      <td> <a href="<?=$url?>" type="button" class="btn btn-secondary">Kembali</a> </td>
                    </tr>
                   
               
                  </table>
                </div>
              </div>
            </div>
<br>

<!-- halaman detail.php -->

<script src="assets/js/bootstrap.js"></script>
</body>
</html>

```

## login.php

```php

<?php
session_start();
 
if (isset($_SESSION['login'])) {
  if ($_SESSION['role_id'] == '1') {
      header("Location: masyarakat.php");
  } elseif ($_SESSION['role_id'] == '2') {
      header("Location: tanggapan.php");
  } else {
      header("Location: admin.php");
  }
  exit;
}


require 'login/function.php';

//ketika tombol login di tekan

if (isset($_POST['login'])){
    $login = login($_POST);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/icon.png">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/bootstrap.css" rel="stylesheet">

</head>

<body class="bg-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                <img src="assets/images/LOGIN.jpg" width="470" height="500"/>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h2 text-gray-900 mb-4">Login</h1>
                  </div>
                  <?php if(isset($login['error'])): ?>
                    <div class="alert alert-danger alert-dismissible">
                    <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong><?= $login['pesan'] ?></strong> Silahkan Login Kembali!.
                    </div>
                    
                      
                    <?php endif; ?>
           
            
                  <br>  
                  <form action="" method="POST">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control" placeholder="Enter Email Address..." required>
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control" placeholder="Password" required>
                    </div>
                    <div class="text-center">
                      <a class="large" href="registrasi.php">Create an Account!</a>
                    </div>
                   <br>
                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block">Login</button>
                   
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

```
## logout.php
```php

<?php

session_start();
session_destroy();
header("Location: login.php");
exit;


?>

```

## masyarakat.php
```php

<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
} 

require 'masyarakat/function.php';

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
        <footer class="bg-dark text-white py-3">
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

```
## registrasi.php
```php

<?php

require 'registrasi/function.php';

if (isset($_POST['registrasi'])) {
  if (registrasi($_POST) > 0) {
    echo"<script>
					alert('user baru berhasil ditambahkan. silahkan login !');
					document.location.href = 'login.php';
					</script>";
  } else {
    echo "user gagal ditambahkan !";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registrasi</title>
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/icon.png">

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/bootstrap.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                <img src="assets/images/REGIS.jpg" width="470" height="670"/>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h2 text-gray-900 mb-4">Registrasi</h1>
                  </div>
                  <br>  
                  <form action="" method="POST">
                    <div class="form-group">
                        <label for="nik">Nik</label>
                        <input type="text" class="form-control" name="nik" id="nik" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="number" class="form-control" name="telepon" id="telepon" required>
                    </div>
                    <div class="form-group" hidden>
                        <label for="role_id">Role_Id</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option>Silahkan Pilih !</option>
                            <option value="1" selected>Masyarakat</option>
                            <option value="2">Petugas</option>
                            <option value="3">Admin</option>
                        </select>
                    </div>
              <br>
              <a href="login.php" class="text-primary">sudah memiliki akun silahkan <b>Login</b> !</a>
              <br><br>
              <button type="submit" name="registrasi" class="btn btn-primary btn-user btn-block">Registration</button>
            </form>
                  <hr>
                </div>
              </div>
            </div>
          
          </div>
          
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

```
## tanggapan.php
```php

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

$tanggapan = query("SELECT * FROM tanggapan");
//cek apakah tombol simpan sudah ditekan

if (isset($_POST['kirim'])) {
  if (tambah($_POST) > 0) {
    echo "<script>
      alert('data berhasil ditambahkan!');
      document.location.href = 'tanggapan.php';
    </script>";
  }else {
    echo "<script>
      alert('data gagal ditambahkan!');
      document.location.href = 'tanggapan.php';
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
    <a class="navbar-brand">
    <img src="assets/images/ico/adp.png" alt="icon" style="height: 40px; width: 40px;"><b>Petugas</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
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
                    <?php foreach ($petugas as $pt) :?>
            
                      <option value="<?= $pt['nik'];?>"><?= $pt['nama'];?></option>
                    
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
                <a href="tanggapan/ubah_masyarakat.php?id_pengaduan=<?=$p['id_pengaduan'];?>" 
                class="btn btn-success btn-sm" name="ubah">ubah</a>
                <a href="tanggapan/hapus_pengaduan.php?id_pengaduan=<?=$p['id_pengaduan'];?>" onclick="return confirm('apakah anda yakin?');"
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
                <a href="tanggapan/detail.php?id_tanggapan=<?=$t['id_tanggapan'];?>" 
                class="btn btn-primary btn-sm" name="detail">detail</a>
                <a href="tanggapan/ubah.php?id_tanggapan=<?=$t['id_tanggapan'];?>" 
                class="btn btn-success btn-sm" name="ubah">ubah</a>
                <a href="tanggapan/hapus.php?id_tanggapan=<?=$t['id_tanggapan'];?>" onclick="return confirm('apakah anda yakin?');"
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
        <footer class="bg-primary text-white py-3">
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

```
## tentang.php

```php

<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

?>


<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <title>Halaman Tentang</title>
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/icon.png">
</head>
<body>
  
  <!-- Header -->
  <header class="jumbotron jumbotron-fluid bg-primary text-white">
    <div class="container">
      <h1 class="display-4 text-center">Halaman Tentang Pengaduan Masyarakat</h1>
      <p class="lead text-center">Selamat datang di halaman tentang Kami.</p>
    </div>
  </header>	
 <!-- Konten Utama -->
     

            <!-- tampilan detail pengaduan -->
            <div class="container my-5">
              <h1 class="text-center mb-3">Tentang Kami</h1>
              <div class="card shadow">
                <div class="card-body">
                  <table class="table">
                    <h5 class="text-center">Pengaduan Masyarakat</h5>
                    <p class="text-center">
                    Website ini dibuat untuk mempermudah masyarakat dalam mengadukan masalah yang mereka hadapi. Tujuan kami adalah untuk menjembatani antara masyarakat dengan pihak yang berwajib dan membantu memecahkan masalah yang dihadapi masyarakat.
                    </p>
                    <p class="text-center">Dengan adanya website ini, diharapkan masyarakat dapat lebih mudah dan cepat dalam menyampaikan masalah yang mereka hadapi sehingga dapat segera ditindaklanjuti oleh pihak yang berwajib.</p>
                      
                    <?php
                    $url = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '../masyarakat.php';
                    ?>
                      <td> <a href="<?=$url?>" type="button" class="btn btn-secondary">Kembali</a> </td>
                    </tr>
                   
               
                  </table>
                </div>
              </div>
            </div>
<br>

<!-- halaman detail.php -->

<script src="assets/js/bootstrap.js"></script>
</body>
</html>

```
