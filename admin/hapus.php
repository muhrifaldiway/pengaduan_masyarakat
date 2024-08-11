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