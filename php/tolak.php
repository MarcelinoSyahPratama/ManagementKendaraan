<?php
require 'konfirmpesanan.php';

$id = $_GET["id"];

if(tolak($id) > 0 ){
    echo "
    <script>
        alert('pesanan berhasil ditolak!');
        document.location.href = 'konfirmpesanan.php';
    </script>";
}
else{
    echo "
    <script>
        alert('pesanan gagal ditolak');
        document.location.href = 'konfirmpesanan.php';
    </script>";
}

?>