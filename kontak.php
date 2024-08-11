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
  <header class="jumbotron jumbotron-fluid bg-primary text-white">
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