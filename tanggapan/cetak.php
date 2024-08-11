<?php

require 'function.php';

$id = $_GET['id_pemesanan'];

$pemesanan = query("SELECT pemesanan.tgl_cekin, pemesanan.tgl_cekout, pemesanan.jumlah_kamar, pemesanan.nama, pemesanan.email, kamar.harga, pemesanan.status 
FROM pemesanan JOIN kamar ON pemesanan.kamar_id = kamar.id_kamar WHERE id_pemesanan = $id;");


header('Content-Type: application/pdf');
readfile('dokumen.pdf');

;?>