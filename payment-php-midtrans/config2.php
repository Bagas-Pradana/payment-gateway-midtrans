<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "uji_laundry";

    $konek = mysqli_connect($server, $username, $password, $database);
    if($konek == TRUE){
        echo "Terhubung ke database";
    }
    else{
        echo "Tidak terhubung";
    }
?>