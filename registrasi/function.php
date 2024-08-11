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

		  // Periksa apakah panjang string input telepon lebih dari 12 karakter
		  if (strlen($telepon) > 12) {
			echo"<script>
					alert('Nomor telepon tidak valid. Harap masukkan nomor telepon dengan maksimal 12 angka.');
					document.location.href = 'registrasi.php';
				</script>";
			return false;
		}
		
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


