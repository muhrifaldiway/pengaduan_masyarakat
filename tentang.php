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