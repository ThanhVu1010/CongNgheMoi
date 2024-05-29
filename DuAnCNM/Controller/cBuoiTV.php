<?php
include_once ("Model/mBuoiTV.php");
class controlBuoiTV
{
    function getAllBuoiTV()
    {
        $p = new modelBuoiTV();
        $tbl = $p->selectAllBuoiTV();
        return $tbl;
    }

    function getBuoiTVByNganhHoc($Idnganhhoc){
        $p = new modelBuoiTV();
        $tbl = $p->selectBuoiTVByNganhHoc($Idnganhhoc);
        return $tbl;
        
    }
    function getShowchitietBTV($idbtv){
        $p = new modelBuoiTV();
        $tbl = $p->selectShowchitiet($idbtv);
        return $tbl;
        
    }

    function getCauhoi(){
        $p = new modelBuoiTV();
        $tbl = $p->selectCauhoi();
        return $tbl;
        
    }

    function Insertcauhoi($noidungcauhoi, $Idtaikhoan, $idbtv){
        $p = new modelBuoiTV();
        $tbl = $p->Insertcauhoi($noidungcauhoi, $Idtaikhoan, $idbtv);
        return $tbl;
    }
}
?>