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
$list = query("SELECT * FROM kendaraan ORDER BY id desc");
function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM kendaraan where id=$id");
  
    return mysqli_affected_rows($conn);
  }
  foreach ($list as $row){
      $tglnow = date("Y/m/d");
      $tglS = $row["jadwalService"];
      $status = $row["status"];
      $id=$row["id"];
      if(strtotime($tglnow) > strtotime($tglS) && $status != 'harusService'){
        global $conn;
        mysqli_query($conn, "UPDATE  kendaraan SET status='harusService' where id=$id");
        echo "
        <script>
            alert('Terdapat Kendaraan Yang Perlu Diservice');
            document.location.href = 'listKendaraan.php';
        </script>";
      }
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
    <script src="https://kit.fontawesome.com/65e8e6eaa7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin</title>
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
                <div class="card mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4 text-start my-3 mx-2 fw-normal">List Kendaraan</h4>
                            <a href="tambah_mobil.php"><button class="btn btn-primary btn-sm">Tambah Kendaraan</button></a>   
                        </div>           
                    </div>
            <input type="text" class="form-control" onkeyup="caridata()" placeholder="Cari Data Kendaraan" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="cari">
                    <table class="table table-striped" id="tabel">
                      <thead>
                        <tr>
                          <th scope="col">no</th>
                          <th scope="col">Nama Kendaraan</th>
                          <th scope="col">Plat NOmor</th>
                          <th scope="col">Konsumsi BBM</th>
                          <th scope="col">Service Terakhir</th>
                          <th scope="col">Jadwal Service</th>
                          <th scope="col">Status</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($list as $row) : ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row["namaKendaraan"]; ?></td>
                                <td><?php echo $row["plat"]; ?></td>
                                <td><?php echo $row["bbm"]; ?></td>
                                <td><?php echo $row["serviceterakhir"]; ?></td>
                                <td><?php echo $row["jadwalService"]; ?></td>
                                <td><?php echo $row["status"]; ?></td>
                                <td><a href="deleteKendaraan.php?id=<?php echo $row["id"] ?>"><button class="btn-danger"><i class="fa-solid fa-trash"></i></button></a><a href="edit_kendaraan.php?id=<?php echo $row["id"] ?>"><button class="btn-info"><i class="fa-solid fa-pencil"></i></button></a></td>
                            </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                        
                      </tbody>
                    </table>
                             
            </div>
        </div>
	</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
        </script>
        <script>
          function caridata() {
            var input, filter, table, tr, td, cell, i, j;
            filter = document.getElementById("cari").value.toLowerCase();
            table = document.getElementById("tabel");
            tr = table.getElementsByTagName("tr");
            for (i = 1; i < tr.length; i++) {
              tr[i].style.display = "none";
              const tdArray = tr[i].getElementsByTagName("td");
              for (var j = 0; j < tdArray.length; j++) {
                const cellValue = tdArray[j];
                if (cellValue && cellValue.innerHTML.toLowerCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
                  break;
                }
              }
            }
          }
</script>
</body>
</html>