<?php 
require 'koneksi.php';
session_start();
if( !isset($_SESSION["login"])){
	header("Location:login.php");
	exit;
	}
if( !isset($_SESSION["admin"])){
	header("Location:login.php");
	exit;
}

if(isset($_POST["tambah"]) ) {
    $username = $_POST["username"];
    $nama = $_POST["nama"];
    $pass = $_POST["pass"];
    $jabatan = $_POST["jabatan"];
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO user VALUES('', '$nama', '$username','$pass','$jabatan')");
    // return mysqli_affected_rows($conn);  
    echo "
    <script>
        alert('data berhasil di Tambah!');
        document.location.href = 'listUser.php';
    </script>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    
    <title>Admin</title>
</head>
<body>
<div class="main">
	<div class="nav" style="width: 100%;height: 40px;background-color: #000000d7;">
		<li style="color:white;font-family: 'Staatliches', cursive;font-size:30px;"><strong>WeDevCourse</strong></li>
	</div>
    <div class="container-fluid">
        <div class="row " id="row">
            <!-- Sidebar -->
			<div class="sticky-top h-100 vh-100 col-md-2 d-flex flex-column justify-content-between align-items-center pt-3 pb-3 bg-primary">
			<p style="font-size:20px">Selamat Datang admin</p>
				<img src="icon/admin.svg" alt="" style="width:100px;">
                <ul class="nav flex-column text-white">
					<li class="nav-item text-center">
						<a href="admin_materi.php" class="btn btn-primary mb-3">Dashboard</a>
					</li>
                    <li class="nav-item text-center">
						<a href="admin_user.php" class="btn btn-primary mb-3">Pesan Kendaraan</a>
                    </li>
                    <li class="nav-item text-center">
						<a href="admin_superuser.php" class="btn btn-primary mb-3">Status Pesanan</a>
                    </li>
                    <li class="nav-item text-center">
						<a href="admin_user_unpay.php" class="btn btn-primary mb-3">Laporan Pemesanan Kendaraan</a>
					</li>
					<li class="nav-item text-center">
						<a href="admin_bayar.php" class="btn btn-primary mb-3">Aktifitas Login</a>
					</li>
                    <li class="nav-item text-center">
						<a href="admin_reqmat.php" class="btn btn-primary mb-3">List & Tambah User</a>
                    </li>
                    <li class="nav-item text-center">
						<a href="admin_reqmat.php" class="btn btn-primary mb-3">List & Tambah Kendaraan</a>
                    </li>
                </ul>
                <div class="btn btn-dark">
                    <ul class="nav ">
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link text-white" href="#"><img src="icon/logout.svg" alt=""> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 mt-5">
                <div class="card mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4 text-start my-3 mx-2 fw-normal">Form Tambah User</h4>
                        </div>                        
                    </div>
                    <form action="" method="post">
                        <div class="kanan" style="float: right;width:46%;">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="username">
                              </div>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="pass">
                              </div>
                        </div>
                        <div class="kiri" style="float: left;width:50%;">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nama">
                              </div>
                              <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroup-sizing-default">Jabatan</span>
                                </div>
                                <select name="jabatan" id="" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                  <option value="Admin">admin</option>
                                  <option value="pengawas">pengawas</option>
                                </select>
                              </div>
                        </div>
                          <button type="submit" class="btn btn-primary btn-lg btn-block" name="tambah">Kirim</button>
                    </form>
                             
            </div>
        </div>
	</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
        </script>
</body>
</html>