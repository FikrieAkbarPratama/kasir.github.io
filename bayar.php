<?php 
session_start();

require "functions.php";

if(!isset($_SESSION['jumlahBayar'])){
    $_SESSION['jumlahBayar'] = array();
}

if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['bayar'])){
    $bayar = floatval($_POST['nominalUang']);
    
    if($bayar > 0){
        $_SESSION['jumlahBayar'][] = array(
            "nominal" => $bayar
        );
    }
    
    if(bayar() >= totalHarga()){
        header("Location: detail.php");
        exit();
    } else {
        $_SESSION['alert'] = "failure_pay";
    }
}

$alert = isset($_SESSION['alert']) ? $_SESSION['alert'] : null;
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
</head>
<body>

    <div class="container w-50 mt-5">
        <div class="primary-header text-center fs-1 fw-bold mb-3">Bayar Sekarang</div>

        <?php require "alerts.php"; ?>

        <form action="" method="POST" class="mt-4">
            <div class="instructions-text mb-1">Masukkan Nominal Uang</div>
            <input type="number" class="form-control" name="nominalUang" required>
            <div class="information fw-bold mt-1">Total yang harus dibayar: Rp. <?= number_format(totalHarga(), 0, "", ".") ?></div>
            <button type="submit" class="btn btn-primary w-100 mt-2 mb-2" name="bayar"><i class="fa-solid fa-money-bill"></i> Bayar</button>
            <br>
            <a class="btn btn-secondary w-100" href="index.php" role="button"><i class="fa-solid fa-arrow-right fa-flip-horizontal"></i> Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
