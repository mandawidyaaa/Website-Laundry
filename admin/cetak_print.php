<!DOCTYPE html>
<html>

<head>
    <title>SISTEM INFORMASI BERKAH LAUNDRY</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <script type="text/javascript" src="../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.js"></script>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:../index.php?pesan=belum_login");
    }
    ?>

    <?php
    include '../koneksi.php';
    ?>
    <div class="container">
        <center>
            <h2>BERKAH LAUNDRY</h2>
        </center>
        <br />
        <br />
        <?php
        if (isset($_GET['dari']) && isset($_GET['sampai'])) {
            $dari = $_GET['dari'];
            $sampai = $_GET['sampai'];

            // Debugging
            echo "Dari Tanggal: " . $dari . " Sampai Tanggal: " . $sampai . "<br>";

            echo '<h4>Data Laporan Laundry dari <b>' . $dari . '</b> sampai <b>' . $sampai . '</b></h4>';
            echo '<table class="table table-bordered table-striped">
                <tr>
                    <th width="1%">No</th>
                    <th>Invoice</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Berat (Kg)</th>
                    <th>Tgl. Selesai</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>';

            $query = "SELECT * FROM pelanggan, transaksi 
                      WHERE transaksi_pelanggan = pelanggan_id 
                      AND date(transaksi_tgl) >= '$dari' 
                      AND date(transaksi_tgl) <= '$sampai' 
                      ORDER BY transaksi_id DESC";
            $data = mysqli_query($koneksi, $query);

            if (!$data) {
                die("Query error: " . mysqli_error($koneksi));
            }

            $no = 1;
            while ($d = mysqli_fetch_array($data)) {
                echo '<tr>
                        <td>' . $no++ . '</td>
                        <td>INVOICE-' . $d['transaksi_id'] . '</td>
                        <td>' . $d['transaksi_tgl'] . '</td>
                        <td>' . $d['pelanggan_nama'] . '</td>
                        <td>' . $d['transaksi_berat'] . '</td>
                        <td>' . $d['transaksi_tgl_selesai'] . '</td>
                        <td>Rp. ' . number_format($d['transaksi_harga']) . ' ,-</td>
                        <td>';

                if ($d['transaksi_status'] == "0") {
                    echo "<div class='label label-warning'>PROSES</div>";
                } else if ($d['transaksi_status'] == "1") {
                    echo "<div class='label label-info'>DICUCI</div>";
                } else if ($d['transaksi_status'] == "2") {
                    echo "<div class='label label-success'>SELESAI</div>";
                }

                echo '</td></tr>';
            }

            echo '</table>';
        }
        ?>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>