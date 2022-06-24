<?php
session_start();
require 'koneksi.php';


if( isset($_POST["masuk"]) ) {

	$user = $_POST["user"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user' ");

	//cek username
	if( mysqli_num_rows($result) === 1 ) {
		//cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["pass"]) ) {
		// if( $password == $row["password"]) {
			// set session
			$_SESSION["login"] = true;
			$_SESSION["nama"] = $row["nama"];
			$_SESSION["id"] = $row["id"];
			$tglMasuk = date("Y/m/d");
            date_default_timezone_set("America/New_York");
            $date = date_create(date("h:i:sa"));
            date_add($date, date_interval_create_from_date_string('11 hours'));
            $jammasuk = date_format($date, 'H:i:s');
			$nama=$row["nama"];
			$level = $row["jabatan"];
			$id=$row['id'];
			mysqli_query($conn, "INSERT INTO aktifitaslogin VALUES('', '$nama', '$level','$tglMasuk','$jammasuk','','$id')");
			if($level == 'admin') {
			header("Location:dashboard.php");
			$_SESSION["admin"] = true;
			}else if($level == 'pengawas'){
			header("Location:dashboardP.php");
			$_SESSION["pengawas"] = true;
			}
		}
	}

$error = true;
}
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title></title>
    <link rel="stylesheet" href="../css/login.css">
    
    <!-- <meta http-equiv="refresh" content="1">  -->
    <script src="js/prefixfree.min.js"></script>

</head>

<body>

  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Management Kendaraan <br> PT.Nikel</div>
		</div>
		<br>
		<div class="login">
			<form action="" method="post">
				<input type="text" placeholder="username" name="user"><br>
				<input type="password" placeholder="password" name="password"><br>
				<button type="submit" name="masuk">Login</button>
			</form>
		</div>

  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

</body>

</html>