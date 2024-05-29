<?php
include_once ("Model/mNganhhoc.php");
class controlNganh
{
    function getAllNganh()
    {
        $p = new modelNganh();
        $tbl = $p->selectAllNganh();
        return $tbl;
    }
}
?>