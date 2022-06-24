<?php 
require 'koneksi.php';
session_start();
date_default_timezone_set("America/New_York");
$date = date_create(date("h:i:sa"));
date_add($date, date_interval_create_from_date_string('11 hours'));
$jamkeluar = date_format($date, 'H:i:s');
$id=$_SESSION["id"];
mysqli_query($conn, "UPDATE  aktifitaslogin SET waktuKeluar='$jamkeluar' where id_user=$id");
session_destroy();
header("Location:login.php");
 ?>