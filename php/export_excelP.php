<?php 
session_start();
if( !isset($_SESSION["login"])){
	header("Location:login.php");
	exit;
	}
if( !isset($_SESSION["pengawas"])){
	header("Location:login.php");
	exit;
}
require 'koneksi.php';
$range = $_GET["range"];
$pengawas = $_SESSION["nama"];
if($range == "bulanan"){
    $datenow = date_create(date("Y-m-d"));
    $bulannow = date_format($datenow, 'Y-m');

    $GLOBALS["lis"] = query("SELECT * FROM pemesanan WHERE namaAtasan = '$pengawas' AND tanggal BETWEEN '$bulannow-01' AND '$bulannow-31' ORDER BY id desc");
}else if($range == "tahunan"){
    $datenow = date_create(date("Y-m-d"));
    $tahunnow = date_format($datenow, 'Y');
    $GLOBALS["lis"] = query("SELECT * FROM pemesanan WHERE namaAtasan = '$pengawas' AND tanggal BETWEEN '$tahunnow-01-01' AND '$tahunnow-12-31' ORDER BY id desc");
}
$list = $GLOBALS["lis"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Pemesanan Kendaraan $range.xls");
	?>
<table class="table table-striped" id="tabel">
                      <thead>
                        <tr>
                          <th scope="col">no</th>
                          <th scope="col">Nama Pemesan</th>
                          <th scope="col">Nama Driver</th>
                          <th scope="col">Nama Pengawas</th>
                          <th scope="col">Nama Kendaraan</th>
                          <th scope="col">Plat Kendaraan</th>
                          <th scope="col">Tanggal Dipakai</th>
                          <th scope="col">Tanggal Dikembalikan</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($list as $row) : ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $row["namaPemesan"]; ?></td>
                                <td><?php echo $row["namaDriver"]; ?></td>
                                <td><?php echo $row["namaAtasan"]; ?></td>
                                <td><?php echo $row["namaKendaraan"]; ?></td>
                                <td><?php echo $row["platKendaraan"]; ?></td>
                                <td><?php echo $row["tanggal"]; ?></td>
                                <td><?php echo $row["tglkembali"]; ?></td>
                                <td><?php echo $row["status"]; ?></td>
                            </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                        
                      </tbody>
                    </table>
</body>
</html>