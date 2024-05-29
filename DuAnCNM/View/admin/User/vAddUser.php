<?php
include_once("Controller/cAdmin.php");

$p = new controlAdmin();
$list_user = $p->getVaitro();
$taiKhoan = $p->getUser();
$error = array();

// Moved request check to the top for clarity
if (isset($_REQUEST["btn"])) {
    // Validation logic is now more concise
    $requiredFields = ['Tendangnhap' => 'Chưa nhập tên đăng nhập *', 'Hoten' => 'Chưa nhập họ tên *', 'SDT' => 'Chưa nhập số điện thoại *', 'Gmail' => 'Chưa nhập email *', 'Vaitro' => 'Chưa chọn vai trò*'];
    $uniqueFields = ['Tendangnhap' => 'Tên đăng nhập đã tồn tại !', 'SDT' => 'Số điện thoại đã tồn tại !', 'Gmail' => 'Gmail đã tồn tại !'];

    foreach ($requiredFields as $field => $message) {
        if (empty($_REQUEST[$field])) {
            $error['empty'][$field] = $message;
        }
    }

    foreach ($taiKhoan as $item) {
        foreach ($uniqueFields as $field => $message) {
            if ($_REQUEST[$field] == $item[$field]) {
                $error[$field] = $message;
            }
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
                <h3 class="mb-5">Thêm người dùng</h3>
                <table class="admin_upload">
                    <form action="" enctype="multipart/form-data" method="post">
                        <tr>
                            <th>Tên đăng nhập:</th>
                            <th><input type="text" name="Tendangnhap" id="Tendangnhap" placeholder="Nhập tên đăng nhập"
                                    value="<?php if (isset($_REQUEST["Tendangnhap"])) {
                                                                                                                        echo $_REQUEST["Tendangnhap"];
                                                                                                                    } ?>">
                                <p class="text-danger"><?php if (!empty($error['Tendangnhap'])) {
                                                    echo  $error['Tendangnhap'];
                                                } elseif (!empty($error['empty']['Tendangnhap'])) {
                                                    echo  $error['empty']['Tendangnhap'];
                                                }    ?></p>
                            </th>
                        </tr>
                        <tr>
                            <th>Mật khẩu:</th>
                            <th><input type="matkhau" id="matkhau" name="matkhau" placeholder="nhập mật khẩu"
                                    value="123456"></th>
                        </tr>


                        <tr>
                            <th>Họ tên:</th>
                            <th><input type="text" name="Hoten" placeholder="Nhập họ tên" value="<?php if (isset($_REQUEST["Hoten"])) {
                                                                                                echo $_REQUEST["Hoten"];
                                                                                            } ?>">

                                <p class="text-danger"><?php if (!empty($error['empty']['Hoten'])) {
                                                    echo  $error['empty']['Hoten'];
                                                }    ?></p>
                            </th>
                        </tr>
                        <tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <th><input type="number" name="SDT" placeholder="Nhập số điện thoại" value="<?php if (isset($_REQUEST["SDT"])) {
                                                                                                        echo $_REQUEST["SDT"];
                                                                                                    } ?>">
                                <p class="text-danger"><?php if (!empty($error['SDT'])) {
                                                    echo  $error['SDT'];
                                                } elseif (!empty($error['empty']['SDT'])) {
                                                    echo  $error['empty']['SDT'];
                                                }   ?></p>
                            </th>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <th><input type="text" name="Gmail" placeholder="Nhập Gmail" value="<?php if (isset($_REQUEST["Gmail"])) {
                                                                                            echo $_REQUEST["Gmail"];
                                                                                        } ?>">
                                <p class="text-danger"><?php if (!empty($error['Gmail'])) {
                                                    echo  $error['Gmail'];
                                                } elseif (!empty($error['empty']['Gmail'])) {
                                                    echo  $error['empty']['Gmail'];
                                                }   ?></p>
                            </th>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <th><input type="text" name="Diachi" placeholder="Nhập địa chỉ" value="<?php if (isset($_REQUEST["Diachi"])) {
                                                                                            echo $_REQUEST["Diachi"];
                                                                                        } ?>">
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
                            <th>Chọn vai trò:</th>
                            <th>
                                <?php foreach ($list_user as $item) { ?>
                                <input type="radio" id="" name="Vaitro" value="<?php echo $item['Idvaitro'] ?>">
                                <label for="age1"><?php echo $item['tenvaitro'] ?></label>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <?php  } ?>
                                <p class="text-danger"><?php if (!empty($error['empty']['Vaitro'])) {
                                                    echo  $error['empty']['Vaitro'];
                                                }    ?></p>
                            </th>
                        </tr>
                        <tr>

                            <td>

                            </td>
                            <td>
                                <input type="submit" value="Thêm" id="submit" name="btn">
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
// Submission handling
if (isset($_REQUEST["btn"]) && empty($error)) {
    $maNV = $_REQUEST["maNV"] ?? ''; // Use null coalescing operator for optional fields
    $matkhau = $_REQUEST["matkhau"];
    $Tendangnhap = $_REQUEST["Tendangnhap"];
    $hoten = $_REQUEST["Hoten"];
    $sdt = $_REQUEST["SDT"];
    $email = $_REQUEST["Gmail"];
    $diachi = $_REQUEST["Diachi"];
    $vaitro = $_REQUEST["Vaitro"] ?? '';
    $tmpimg = $_FILES["upfile"]["tmp_name"];
    $typeimg = $_FILES["upfile"]["type"];
    $hinhanh = $_FILES["upfile"]["name"];
    $sizeimg = $_FILES["upfile"]["size"];

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $now = new DateTime();
    $ngaytao = $now->format('Y-m-d H:i:s');

    $p = new controlAdmin();
    $kq = $p->InsertUser($Tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh, $vaitro);

    // Simplified success/error handling
    if ($kq > 0) {
        echo '<script>alert("Thêm nhân viên thành công");</script>';
    } else {
        $errorMessages = [
            0 => "Không thể thêm nhân viên",
            -1 => "Không thể Upload ảnh",
            -2 => "Kích thước size phải nhỏ hơn 10MB",
            -3 => "File thêm dữ liệu phải là file ảnh"
        ];
        echo '<script>alert("' . ($errorMessages[$kq] ?? 'Lỗi không xác định') . '");</script>';
    }
}
?>