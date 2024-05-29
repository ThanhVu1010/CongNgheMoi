<?php
include_once("ketnoi.php");
class modelBaiviet{
    function selectAllBaiviet()
    {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "SELECT * FROM baiviet INNER JOIN nganhhoc ON baiviet.Idnganhhoc = nganhhoc.Idnganhhoc";
            $result = $connection->query($query);

            if ($result) {
                $db->dongKetNoi($connection);
                return $result;
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
            }
        } else {
            return false;
        }
    }
    function selectChitietBVbyID($idbv){
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "SELECT * FROM baiviet INNER JOIN nganhhoc ON baiviet.Idnganhhoc = nganhhoc.Idnganhhoc WHERE Idbaiviet = '$idbv' ";
            $result = $connection->query($query);
            if ($result) {
                $db->dongKetNoi($connection);
                return $result;
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
            }
        } else {
            return false;
        }
    }

    function selectBaiviet(){
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "SELECT * FROM baiviet INNER JOIN nganhhoc ON baiviet.Idnganhhoc = nganhhoc.Idnganhhoc
            INNER JOIN taikhoan ON baiviet.Idtaikhoan = taikhoan.Idtaikhoan WHERE Trangthai = 1";
            $result = $connection->query($query);   
            if ($result) {
                $db->dongKetNoi($connection);
                return $result;
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
            }
        } else {
            return false;
        }
    }


    function Showchitiet($idbv)
    {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
        
        if ($connection) {
            $query = "SELECT * FROM baiviet INNER JOIN nganhhoc ON baiviet.Idnganhhoc = nganhhoc.Idnganhhoc
                INNER JOIN taikhoan ON baiviet.Idtaikhoan = taikhoan.Idtaikhoan
                WHERE Idbaiviet = '$idbv' ";
            $result = $connection->query($query);
        
            if ($result) {
                $data = array(); // Tạo một mảng để lưu trữ dữ liệu
        
                while ($row = $result->fetch_assoc()) {
                    // Lưu thông tin bài viết
                    $data['baiviet']['Idbaiviet'] = $row['Idbaiviet'];
                    $data['baiviet']['Tieude'] = $row['Tieude'];
                    $data['baiviet']['Noidung'] = $row['Noidung'];
                    $data['baiviet']['Hinhanh'] = $row['Hinhanh'];
                    $data['baiviet']['Ngaydang'] = $row['Ngaydang'];
        
                    // Lưu thông tin ngành học từ bảng nganhhoc
                    $data['nganhhoc'][] = array(
                        'Idnganhhoc' => $row['Idnganhhoc'],
                        'Tennganhhoc' => $row['Tennganhhoc'],
                        'Hinhanh' => $row['Hinhanh'],
                    );
                    $data['taikhoan'][] = array(
                        'Idtaikhoan' => $row['Idtaikhoan'],
                        'Hoten' => $row['Hoten'],
                        'Gmail' => $row['Gmail'],
                        'Diachi' => $row['Diachi'],
                    );

                }
        
                $db->dongKetNoi($connection);
                return $data;
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
            }
        } else {
            return false;
        
        }
    }  

    function selectBaivietbyIDnganh($idnganh){
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "SELECT * FROM baiviet INNER JOIN nganhhoc ON baiviet.Idnganhhoc = nganhhoc.Idnganhhoc
                       WHERE nganhhoc.Idnganhhoc = '$idnganh' AND  Trangthai = 1";
            $result = $connection->query($query);   
            if ($result) {
                $db->dongKetNoi($connection);
                return $result;
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
            }
        } else {
            return false;
        }
    }
    
    function selectBaivietbyTrangthai(){
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "SELECT * FROM baiviet INNER JOIN nganhhoc ON baiviet.Idnganhhoc = nganhhoc.Idnganhhoc
            INNER JOIN taikhoan ON baiviet.Idtaikhoan = taikhoan.Idtaikhoan WHERE Trangthai = 0";
            $result = $connection->query($query);   
            if ($result) {
                $db->dongKetNoi($connection);
                return $result;
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
            }
        } else {
            return false;
        }
    }

    function selectBV($idnganh) {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT * FROM baiviet INNER JOIN nganhhoc ON baiviet.Idnganhhoc = nganhhoc.Idnganhhoc
            WHERE nganhhoc.Idnganhhoc = '$idnganh' AND  Trangthai = 1";
            $result = $connection->query($query);
            
            if ($result) {
                $list_user = array();
                while ($row = $result->fetch_assoc()) {
                    $list_user[] = $row;
                }
                $db->dongKetNoi($connection);
                return $list_user;
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
            }
        } else {
            // Handle connection error
            echo "Lỗi kết nối đến cơ sở dữ liệu.";
            return false;
        }
    }
    function DuyetBaiViet($idbaiviet)
{
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();
    if ($connection === false) {
        echo "Lỗi kết nối đến cơ sở dữ liệu.";
        return false;
    }

    $success = true;

    foreach ($idbaiviet as $id) {
        // Giả sử $id là ID của bài viết cần được duyệt

        // Sử dụng prepared statements để tránh SQL Injection
        $stmt = $connection->prepare("UPDATE baiviet SET Trangthai = 1 WHERE Idbaiviet = ?");
        $stmt->bind_param("i", $id); // 'i' cho biết kiểu dữ liệu là integer

        if (!$stmt->execute()) {
            echo "Lỗi khi cập nhật trạng thái: " . $stmt->error;
            $success = false;
            break; // Dừng việc cập nhật nếu có lỗi xảy ra
        }

        $stmt->close();
    }

    if ($success) {
        echo "Cập nhật trạng thái duyệt thành công cho tất cả các bài viết đã chọn.";
    }

    $db->dongKetNoi($connection);
    return $success;
}

function DeletePost($idbaiviet)
{
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if (!$connection) {
        return false;
    }
    
    $query = "DELETE FROM baiviet WHERE Idbaiviet = ?";
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        $connection->close();
        return false;
    }

    $stmt->bind_param("i", $idbaiviet);
    $result = $stmt->execute();
    
    $stmt->close();
    $db->dongKetNoi($connection);
    
    return $result;
}

function InsertBV($Tieude, $Noidung, $Hinhanh, $Ngaydang, $Idtaikhoan, $Idnganhhoc)
{
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if (!$connection) {
        return false;
    }

    $query = "INSERT INTO `baiviet`(`Idbaiviet`, `Tieude`, `Noidung`, `Hinhanh`, `Ngaydang`, `Idtaikhoan`, `Idnganhhoc`, `Trangthai`) VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        $connection->close();
        return false;
    }

    $Idbaiviet = $_SESSION['is_login']['Idtaikhoan'] . rand(0, 1000000); // Generate unique Idbaiviet
    $stmt->bind_param("sssssss", $Idbaiviet, $Tieude, $Noidung, $Hinhanh, $Ngaydang, $Idtaikhoan, $Idnganhhoc);
    
    $result = $stmt->execute();

    $stmt->close();
    $db->dongKetNoi($connection);

    return $result;
}          
   function selectBaivietInfo($Idbaiviet) {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT * FROM baiviet WHERE Idbaiviet = '$Idbaiviet'";
            $result = $connection->query($query);   
            if ($result && $result->num_rows > 0) {
                $baivietInfo = $result->fetch_assoc(); 
                $result->free(); 
                $db->dongKetNoi($connection);
                return $baivietInfo;
            } else {
                echo "Không tìm thấy bài viết hoặc lỗi truy vấn: " . $connection->error;
            }
        } else {
            return false;
        }
    }

function UpdateBV($Idbaiviet, $Tieude, $Noidung, $Hinhanh, $Ngaydang, $Idnganhhoc)
{
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if (!$connection) {
        echo "Lỗi kết nối đến cơ sở dữ liệu.";
        return false;
    }

    $query = "UPDATE baiviet SET Tieude = ?, Noidung = ?, Hinhanh = ?, Ngaydang = ?, Idnganhhoc = ? WHERE Idbaiviet = ?";
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        echo "Lỗi trong việc chuẩn bị truy vấn: " . $connection->error;
        $connection->close();
        return false;
    }

    $stmt->bind_param("sssssi", $Tieude, $Noidung, $Hinhanh, $Ngaydang, $Idnganhhoc, $Idbaiviet);
    
    $result = $stmt->execute();

    if ($result) {
        echo "Cập nhật bài viết thành công.";
    } else {
        echo "Lỗi khi cập nhật bài viết: " . $stmt->error;
    }

    $stmt->close();
    $db->dongKetNoi($connection);
    
    return $result;
}

function InsertBinhluan($noidung, $Idtaikhoan, $idbv) {
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if ($connection) {
        $thoigian = date('Y-m-d'); 
        
        $query = $connection->prepare("INSERT INTO binhluan (NoidungBL, Thoigian, Idtaikhoan, Idbaiviet) VALUES (?, ?, ?, ?)");
        if (!$query) {
            die("Prepare failed: (" . $connection->errno . ") " . $connection->error);
        }

        
        $query->bind_param("ssii", $noidung, $thoigian, $Idtaikhoan, $idbv);

        if ($query->execute()) {
            $db->dongKetNoi($connection);
            return true;
        } else {
            echo "Lỗi truy vấn: " . $query->error;
            $db->dongKetNoi($connection);
            return false;
        }
    } else {
        return false;
    }
}
function selectBinhluan(){
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if ($connection) {
        $query = "SELECT * FROM  binhluan  INNER JOIN  taikhoan ON binhluan.Idtaikhoan = taikhoan.Idtaikhoan INNER JOIN  baiviet ON binhluan.Idbaiviet = baiviet.Idbaiviet
    ORDER BY 
        binhluan.Idbinhluan;
                    ";
        $result = $connection->query($query);

        if ($result) {
            $db->dongKetNoi($connection);
            return $result;
        } else {
            // Handle query error
            echo "Lỗi truy vấn: " . $connection->error;
        }
    } else {
        return false;
    }
}   
}
?>


