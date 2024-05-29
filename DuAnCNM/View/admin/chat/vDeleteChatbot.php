<?php
include_once("Controller/cAdmin.php");
$p = new controlAdmin();

$idchatbot = $_GET['Idchatbot'];
$p->DeleteChatbot($idchatbot);

echo header("refresh:0; url='admin.php?mod=Viewchatbot'");

?>

