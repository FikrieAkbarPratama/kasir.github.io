<?php 
session_start();
unset($_SESSION['dataBarang']);
header("Location: index.php");
?>