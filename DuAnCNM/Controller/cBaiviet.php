<?php
include_once ("Model/mBaiviet.php");
class controlBaiviet
{
    function getAllBaiviet()
    {
        $p = new modelBaiviet();
        $tbl = $p->selectAllBaiviet();
        return $tbl;
    }
    function getChitietBVbyID($idbv)
    {
        $p = new modelBaiviet();
        $tbl = $p->selectChitietBVbyID($idbv);
        return $tbl;
    }

    function getBaiviet(){
        $p = new modelBaiviet();
        $tbl = $p->selectBaiviet();
        return $tbl;
    }

    function getBaivietbyIDnganh($idnganh){
        $p = new modelBaiviet();
        $tbl = $p->selectBaivietbyIDnganh($idnganh);
        return $tbl;
    }
    function getBaivietbyTrangthai(){
        $p = new modelBaiviet();
        $tbl = $p-> selectBaivietbyTrangthai();
        return $tbl;
    }

    function InsertBV($Tieude, $Noidung, $Hinhanh, $Ngaydang, $Idtaikhoan, $Idnganhhoc, $tmpimg, $typeimg, $sizeimg)
{
    if ($Hinhanh != '') {
        $type_array = explode('/', $typeimg);
        $image_type = $type_array[0];

        if ($image_type == "image") {
            if ($sizeimg <= 10 * 1024 * 1024) {
                try {
                    if (!move_uploaded_file($tmpimg, "assets/baiviet/" . $Hinhanh)) {
                        throw new Exception('Failed to move uploaded file');
                    }
                } catch (Exception $e) {
                    return -1; // Lỗi khi di chuyển tệp tin
                }
            } else {
                return -2; // Kích thước tệp tin vượt quá giới hạn
            }
        } else {
            return -3; // Không phải loại hình ảnh
        }
    } else {
        $Hinhanh = 'default.jpg'; // or any default image name you prefer
    }

    // Kiểm tra dữ liệu đầu vào
    if (empty($Tieude) || empty($Noidung) || empty($Ngaydang) || empty($Idtaikhoan) || empty($Idnganhhoc)) {
        return -4; // Dữ liệu đầu vào không hợp lệ
    }

    $p = new modelBaiviet();

    $result = $p->InsertBV($Tieude, $Noidung, $Hinhanh, $Ngaydang, $Idtaikhoan, $Idnganhhoc);

    if ($result) {
        return 1; // Thêm bài viết thành công
    } else {
        return 0; // Thêm bài viết thất bại
    }
}

    function getshowchitiet($idbv){
        $p = new modelBaiviet();
        $tbl = $p->Showchitiet($idbv);
        return $tbl;
    }

    function  DuyetBaiViet($idbaiviet){
        $p = new modelBaiviet();
        $tbl = $p-> DuyetBaiViet($idbaiviet);
        return $tbl;
    }
   
    function DeleteBV($idbaiviet){
        $p = new modelBaiviet();
        $tbl = $p->DeletePost($idbaiviet);
        return $tbl;
    }
    
    function getBaivietInfo($Idbaiviet) {
        $p = new modelBaiviet();
        $baiviet = $p->selectBaivietInfo($Idbaiviet);
        return $baiviet;
    }
    function UpdateBV($Idbaiviet, $Tieude, $Noidung, $Hinhanh, $Ngaydang, $Idnganhhoc, $tmpimg, $typeimg, $sizeimg) {
        if ($Hinhanh != '') {
            $type_array = explode('/', $typeimg);
            $image_type = $type_array[0];

            if ($image_type == "image") {
                if ($sizeimg <= 10 * 1024 * 1024) { // 10MB max size
                    $target_path = "assets/baiviet/" . basename($Hinhanh);
                    try {
                        if (!move_uploaded_file($tmpimg, $target_path)) {
                            throw new Exception('Failed to move uploaded file');
                        }
                    } catch (Exception $e) {
                        return -1; // Lỗi di chuyển tập tin
                    }
                } else {
                    return -2; // kích thước file vượt quá giới hạn
                }
            } else {
                return -3; // loại tệp không hợp lệ
            }
        } else {
            $Hinhanh = 'default.jpg'; // Sử dụng hình ảnh mặc định nếu không được cung cấp
        }

        // Gọi phương thức UpdateBV từ modelBaiviet một lần duy nhất
        $p = new modelBaiviet();
        $result = $p->UpdateBV($Idbaiviet, $Tieude, $Noidung, $Hinhanh, $Ngaydang, $Idnganhhoc);

        if ($result) {
            return 1; // update thành công
        } else {
            return 0; // Update không thành công
        }
    }
    function NhapBinhluan($noidung, $Idtaikhoan, $idbv) {
        $p = new modelBaiViet();
        $tbl = $p->InsertBinhluan($noidung, $Idtaikhoan, $idbv);
        return $tbl;
    }
    function getBinhluan() {
        $p = new modelBaiViet();
        $tbl = $p->selectBinhluan();
        return $tbl; 
    }
}
?>