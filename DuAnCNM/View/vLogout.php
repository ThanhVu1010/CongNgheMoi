<?php

unset($_SESSION['login']);
unset($_SESSION['is_login']);


header("refresh: 0; url='index.php'");

?>
