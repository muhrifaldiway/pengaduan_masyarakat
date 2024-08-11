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
