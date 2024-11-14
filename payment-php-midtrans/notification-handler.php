<?php

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Midtrans\Config::$isProduction = false;
Midtrans\Config::$serverKey = $_ENV['MIDTRANS_SERVER_KEY'];

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$notif = new Midtrans\Notification();

$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;
$test = $notif->gross_amount;

$message = 'ok';

$printerName = "POS-58";

if ($transaction == 'capture') {
    // For credit card transaction, we need to check whether transaction is challenge by FDS or not
    if ($type == 'credit_card') {
        if ($fraud == 'challenge') {
            // TODO set payment status in merchant's database to 'Challenge by FDS'
            // TODO merchant should decide whether this transaction is authorized or not in MAP
            $message = "Transaction order_id: " . $order_id ." is challenged by FDS";
        } else {
            // TODO set payment status in merchant's database to 'Success'
            $message = "Transaction order_id: " . $order_id ." successfully captured using " . $type;
        }
    }
} elseif ($transaction == 'settlement') {
    // TODO set payment status in merchant's database to 'Settlement'
    $message = "Transaction order_id: " . $order_id ." successfully transfered using " . $type;

    try {
        // Membuat konektor ke printer
        $connector = new WindowsPrintConnector($printerName);
        $printer = new Printer($connector);
    
        // Mencetak header
        $printer->setEmphasis(true);
        $printer->text("===== STRUK PEMBELIAN =====\n");
        $printer->text("===== BIGKLIN LAUNDRY =====\n");
        $printer->text("\n");
        $printer->setEmphasis(false);
        //$printer->text("Order ID: " . $data['order_id'] . "\n");
        $printer->text("ID: " . $order_id . "\n");
        $printer->text("Payment status: " . $transaction . "\n");
        $printer->text("Biaya: " . $test . "\n");
        $printer->text("Pembayaran: " . $type . "\n");
        //$printer->text("Customer: " . $nama . "\n");
        
       // $printer->text("Tanggal : " . $data['transaction_status'] . "\n");
        $printer->text("---------------------------\n");
    
      
        // Potong kertas (cut)
        $printer->cut();
    
        // Tutup koneksi ke printer
        $printer->close();
        echo "Berhasil mencetak struk!\n";
    
    } catch (Exception $e) {
        echo "Gagal mencetak struk: " . $e->getMessage() . "\n";
    }
    
} elseif ($transaction == 'pending') {
    // TODO set payment status in merchant's database to 'Pending'
    $message = "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;

    try {
        // Membuat konektor ke printer
        $connector = new WindowsPrintConnector($printerName);
        $printer = new Printer($connector);
    
        // Mencetak header
        $printer->setEmphasis(true);
        $printer->text("===== STRUK PEMBELIAN =====\n");
        $printer->text("===== BIGKLIN LAUNDRY =====\n");
        $printer->text("\n");
        $printer->setEmphasis(false);
        //$printer->text("Order ID: " . $data['order_id'] . "\n");
        $printer->text("ID: " . $order_id . "\n");
        $printer->text("Payment status: " . $transaction . "\n");
        $printer->text("Biaya: " . $test . "\n");
        $printer->text("Pembayaran: " . $type . "\n");
        //$printer->text("Customer: " . $nama . "\n");
        
       // $printer->text("Tanggal : " . $data['transaction_status'] . "\n");
        $printer->text("---------------------------\n");
    
      
        // Potong kertas (cut)
        $printer->cut();
    
        // Tutup koneksi ke printer
        $printer->close();
        echo "Berhasil mencetak struk!\n";
    
    } catch (Exception $e) {
        echo "Gagal mencetak struk: " . $e->getMessage() . "\n";
    }

} elseif ($transaction == 'deny') {
    // TODO set payment status in merchant's database to 'Denied'
    $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
} elseif ($transaction == 'expire') {
    // TODO set payment status in merchant's database to 'expire'
    $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
} elseif ($transaction == 'cancel') {
    // TODO set payment status in merchant's database to 'Denied'
    $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
}

$filename = $order_id . ".txt";
$dirpath = 'log';
is_dir($dirpath) || mkdir($dirpath, 0777, true);

echo file_put_contents($dirpath . "/" . $filename, $message);