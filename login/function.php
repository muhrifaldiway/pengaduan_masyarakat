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