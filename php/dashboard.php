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
$jumlahpesan = query("SELECT COUNT(*) as jumlah FROM pemesanan");
$jumlahmenunggu = query("SELECT COUNT(*) as jumlah FROM pemesanan WHERE status='menunggu'");
$jumlahdisetujui = query("SELECT COUNT(*) as jumlah FROM pemesanan WHERE status='setuju'");
$jumlahditolak = query("SELECT COUNT(*) as jumlah FROM pemesanan WHERE status='ditolak'");
$jumlahdikembalikan = query("SELECT COUNT(*) as jumlah FROM pemesanan WHERE status='dikembalikan'");
$result = mysqli_query($conn, "SELECT status, COUNT(*) as jumlah FROM pemesanan GROUP BY status");
$resultK = mysqli_query($conn, "SELECT namaKendaraan, COUNT(*) as jumlah FROM pemesanan GROUP BY namaKendaraan");



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="refresh" content="1" >  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           
</head>
<body>
<div class="main">
<div class="nav" style="width: 100%;height: 40px;background-color: #000000d7;">
		<li style="color:white;font-family: 'Staatliches', cursive;font-size:30px;"><strong>PT.Nikel Indonesia</strong></li>
	</div>
    <div class="container-fluid">
        <div class="row " id="row">
            <!-- Sidebar -->
			<div class="sticky-top h-100 vh-100 col-md-2 d-flex flex-column justify-content-between align-items-center pt-3 pb-3 bg-primary">
			<p style="font-size:20px"><center>Selamat Datang admin</center></p>
				<img src="../asset/admin.svg" alt="" style="width:100px;">
                <ul class="nav flex-column text-white">
					<li class="nav-item text-center">
						<a href="dashboard.php" class="btn btn-primary mb-3">Dashboard</a>
					</li>
                    <li class="nav-item text-center">
						<a href="pemesanan.php" class="btn btn-primary mb-3">Pesan Kendaraan</a>
                    </li>
                    <li class="nav-item text-center">
						<a href="statuspesanan.php" class="btn btn-primary mb-3">Status Pesanan</a>
                    </li>
                    <li class="nav-item text-center">
						<a href="pengembalian.php" class="btn btn-primary mb-3">Pengembalian Kendaraan</a>
					</li>
					<li class="nav-item text-center">
						<a href="aktifitaslogin.php" class="btn btn-primary mb-3">Aktifitas Login</a>
					</li>
                    <li class="nav-item text-center">
						<a href="listUser.php" class="btn btn-primary mb-3">List & Tambah User</a>
                    </li>
                    <li class="nav-item text-center">
						<a href="listKendaraan.php" class="btn btn-primary mb-3">List & Tambah Kendaraan</a>
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
              <div class="atas" style="display:inline-flex;width:100%;">
                <div class="pesanan" style="width:20%;background-color:red;"><center><h4>Pesanan Terkirim <br> <?php foreach ($jumlahpesan as $row){echo $row["jumlah"];} ?> </h4></center></div>
                <div class="menunggu" style="width:20%;background-color:blue;"><center><h4>Pesanan Menunggu<br><?php foreach ($jumlahmenunggu as $row){echo $row["jumlah"];} ?></h4></center></div>
                <div class="disetujui" style="width:20%;background-color:red;"><center><h4>Pesanan Disetujui<br><?php foreach ($jumlahdisetujui as $row){echo $row["jumlah"];} ?></h4></center></div>
                <div class="ditolak" style="width:20%;background-color:orange;"><center><h4>Pesanan Ditolak<br><?php foreach ($jumlahditolak as $row){echo $row["jumlah"];} ?></h4></center></div>
                <div class="dikembalikan" style="width:20%;background-color:green;"><center><h4>Sudah kembalikan<br><?php foreach ($jumlahdikembalikan as $row){echo $row["jumlah"];} ?></h4></center></div>
              </div>
              <div class="bawah" style="display:inline-flex;width:100%;">
                <div class="kanan" style="width:50%;">
                  <div id="piechartpesanan" style="width: 100%;height:600px"></div>  
                </div>  
                <div class="kiri" style="width:50%;">
                  <div id="piechartkendaraan" style="width: 100%;height:600px"></div>  
                </div> 
              </div>
              
        </div>
	</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
        </script>
        <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChartpesan);  
           google.charts.setOnLoadCallback(drawChartkendaraan);  
           function drawChartpesan()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Status', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["status"]."', ".$row["jumlah"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Grafik Data Pesanan',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechartpesanan'));  
                chart.draw(data, options);  
           }  
           function drawChartkendaraan()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['namaKendaraan', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($resultK))  
                          {  
                               echo "['".$row["namaKendaraan"]."', ".$row["jumlah"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Grafik Pemakaian Kendaraan',  
                      //is3D:true,  
                      pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechartkendaraan'));  
                chart.draw(data, options);  
           }  
           </script>  
</body>
</html>