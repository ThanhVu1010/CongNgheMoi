<?php
include_once("Controller/cAdmin.php");
$p = new controlAdmin();

$list_user = $p->getVaitro();
$idtaikhoan = $_GET['Idtaikhoan'];
$user = $p->getUserById($idtaikhoan);

$diff = $p->getUsersDifferentIdTaiKhoan($idtaikhoan);

if (isset($_REQUEST["btn"])) {
    $error = array();
    foreach ($diff  as $item) {
        if ($_REQUEST["Gmail"] == $item['Gmail']) {
            $error['Gmail'] = 'Email đã tồn tại !';
        }
        if (empty($_REQUEST['Tendangnhap'])) {
            $error['empty']['Tendangnhap'] = 'Chưa nhập tên đăng nhập *';
        }
        if (empty($_REQUEST['Hoten'])) {
            $error['empty']['Hoten'] = 'Chưa nhập họ tên *';
        }
        if (empty($_REQUEST['SDT'])) {
            $error['empty']['SDT'] = 'Chưa nhập số điện thoại *';
        }
        if (empty($_REQUEST['Gmail'])) {
            $error['empty']['Gmail'] = 'Chưa nhập email *';
        }
        if (empty($_REQUEST['Vaitro'])) {
            $error['empty']['Vaitro'] = 'Chưa chọn vai trò *';
        }
        if (empty($_REQUEST['Diachi'])) {
            $error['empty']['Diachi'] = 'Chưa nhập địa chỉ *';
        }
        if ($_REQUEST["Tendangnhap"] == $item['Tendangnhap']) {
            $error['Tendangnhap'] = 'tên đăng nhập đã tồn tại !';
        }
        if ($_REQUEST["SDT"] == $item['SDT']) {
            $error['SDT'] = 'Số điện thoại đã tồn tại !';
        }
    }
}
?>
<style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        #content {
            margin-left: 240px;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container-fluid {
            max-width: 960px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .upload {
            position: relative;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        h3 {
            text-align: center;
            color: #4a4a4a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 16px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"], input[type="reset"] {
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            float: right;
            margin-right: 10px;
        }

        input[type="reset"] {
            background-color: #f44336;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            opacity: 0.9;
        }

        .text-danger {
            color: #ff0000;
        }

        label {
            font-weight: bold;
        }
    </style>
<div id="content" style="margin-left:240px;">
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
        <div class="container-fluid px-4 add mt-3">
            <div class="upload p-3" style="position: relative;">
                <h3 class="mb-5">Sửa người dùng</h3>


                <table class="admin_upload">
                    <form action="" enctype="multipart/form-data" method="post">
                        <tr>
                            <th>Tên đăng nhập:</th>
                            <th><input type="text" name="Tendangnhap" id="Tendangnhap" placeholder="Nhập tên đăng nhập"
                                    value="<?php echo $user['Tendangnhap'] ?>">
                                <p class="text-danger"><?php if (!empty($error['Tendangnhap'])) {
                                                    echo  $error['Tendangnhap'];
                                                } elseif (!empty($error['empty']['Tendangnhap'])) {
                                                    echo  $error['empty']['Tendangnhap'];
                                                }    ?></p>
                            </th>
                        </tr>
                        <tr>
                            <th>Mật khẩu:</th>
                            <th><input type="password" id="Matkhau" name="Matkhau" placeholder="nhập mật khẩu"
                                    value="<?php echo $user['Matkhau'] ?>">

                            </th>
                        </tr>


                        <tr>
                            <th>Họ tên: </th>
                            <th><input type="text" name="Hoten" id="Hoten" placeholder="Nhập họ tên"
                                    value="<?php echo $user['Hoten'] ?>">
                                <p class="text-danger"><?php if (!empty($error['Hoten'])) {
                                                    echo  $error['Hoten'];
                                                } elseif (!empty($error['empty']['Hoten'])) {
                                                    echo  $error['empty']['Hoten'];
                                                }   ?></p>
                            </th>

                        </tr>
                        <tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <th><input type="number" name="SDT" placeholder="Nhập số điện thoại"
                                    value="<?php echo $user['SDT'] ?>">
                                <p class="text-danger"><?php if (!empty($error['SDT'])) {
                                                    echo  $error['SDT'];
                                                } elseif (!empty($error['empty']['SDT'])) {
                                                    echo  $error['empty']['SDT'];
                                                }   ?></p>
                            </th>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <th><input type="text" name="Gmail" placeholder="Nhập email"
                                    value="<?php echo $user['Gmail'] ?>">
                                <p class="text-danger"><?php if (!empty($error['Gmail'])) {
                                                    echo  $error['Gmail'];
                                                } elseif (!empty($error['empty']['Gmail'])) {
                                                    echo  $error['empty']['Gmail'];
                                                }   ?></p>
                            </th>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <th><input type="text" name="Diachi" placeholder="Nhập địa chỉ"
                                    value="<?php echo $user['Diachi'] ?>">
                                <p class="text-danger"><?php if (!empty($error['Diachi'])) {
                                                    echo  $error['Diachi'];
                                                } elseif (!empty($error['empty']['Diachi'])) {
                                                    echo  $error['empty']['Diachi'];
                                                }   ?></p>
                            </th>
                        </tr>
                        <tr>
                            <th>Thêm ảnh:</th>
                            <th>
                                <input type="file" name="upfile" id="">

                            </th>
                        </tr>
                        <tr>
                            <th>Chọn chức vụ:</th>
                            <th>
                                <?php foreach ($list_user as $title_item) {

                            if ($user['Vaitro'] == $title_item['Idvaitro']) { ?>
                                <input checked type="radio" id="" name="Vaitro"
                                    value="<?php echo $title_item['Idvaitro'] ?>">
                                <label for="age1"><?php echo $title_item['tenvaitro'] ?></label>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>


                                <?php } else {
                            ?><input type="radio" id="" name="vaitro" value="<?php echo $title_item['Idvaitro'] ?>">
                                <label for="age1"><?php echo $title_item['tenvaitro'] ?></label>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <?php }
                        } ?>
                                <p class="text-danger"><?php if (!empty($error['empty']['Vaitro'])) {
                                                    echo  $error['empty']['Vaitro'];
                                                }    ?></p>
                            </th>
                        </tr>
                        <tr>

                            <td>
                                <input type="hidden" name="HinhAnh" value="<?php echo $user['HinhAnh'] ?>">

                            </td>
                            <td>
                                <input type="submit" value="Cập nhật" id="submit" name="btn">
                                <input type="reset" value="Hủy" id="reset" name="btn">


                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </section>
</div>

</body>

</html>

<?php


if (isset($_REQUEST["btn"])) {
    if (empty($error)) {

    $Idtaikhoan = $_REQUEST["Idtaikhoan"];
    $matkhau = $_REQUEST["Matkhau"];
    $tendangnhap = $_REQUEST["Tendangnhap"];
    $hoten = $_REQUEST["Hoten"];
    $sdt = $_REQUEST["SDT"];
    $email = $_REQUEST["Gmail"];
    $vaitro = $_REQUEST["Vaitro"];
    $hinhanh = $_REQUEST['HinhAnh'];
    $diachi = $_REQUEST['Diachi'];



    $p = new controlAdmin();

    $kq = $p->UpdateUser($Idtaikhoan, $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh, $vaitro, $tmpimg = '', $typeimg = '', $sizeimg = '');

    if ($kq == 1) {
        echo '<script>alert("Sửa người dùng thành công")</script>';
        if ($_GET['po'] == 'Ph/Hs') {
            echo header("refresh:0; url='admin.php?mod=PH/HS'");
        } else {
            echo header("refresh:0; url='admin.php?mod=Chuyenvien'");
        }
    } elseif ($kq == 0) {
        echo '<script>alert("Không thể sửa người dùng")</script>';
    } elseif ($kq == -1) {
        echo '<script>alert("Không thể Upload ảnh")</script>';
    } elseif ($kq == -2) {
        echo '<script>alert("Kích thước size phải nhỏ hơn 10MB")</script>';
    } elseif ($kq == -3) {
        echo '<script>alert("File thêm dữ liệu phải là file ảnh")</script>';
    } else {
        echo "Lỗi";
    }
}

}
?>