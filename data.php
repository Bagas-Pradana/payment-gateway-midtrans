

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Laundry</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.0/dist/bootstrap-table.min.css">
  </head>
  <body>
    <br>
    <br>
      <div class="container ">
        <h1>Data Pembayaran</h1>
    <table data-toggle="table"
     data-search="true"
     data-pagination="true">
      <thead>
        <tr>
          <th>NO</th>
          <th>Nama</th>
          <th>Item Price</th>
                <th>Status Transaksi</th>
                    <th>Hapus</th>
                    <th>Bayar</th>
        </tr>
      </thead>
      <tbody>
        

<?php  
    include "config2.php";
                error_reporting(0);
                $no=1;


                $query = mysqli_query($konek, "SELECT * FROM data ORDER BY id ASC ");
                while ($data = mysqli_fetch_array($query)) { // Ambil semua data dari hasil eksekusi $sql
                
                
                $status=$data['transaction_status'];

                echo "<tr>";
                echo "<td >".$no++."</td>";
                    echo "<td>".$data['nama']."</td>";
                    echo "<td>".$data['order_id']."</td>";

                    
                if($status >=3 )
                {
                echo  "<td><b> Pembayaran Sukses</b></span></td>";
                }
                elseif ($status>=2  ) {
                echo "<td><b> Pembayaran Pending</b></span></td>";
                }
                else
                {
                echo "<td><b> Pembayaran Belum Dilakukan</b></span></td>";
                }


                    echo "<td><a href='hapus.php?id=".$data['id']."' class='btn btn-danger'><i class='bi bi-trash-fill'></i> HAPUS </a></td>";
                    echo "<td><a href='http://localhost/directory6/ujian/payment-php-midtrans/vendor/midtrans/midtrans-php/examples/snap/checkout-process-simple-version.php?order_id=".$data['order_id']."' class='btn btn-primary'><i class='bi bi-credit-card'></i> PROCCED </a></td>";
                    }
?>
     
     
      </tbody>
    </table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.0/dist/bootstrap-table.min.js"></script>
  </body>
</html>