<?php
    require 'config2.php';

    
    //ini_set('date.timezone', 'Asia/Jakarta');
    date_default_timezone_set('Asia/Jakarta');
    //$jam = date('H:i:s');
    //$tanggal = date('d-m-y');

    $now = new DateTime();

    $time = $now->format("Y-m-d H:i:s");

   // $relay = $conn->query("SELECT * FROM data");

    // DATA PENGIRIMAN MENGGUNGAKAN GET
    $nama = $_POST['nama'];
    $berat = $_POST['berat'];
    $biaya = $_POST['biaya'];
    //$ptatus = $_GET['ptatus'];
    //$biaya = 10000;
   

    if($berat < 9999){
        $order_id = rand(); //fungsi rand membuat angka secara acak
        $transaction_status = 1;
        //$ptatus = "Data Has been send to database";
        //echo $data_sensor;
        echo $nama; 
    }

    $input = mysqli_query($konek, "INSERT INTO data (nama, berat, biaya, order_id, transaction_status, time) VALUES ('$nama','$berat','$biaya','$order_id','$transaction_status','$time')");
    if ($input == TRUE){
        echo "Berhasil Input data";
    }else{
        echo "gagal input data";
    //header("Location: ./midtrans/examples/snap/checkout-process-simple-version.php?order_id=$order_id");
    }