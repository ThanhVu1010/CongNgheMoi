<?php
include_once("ketnoi.php");

class ModelProfile
{
    function getUserById($idtaikhoan)
    {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT * FROM taikhoan WHERE Idtaikhoan = ?";
            if ($stmt = $connection->prepare($query)) {
                $stmt->bind_param("i", $idtaikhoan);
                $stmt->execute();
                $result = $stmt->get_result();
    
                if ($result->num_rows === 1) {
                    $userData = $result->fetch_assoc();
                    $stmt->close();
                    $db->dongKetNoi($connection);
                    return $userData;
                } else {
                    return false;
                }
            } else {
                echo "Lỗi prepare statement: " . $connection->error;
                return false;
            }
        } else {
            echo "Lỗi kết nối cơ sở dữ liệu.";
            return false;
        }
    }

    function updateUser($idtaikhoan, $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh)
    {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            // Kiểm tra xem người dùng có tải lên ảnh mới hay không
            if (!empty($hinhanh['name'])) {
                // Lưu file ảnh vào thư mục lưu trữ
                $hinhanh_name = $hinhanh['name'];
                $hinhanh_tmp = $hinhanh['tmp_name'];
                $hinhanh_path = 'assets/images_user/' . $hinhanh_name;
                move_uploaded_file($hinhanh_tmp, $hinhanh_path);
            } else {
                // Nếu không có ảnh mới, giữ nguyên tên ảnh trong cơ sở dữ liệu
                $query = "SELECT HinhAnh FROM taikhoan WHERE Idtaikhoan = ?";
                $stmt = $connection->prepare($query);
                $stmt->bind_param("i", $idtaikhoan);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $hinhanh_name = $row['HinhAnh'];
            }
            
            $query = "UPDATE taikhoan SET Tendangnhap=?, MatKhau=?, Hoten=?, SDT=?, Diachi=?, Gmail=?, HinhAnh=? WHERE Idtaikhoan=?";
            if ($stmt = $connection->prepare($query)) {
                $stmt->bind_param("sssssssi", $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh_name, $idtaikhoan);
                $stmt->execute();
    
                $success = ($stmt->affected_rows > 0);
    
                $stmt->close();
                $db->dongKetNoi($connection);
    
                return $success;
            } else {
                echo "Lỗi prepare statement: " . $connection->error;
                return false;
            }
        } else {
            echo "Lỗi kết nối cơ sở dữ liệu.";
            return false;
        }
    }
}