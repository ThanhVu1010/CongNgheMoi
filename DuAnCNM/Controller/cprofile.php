<?php
include_once("Model/mProfile.php");

class ControlProfile
{
    function getUserById($idtaikhoan)
    {
        $model = new ModelProfile();
        return $model->getUserById($idtaikhoan);
    }

    function updateUser($idtaikhoan, $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh)
    {
        $model = new ModelProfile();
        return $model->updateUser($idtaikhoan, $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh);
    }
}
?>
