<?php
require 'pengembalian.php';

$id = $_GET["id"];

if(kembali($id) > 0 ){
    echo "
    <script>
        alert('Kendaraan berhasil di kembalikan!');
        document.location.href = 'pengembalian.php';
    </script>";
}
else{
    echo "
    <script>
        alert('data gagal di kembalikan!');
        document.location.href = 'pengembalian.php';
    </script>";
}

?>