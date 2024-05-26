<?php 
session_start();

require "functions.php";

if(!isset($_SESSION['dataBarang'])){
    $_SESSION['dataBarang'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['tambah'])){
    $barang = htmlspecialchars($_POST['barang']);
    $harga = filter_input(INPUT_POST, 'harga', FILTER_VALIDATE_FLOAT);
    $jumlah = filter_input(INPUT_POST, 'jumlah', FILTER_VALIDATE_INT);

    if($barang && $harga > 0 && $jumlah > 0) {
        $_SESSION['dataBarang'][] = array(
            "barang" => $barang,
            "harga" => $harga,
            "jumlah" => $jumlah,
            "total" => total($harga, $jumlah)
        );

        $_SESSION['alert'] = 'success_add';
    } else {
        $_SESSION['alert'] = 'failure_add';
    }
}

unset($_SESSION['jumlahBayar']);
$alert = isset($_SESSION['alert']) ? $_SESSION['alert'] : null;
unset($_SESSION['alert']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASIR</title>
    <!-- fontAwesome -->
    <script src="https://kit.fontawesome.com/7dfe115e0d.js" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="primary-heading text-center mb-5 mt-5">Masukkan Data Barang</h1>
        
        <?php if ($alert == 'success_add'): ?>
            <div class="alert alert-success">Data barang berhasil ditambahkan.</div>
        <?php elseif ($alert == 'failure_add'): ?>
            <div class="alert alert-danger">Gagal menambahkan data. Pastikan semua input valid.</div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="input_data_wrapper mb-5">
                <div class="input_data mb-3">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="barang" placeholder="Barang" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="harga" placeholder="Harga" required>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="jumlah" placeholder="Jumlah" required>
                        </div>
                    </div>
                </div>
                <div class="action">
                    <button type="submit" class="btn btn-primary" name="tambah"><i class="fa-solid fa-cart-plus ps-2"></i>Tambah</button>
                    <a class="btn btn-danger" href="deleteAll.php" role="button" onclick="return confirm('Ingin menghapus semua data?')"> <i class="fa-solid fa-arrow-rotate-right ms-2"></i>Reset</a>
                    <a class="btn btn-success" href="bayar.php" role="button"><i class="fa-solid fa-cart-shopping ps-2"></i>Bayar</a>
                </div>
            </div>
    
            <hr>
    
            <div class="data_wrapper">
                <div class="little-title">List Barang</div>

                <table class="table table-striped-columns text-center">
                    <thead class="table-success">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <?php $i = 1; ?>
                    <?php if(!empty($_SESSION["dataBarang"])) : ?>
                    <?php foreach($_SESSION['dataBarang'] as $key => $row) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= htmlspecialchars(ucwords($row['barang'])) ?></td>
                            <td>Rp. <?= number_format($row['harga'], 0, "", ".") ?></td>
                            <td><?= htmlspecialchars($row['jumlah']) ?></td>
                            <td>Rp. <?= number_format(total($row['harga'], $row['jumlah']), 0, "", ".") ?></td>
                            <td>
                                <a class="btn btn-danger w-50" title="hapus satu baris data" href="deleteRow.php?id=<?= $key ?>" role="button"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>  
                    <tr>
                        <td colspan="5">Total Barang</td>
                        <td><?= totalItem(); ?></td>
                    </tr>
                    <tr>
                        <td colspan="5">Total Harga</td>
                        <td>Rp. <?= number_format(totalHarga(), 0, "", "."); ?></td>
                    </tr>
                    <?php else : ?>
                        <tr>
                            <td colspan="6"><center>Tidak ada data</center></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap
