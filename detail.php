<?php 
session_start();

require "functions.php";

$alert = isset($_SESSION['alert']) ? $_SESSION['alert'] : null;
unset($_SESSION['alert']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckOut</title>
    <!-- fontAwesome -->
    <script src="https://kit.fontawesome.com/7dfe115e0d.js" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>
        function printOtherPage(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.addEventListener('load', function() {
                printWindow.print();
                printWindow.close();
            }, true);
        }
    </script>
</head>
<body>

    <div class="container w-50">
        <div class="text-center fw-bold fs-2 mt-5 mb-5">Bukti Pembayaran</div>
        <div class="no-transaksi"><strong>No. Transaksi </strong>#<?= noTransaksi() ?></div>
        <div class="tanggal"><strong>Bulan, tanggal</strong> <?= date("M d, Y") ?></div>
        <hr>
        <?php foreach($_SESSION['dataBarang'] as $row) : ?>
            <div class="d-flex justify-content-between">
                <div class="barang"><?= ucwords(htmlspecialchars($row['barang'])) ?></div>
                <div class="jumlahHarga">Rp. <?= number_format(total($row['harga'], $row['jumlah']), 0, "", ".") ?> x <?= htmlspecialchars($row['jumlah']) ?></div>
            </div>
            <hr>
        <?php endforeach; ?>
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Uang Yang Dibayar</div>
            <div class="fw-bold">Rp. <?= number_format(bayar(), 0, "", ".") ?></div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Total</div>
            <div class="fw-bold">Rp. <?= number_format(totalHarga(), 0, "", ".") ?></div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="fw-bold">Kembalian</div>
            <div class="fw-bold">Rp. <?= number_format(kembalian(), 0, "", ".") ?></div>
        </div>
    </div>
    

    <div class="text-center mt-5">Terima Kasih telah berbelanja di toko <strong>Budi</strong><br>
        <a href="index.php" class="link-offset-2 link-underline link-underline-opacity-0 me-3">Kembali</a> |
        <button type="button" class="btn text-primary" onclick="printOtherPage('struk.php')">Cetak Pembelian</button>
    </div>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
