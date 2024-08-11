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
                        <input type="number" class="form-control" name="telepon" id="telepon" required maxlength="12">
                    </div>
                    <!--<div class="form-group" hidden>
                        <label for="role_id">Role_Id</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option>Silahkan Pilih !</option>
                            <option value="1" selected>Masyarakat</option>
                            <option value="2">Petugas</option>
                            <option value="3">Admin</option>
                        </select>
                    </div>-->
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
