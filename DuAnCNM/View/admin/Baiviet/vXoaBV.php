<?php
include_once("Controller/cBaiviet.php");

$p = new controlBaiviet();



$idbaiviet = $_GET['Idbaiviet'];
$p-> DeleteBV($idbaiviet);

echo header("refresh:0; url='admin.php?mod=ListBV'");



?>

