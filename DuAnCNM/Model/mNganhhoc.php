<?php
include_once("ketnoi.php");
class modelNganh{
    function selectAllNganh()
    {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "SELECT * FROM nganhhoc  ";
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