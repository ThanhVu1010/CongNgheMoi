<?php
include_once("ketnoi.php");


class ModelLogin
{
     function selectLogin()
    {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "SELECT * FROM taikhoan INNER JOIN `Vaitro` ON taikhoan.Vaitro = vaitro.Idvaitro";
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


    function registerAccount($username, $password, $hoten, $gmail, $diachi, $sdt, $hinhanh, $vaitro)
{
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();
    if ($connection) {
        // Prepare the SQL statement to avoid SQL injection
        $stmt = $connection->prepare("INSERT INTO taikhoan (Tendangnhap, Matkhau, Hoten, Gmail, Diachi, SDT, Hinhanh, Vaitro) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssi", $username, $password, $hoten, $gmail, $diachi, $sdt, $hinhanh, $vaitro);

        if ($stmt->execute()) {
            $stmt->close();
            $db->dongKetNoi($connection);
            return true;
        } else {
            echo "Error: " . $stmt->error;
            $stmt->close();
            $db->dongKetNoi($connection);
            return false;
        }
    } else {
        return false;
    }
}

}
?>