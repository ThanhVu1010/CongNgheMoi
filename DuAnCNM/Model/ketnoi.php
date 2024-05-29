<?php
class KetNoiDB
{
    public function moKetNoi()
    {
        $con = new mysqli("localhost", "root", "", "ntv_and_pvp");

        if ($con->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $con->connect_error);
        }

        $con->set_charset("utf8");
        return $con;
    }

    public function dongKetNoi($con)
    {
        $con->close();
    }
}
?>
