<?php
include_once ("Model/mAdmin.php");
class controlAdmin
{
    function getCus()
    {
        $p = new modelAdmin();
        $tbl = $p->selectCus();
        return $tbl;
    }

    function getStaff()
    {
        $p = new modelAdmin();
        $tbl = $p->selectStaff();
        return $tbl;
    }

    function getVaitro()
    {
        $p = new modelAdmin();
        $tbl = $p->SelectVaitro();
        return $tbl;
    }

    function getUserById($idtaikhoan)

    {
        $p = new modelAdmin();
        $tbl = $p->selectUserById($idtaikhoan);
        return $tbl;
    }

    function getUsersDifferentIdTaiKhoan($idTaiKhoan)

    {
        $p = new modelAdmin();
        $tbl = $p->selectUsersDifferentIdTaiKhoan($idTaiKhoan);
        return $tbl;
    }

    function getUserCount(){
        $p = new modelAdmin();
        $tbl = $p->SelectUserCount();
        return $tbl;
    } 
    
    function  UpdateUser($Idtaikhoan, $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh, $vaitro, $tmpimg = '', $typeimg = '', $sizeimg = '')
    {
        $upload_success = false;
        if ($typeimg != '') {
            $type_array = explode('/',   $typeimg);
            $image_type = $type_array[0];
            if ($image_type == "image" && $sizeimg <= 10 * 1024 * 1024) {
                if (move_uploaded_file($tmpimg, "Design/image/" . $hinhanh)) {
                    $upload_success = true;
                } else {
                    return -1;
                }
            } else {
                return -2;
            }
        }
        $p = new modelAdmin();
        $update =  $p->UpdateUser($Idtaikhoan, $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh, $vaitro);
        if ($update) {
            return 1;
        } else {
            return 0;
        }
    }

    function InsertUser($tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh, $vaitro)
    {
        $p = new modelAdmin();
        $tbl = $p->InsertUser($tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh, $vaitro);
        return $tbl;
    }

    function getUser()
    {
        $p = new modelAdmin();
        $tbl = $p->SelectUser();
        return $tbl;
    }
    
    
    function DeleteUser($idtaikhoan)
    {
        $p = new modelAdmin();
        $tbl = $p->DeleteUser($idtaikhoan);
        return $tbl;
    }
    function InsertChatbot($question, $answer)
    {
        $p = new modelAdmin();
        $tbl = $p->InsertChatbot($question, $answer);
        return $tbl;
    }

    function Viewchatbot()
    {
        $p = new modelAdmin();
        $tbl = $p->Viewchatbot();
        return $tbl;
    }

    function DeleteChatbot($idchatbot)
    {
        $p = new modelAdmin();
        $tbl = $p->DeleteChatbot($idchatbot);
        return $tbl;
    }

    function UpdateChatbot($idchatbot, $cauhoi, $cautraloi)
    {
        $p = new modelAdmin();
        $tbl = $p->UpdateChatbot($idchatbot, $cauhoi, $cautraloi);
        return $tbl;
    }
    function getChatbotById($idchatbot)
    {
        $p = new modelAdmin();
        $tbl = $p->selectChatbotById($idchatbot);
        return $tbl;
    }
    function getMajorCount()
    {
        $p = new modelAdmin();
        $tbl = $p->SelectMajorCount();
        return $tbl;
    }
    function getBVCount()
    {
        $p = new modelAdmin();
        $tbl = $p->SelectBVCount();
        return $tbl;
    }

    function  getBLCount()
    {
        $p = new modelAdmin();
        $tbl = $p->SelectBLCount();
        return $tbl;
    }
   
}
?>