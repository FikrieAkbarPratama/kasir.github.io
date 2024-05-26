<?php 
session_start();

$id = $_GET['id'];
unset($_SESSION['dataBarang'][$id]);
header("Location: index.php");
?>