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