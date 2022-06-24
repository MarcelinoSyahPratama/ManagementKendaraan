<?php
require 'konfirmpesanan.php';

$id = $_GET["id"];

if(terima($id) > 0 ){
    echo "
    <script>
        alert('pesanan berhasil disetujui!');
        document.location.href = 'konfirmpesanan.php';
    </script>";
}
else{
    echo "
    <script>
        alert('pesanan gagal disetujui');
        document.location.href = 'konfirmpesanan.php';
    </script>";
}

?>