<?php include 'header.php'; ?>
<?php
include '../koneksi.php';
?>
<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Transaksi Laundry Baru</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-8 col-md-offset-2">
                <a href="transaksi.php" class="btn btn-sm btn-info pull-right">Kembali</a>
                <br />
                <br />
                <form method="post" action="transaksi_aksi.php">
                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select class="form-control" name="pelanggan" required="required">
                            <option value="">- Pilih Pelanggan -</option>
                            <?php
                            $data = mysqli_query($koneksi, "select * from pelanggan");
                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                                <option value="<?php echo $d['pelanggan_id']; ?>"><?php echo $d['pelanggan_nama']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Berat</label>
                        <input type="number" class="form-control" name="berat" placeholder="Masukkan berat cucian .." required="required">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai</label>
                        <input type="date" class="form-control" name="tgl_selesai" required="required">
                    </div>
                    <br />
                    <table class="table table-bordered table-striped" id="pakaianTable">
                        <tr>
                            <th>Jenis Pakaian</th>
                            <th width="20%">Jumlah</th>
                            <th width="10%">Aksi</th>
                        </tr>
                        <tr>
                            <td>
                                <select class="form-control" name="jenis_pakaian[]">
                                    <option value="">- Pilih Jenis Pakaian -</option>
                                    <option value="Kaos">Kaos</option>
                                    <option value="Celana">Celana</option>
                                    <option value="Jaket">Jaket</option>
                                    <option value="Kemeja">Kemeja</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </td>
                            <td><input type="number" class="form-control" name="jumlah_pakaian[]"></td>
                            <td><button type="button" class="btn btn-danger btn-remove-row">Hapus</button></td>
                        </tr>
                    </table>
                    <button type="button" class="btn btn-success" id="addRow">Tambah Jenis Pakaian</button>
                    <br /><br />
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>

<script>
    document.getElementById('addRow').addEventListener('click', function() {
        var table = document.getElementById('pakaianTable');
        var newRow = table.insertRow();

        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);

        cell1.innerHTML = `<select class="form-control" name="jenis_pakaian[]">
                                <option value="">- Pilih Jenis Pakaian -</option>
                                <option value="Kaos">Kaos</option>
                                <option value="Celana">Celana</option>
                                <option value="Jaket">Jaket</option>
                                <option value="Kemeja">Kemeja</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>`;
        cell2.innerHTML = `<input type="number" class="form-control" name="jumlah_pakaian[]">`;
        cell3.innerHTML = `<button type="button" class="btn btn-danger btn-remove-row">Hapus</button>`;

        // Tambahkan event listener untuk tombol hapus
        var removeButtons = document.querySelectorAll('.btn-remove-row');
        removeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
            });
        });
    });

    // Tambahkan event listener untuk tombol hapus yang pertama
    document.querySelector('.btn-remove-row').addEventListener('click', function() {
        this.closest('tr').remove();
    });
</script>