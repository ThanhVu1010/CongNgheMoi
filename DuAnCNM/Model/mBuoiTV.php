<?php
include_once("ketnoi.php");
class modelBuoiTV{
    function selectAllBuoiTV()
    {
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();
    
        if ($connection) {
            $query = "SELECT buoituvan.*, GROUP_CONCAT(nganhhoc.Tennganhhoc SEPARATOR ', ') AS Tennganhhocs
                FROM buoituvan 
                LEFT JOIN chitietbuoitv ON buoituvan.Idbuoituvan = chitietbuoitv.Idbuoituvan 
                LEFT JOIN nganhhoc ON chitietbuoitv.Idnganhhoc = nganhhoc.Idnganhhoc
                GROUP BY buoituvan.Idbuoituvan;";
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
    
    
    function selectdangkytuvan(){
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "SELECT * FROM dangkytuvan INNER JOIN buoituvan ON dangkytuvan.Idbuoituvan = buoituvan.Idbuoituvan
            INNER JOIN taikhoan ON dangkytuvan.Idtaikhoan = taikhoan.Idtaikhoan";
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


    function selectBuoiTVByNganhHoc($Idnganhhoc){
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "SELECT buoituvan.*, nganhhoc.Idnganhhoc, GROUP_CONCAT(nganhhoc.Tennganhhoc SEPARATOR ', ') AS Tennganhhocs
            FROM chitietbuoitv 
            INNER JOIN buoituvan ON chitietbuoitv.Idbuoituvan = buoituvan.Idbuoituvan 
            INNER JOIN nganhhoc ON chitietbuoitv.Idnganhhoc = nganhhoc.Idnganhhoc 
            WHERE nganhhoc.Idnganhhoc = '$Idnganhhoc'
            GROUP BY buoituvan.Idbuoituvan";
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



//cos van de
function selectShowchitiet($idbtv) {
    $db = new KetNoiDB();
    $connection = $db->moKetNoi();

    if ($connection) {
        // Sửa truy vấn để sử dụng Idbuoituvan thay vì Idnganhhoc
        $query = "SELECT buoituvan.*, GROUP_CONCAT(nganhhoc.Tennganhhoc SEPARATOR ', ') AS Tennganhhocs
                  FROM chitietbuoitv 
                  INNER JOIN buoituvan ON chitietbuoitv.Idbuoituvan = buoituvan.Idbuoituvan 
                  INNER JOIN nganhhoc ON chitietbuoitv.Idnganhhoc = nganhhoc.Idnganhhoc 
                  WHERE buoituvan.Idbuoituvan = '$idbtv'
                  GROUP BY buoituvan.Idbuoituvan";
        $result = $connection->query($query);

        if ($result) {
            $data = array();
            
            while ($row = $result->fetch_assoc()) {

                $data['buoituvan']['Idbuoituvan'] = $row['Idbuoituvan'];
                    $data['buoituvan']['Tenbuoituvan'] = $row['Tenbuoituvan'];
                    $data['buoituvan']['Thoigian'] = $row['Thoigian'];
                    $data['buoituvan']['Thoigiandangky'] = $row['Thoigiandangky'];
                    $data['buoituvan']['Diadiem'] = $row['Diadiem'];
                    $data['buoituvan']['Hinhthuc'] = $row['Hinhthuc'];
                    $data['buoituvan']['SoluongThamgia'] = $row['SoluongThamgia'];
                    $data['buoituvan']['Sluongdangky'] = $row['Sluongdangky'];
                    $data['buoituvan']['Hinh'] = $row['Hinh'];
                    $data['buoituvan']['Tennganhhocs'] = $row['Tennganhhocs'];
            }

            $db->dongKetNoi($connection);
            return $data;
        } else {
            echo "Lỗi truy vấn: " . $connection->error;
        }
    } else {
        return false;
    }
}

    function selectCauhoi(){
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "SELECT * FROM  cauhoituvan  INNER JOIN  taikhoan ON cauhoituvan.Idtaikhoan = taikhoan.Idtaikhoan INNER JOIN  buoituvan ON cauhoituvan.Idbuoituvan = buoituvan.Idbuoituvan
        ORDER BY 
            cauhoituvan.Idcauhoi;
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


    function Insertcauhoi($noidungcauhoi, $Idtaikhoan, $idbtv){
        $db = new KetNoiDB();
        $connection = $db->moKetNoi();

        if ($connection) {
            $query = "INSERT INTO cauhoituvan (Noidungcauhoi, Idtaikhoan, Idbuoituvan) 
            VALUES ('$noidungcauhoi', '$Idtaikhoan' , '$idbtv');";
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