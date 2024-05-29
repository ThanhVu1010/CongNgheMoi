<?php
include_once("ketnoi.php");

class modelAdmin
{
    function selectCus() {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT * FROM taikhoan INNER JOIN vaitro ON taikhoan.vaitro = vaitro.idvaitro WHERE vaitro.idvaitro = 3";
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
    

    function selectStaff(){
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT * FROM taikhoan INNER JOIN vaitro ON taikhoan.vaitro = vaitro.idvaitro WHERE vaitro.idvaitro != 3";
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


    function SelectVaitro()
    {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT * FROM vaitro ORDER BY Idvaitro DESC";
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

    function SelectUser()
    {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT * FROM taikhoan";
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

    function selectUserById($idtaikhoan){
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT * FROM `taikhoan` WHERE Idtaikhoan = $idtaikhoan ";
            $result = $connection->query($query);   
            if ($result) {
                // Chuyển đổi kết quả thành một mảng
                $userData = $result->fetch_assoc();
                $db->dongKetNoi($connection);
                return $userData; // Trả về mảng thay vì đối tượng mysqli_result
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
            }
        } else {
            return false;
        }
    }
    
    
   
    
    function selectUsersDifferentIdTaiKhoan($idTaiKhoan) {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        // Check if $idTaiKhoan has a value
        if ($idTaiKhoan === null) {
            echo "Invalid user ID";
            return false; // Or any other error handling mechanism you prefer
        }
    
        if ($connection) {
            $query = "SELECT * FROM `taikhoan` WHERE Idtaikhoan != ?";
            if ($stmt = $connection->prepare($query)) {
                $stmt->bind_param("i", $idTaiKhoan);
                $stmt->execute();
                $result = $stmt->get_result();
    
                $list_users = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $list_users[] = $row;
                    }
                } else {
                    echo "No matching users found"; // You can choose to return false or an empty array here
                }
    
                $stmt->close();
                $db->dongKetNoi($connection);
                return $list_users;
            } else {
                // Handle prepared statement error
                echo "Lỗi truy vấn: " . $connection->error;
                return false;
            }
        } else {
            // Handle connection error
            echo "Lỗi kết nối đến cơ sở dữ liệu.";
            return false;
        }
    }
    
    function InsertUser($tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh, $vaitro) {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            // Sử dụng prepared statement để tránh SQL Injection
            $query = "INSERT INTO taikhoan(`Tendangnhap`, `MatKhau`, `Hoten`, `SDT`, `Diachi`, `Gmail`, `HinhAnh`, `Vaitro`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("ssssssss", $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh, $vaitro);
            
            if ($stmt->execute()) {
                $stmt->close();
                $db->dongKetNoi($connection);
                return true; // Trả về true để chỉ ra rằng người dùng đã được thêm thành công
            } else {
                // Xử lý lỗi truy vấn
                echo "Lỗi truy vấn: " . $connection->error;
                $stmt->close();
                $db->dongKetNoi($connection);
                return false;
            }
        } else {
            // Xử lý lỗi kết nối
            echo "Lỗi kết nối đến cơ sở dữ liệu.";
            return false;
        }
    }
    
    
    function UpdateUser($Idtaikhoan, $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh, $vaitro) {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "UPDATE taikhoan SET Tendangnhap=?, MatKhau=?, Hoten=?, SDT=?, Diachi=?, Gmail=?, HinhAnh=?, Vaitro=? WHERE Idtaikhoan=?";
            $stmt = $connection->prepare($query);
    
            // Chú ý đến việc thay đổi chuỗi định dạng trong bind_param để phản ánh đúng loại dữ liệu và thứ tự
            // Ở đây, giả sử tất cả là chuỗi (s) ngoại trừ Idtaikhoan là số nguyên (i)
            if (!$stmt->bind_param("ssssssssi", $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh, $vaitro, $Idtaikhoan)) {
                echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
                return false;
            }
    
            if (!$stmt->execute()) {
                echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                return false;
            }
    
            $stmt->close();
            $db->dongKetNoi($connection);
            return true; // Người dùng được cập nhật thành công
        } else {
            echo "Lỗi kết nối đến cơ sở dữ liệu.";
            return false;
        }
    }
    function SelectUserCount() {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT COUNT(*) AS count FROM taikhoan";
            $result = $connection->query($query);
            if ($result) {
                $row = $result->fetch_assoc(); // Trích xuất dữ liệu từ đối tượng result
                $db->dongKetNoi($connection);
                return (int)$row['count']; // Trả về số lượng người dùng dưới dạng số nguyên
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
                return false; // Trả về false nếu có lỗi truy vấn
            }
        } else {
            echo "Không thể kết nối đến cơ sở dữ liệu.";
            return false; // Trả về false nếu không thể kết nối đến cơ sở dữ liệu
        }
    }
    
    function SelectMajorCount() {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT COUNT(*) AS count FROM nganhhoc";
            $result = $connection->query($query);
            if ($result) {
                $row = $result->fetch_assoc(); // Trích xuất dữ liệu từ đối tượng result
                $db->dongKetNoi($connection);
                return (int)$row['count']; // Trả về số lượng người dùng dưới dạng số nguyên
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
                return false; // Trả về false nếu có lỗi truy vấn
            }
        } else {
            echo "Không thể kết nối đến cơ sở dữ liệu.";
            return false; // Trả về false nếu không thể kết nối đến cơ sở dữ liệu
        }
    }
    function SelectBVCount() {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT COUNT(*) AS count FROM baiviet";
            $result = $connection->query($query);
            if ($result) {
                $row = $result->fetch_assoc(); // Trích xuất dữ liệu từ đối tượng result
                $db->dongKetNoi($connection);
                return (int)$row['count']; // Trả về số lượng người dùng dưới dạng số nguyên
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
                return false; // Trả về false nếu có lỗi truy vấn
            }
        } else {
            echo "Không thể kết nối đến cơ sở dữ liệu.";
            return false; // Trả về false nếu không thể kết nối đến cơ sở dữ liệu
        }
    }

    function SelectBLCount() {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT COUNT(*) AS count FROM binhluan";
            $result = $connection->query($query);
            if ($result) {
                $row = $result->fetch_assoc(); // Trích xuất dữ liệu từ đối tượng result
                $db->dongKetNoi($connection);
                return (int)$row['count']; // Trả về số lượng người dùng dưới dạng số nguyên
            } else {
                // Handle query error
                echo "Lỗi truy vấn: " . $connection->error;
                return false; // Trả về false nếu có lỗi truy vấn
            }
        } else {
            echo "Không thể kết nối đến cơ sở dữ liệu.";
            return false; // Trả về false nếu không thể kết nối đến cơ sở dữ liệu
        }
    }

    function DeleteUser($idtaikhoan)
{
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if (!$connection) {
        return false;
    }
    
    $query = "DELETE FROM taikhoan WHERE Idtaikhoan = ?";
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        $connection->close();
        return false;
    }

    $stmt->bind_param("i", $idtaikhoan);
    $result = $stmt->execute();
    
    $stmt->close();
    $db->dongKetNoi($connection);
    
    return $result;
}

function InsertChatbot($question, $answer)
{
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if (!$connection) {
        return false;
    }
    $query = "INSERT INTO chatbot (Cauhoi, Cautraloi) VALUES (?, ?)";
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        $connection->close();
        return false;
    }
    $stmt->bind_param("ss", $question, $answer);
    $result = $stmt->execute();
    $stmt->close();
    $db->dongKetNoi($connection);
    return $result;
}

function Viewchatbot(){
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if ($connection) {
        $query = "SELECT * FROM chatbot";
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
function selectChatbotById($idchatbot) {
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if (!$connection) {
        echo "Lỗi kết nối đến cơ sở dữ liệu.";
        return false;
    }

    $query = "SELECT * FROM chatbot WHERE Idchatbot = ?";
    $stmt = $connection->prepare($query);

    if (!$stmt) {
        echo "Lỗi truy vấn: " . $connection->error;
        $db->dongKetNoi($connection);
        return false;
    }

    $stmt->bind_param("i", $idchatbot);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $chatbot = $result->fetch_assoc();
            $stmt->close();
            $db->dongKetNoi($connection);
            return $chatbot;
        } else {
            $stmt->close();
            $db->dongKetNoi($connection);
            echo "Không tìm thấy dữ liệu chatbot cần sửa.";
            return false;
        }
    } else {
        echo "Lỗi truy vấn: " . $stmt->error;
        $stmt->close();
        $db->dongKetNoi($connection);
        return false;
    }
}

function DeleteChatbot($idchatbot)
{
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if (!$connection) {
        return false;
    }
    
    $query = "DELETE FROM chatbot WHERE Idchatbot = ?";
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        $connection->close();
        return false;
    }

    $stmt->bind_param("i", $idchatbot);
    $result = $stmt->execute();
    
    $stmt->close();
    $db->dongKetNoi($connection);
    
    return $result;
}
function UpdateChatbot($idchatbot, $cauhoi, $cautraloi)
{
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if (!$connection) {
        return false;
    }
    
    $query = "UPDATE chatbot SET Cauhoi= ?, Cautraloi= ? WHERE Idchatbot = ?";
    $stmt = $connection->prepare($query);
    
    if (!$stmt) {
        $connection->close();
        return false;
    }

    // Update the bind_param line to include all parameters
    $stmt->bind_param("ssi", $cauhoi, $cautraloi, $idchatbot);
    $result = $stmt->execute();
    
    $stmt->close();
    $db->dongKetNoi($connection);
    
    return $result;
}

}
?>