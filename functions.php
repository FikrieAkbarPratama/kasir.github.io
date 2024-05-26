<?php 
session_start();

function total($harga, $jumlah){
    return $harga * $jumlah;
}

function totalHarga(){
    $sum = 0;
    if (!empty($_SESSION['dataBarang'])) {
        foreach ($_SESSION['dataBarang'] as $item) {
            $sum += $item['total'];
        }
    }
    return $sum;
}

function totalItem(){
    $sum = 0;
    if (!empty($_SESSION['dataBarang'])) {
        foreach ($_SESSION['dataBarang'] as $item) {
            $sum += $item['jumlah'];
        }
    }
    return $sum;
}

function checkNominal(){
    $selisih = totalHarga() - bayar();
    return number_format($selisih, 0, "", ".");
}

function bayar(){
    $sum = 0;
    if (!empty($_SESSION['jumlahBayar'])) {
        foreach ($_SESSION['jumlahBayar'] as $item) {
            $sum += floatval($item['nominal']);
        }
    }
    return $sum;
}

function noTransaksi() {
    return rand(10000000, 99999999);
}

function kembalian(){
    $kembalian = bayar() - totalHarga();
    return $kembalian;
}
