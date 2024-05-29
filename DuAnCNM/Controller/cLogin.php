<?php
include_once("C:/xampp/htdocs/DuAnCNM/Model/mLogin.php");



class controllogin
{
    function getAllLogin($username, $password)
    {
        $p = new ModelLogin();
        $tblLogin = $p->selectLogin();

        if ($tblLogin) {
            // Kiểm tra kết quả nhận được có dữ liệu không
            if ($tblLogin->num_rows > 0) {
                while ($item = $tblLogin->fetch_assoc()) {
                    if ($username == $item['Tendangnhap'] && $password == $item['Matkhau']) {
                        $_SESSION['login'] = true;
                        $_SESSION['is_login'] = array();
                        $_SESSION['is_login']['Hoten'] = $item['Hoten'];
                        $_SESSION['is_login']['Vaitro'] = $item['Vaitro'];
                        $_SESSION['is_login']['HinhAnh'] = $item['HinhAnh'];
                        $_SESSION['is_login']['Idtaikhoan'] = $item['Idtaikhoan'];
                        $_SESSION['is_login']['tenvaitro'] = $item['tenvaitro'];
                        $_SESSION['is_login']['Tendangnhap'] = $item['Tendangnhap'];
                        $_SESSION['is_login']['Matkhau'] = $item['Matkhau'];
                        $_SESSION['is_login']['SDT'] = $item['SDT'];
                        $_SESSION['is_login']['Gmail'] = $item['Gmail'];
                        $_SESSION['is_login']['Diachi'] = $item['Diachi'];

                        return 1;
                    }
                }
            } else {
                // Xử lý trường hợp không có dữ liệu
                return -1;
            }
        } else {
            // Xử lý trường hợp có lỗi truy vấn
            return -1;
        }

        return 0;
    }

    function registerAccount($username, $password, $hoten, $gmail, $diachi, $sdt, $hinhanh, $vaitro)
    {
        $p = new ModelLogin();
        $result = $p->registerAccount($username, $password, $hoten, $gmail, $diachi, $sdt, $hinhanh, $vaitro);

        if ($result) {
            // You could immediately log the user in here, or redirect to a login page
            $_SESSION['is_login'] = array(
                'Hoten' => $hoten,
                'Vaitro' => $vaitro,
                'HinhAnh' => $hinhanh,
                'Tendangnhap' => $username,
                'Gmail' => $gmail,
                'Diachi' => $diachi,
                'SDT' => $sdt
            );
            return 1; // Registration successful
        } else {
            return -1; // Registration failed
        }
    }
    
}
