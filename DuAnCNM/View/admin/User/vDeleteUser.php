<?php
include_once("Controller/cAdmin.php");
$p = new controlAdmin();


$idtaikhoan = $_GET['Idtaikhoan'];
$p-> DeleteUser($idtaikhoan);

$mod = isset($_GET['po']) && $_GET['po'] == 'Ph/Hs' ? 'PH/HS' : 'Chuyenvien';
echo header("refresh:0; url='admin.php?mod=$mod'");



?>

