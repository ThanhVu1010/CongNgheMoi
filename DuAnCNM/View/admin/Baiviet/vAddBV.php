<?php
include_once("Controller/cBaiviet.php");
include_once("Controller/cNganhhoc.php");
$p = new controlBaiviet();
$p = new controlNganh();

$list_user = $p->getAllNganh();

if (isset($_REQUEST["btn"])) {
    $error = array();
    // Your validation code will go here for checking post-related fields
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
                <h3 class="mb-5">Thêm bài viết</h3>
                <table class="admin_upload">
                    <form action="" enctype="multipart/form-data" method="post">
                        <!-- Your form fields for post title, content, image, etc. -->
                        <!-- For example: -->
                        <tr>
                            <th>Tiêu đề:</th>
                            <th><input type="text" name="Tieude" placeholder="Nhập tiêu đề"></th>
                        </tr>
                        <tr>
                            <th>Nội dung:</th>
                            <th><textarea name="Noidung" rows="5" placeholder="Nhập nội dung"></textarea></th>
                        </tr>
                        <tr>
                            <th>Thêm ảnh:</th>
                            <th><input type="file" name="upfile" id=""></th>
                        </tr>
                        <tr>
                            <th>Chọn chuyên mục:</th>
                            <th>
                                <!-- Replace with your categories -->
                                <select name="Idnganhhoc">
                                    <?php foreach ($list_user as $item) { ?>
                                        <option value="<?php echo $item['Idnganhhoc']; ?>"><?php echo $item['Tennganhhoc']; ?></option>
                                    <?php } ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <td></td>
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

<?php
if (isset($_REQUEST["btn"])) {
    if (empty($error)) {
        // Retrieve and sanitize form data
        $Tieude = $_REQUEST["Tieude"];
        $Noidung = $_REQUEST["Noidung"];
        $tmpimg = $_FILES["upfile"]["tmp_name"];
        $typeimg = $_FILES["upfile"]["type"];
        $Hinhanh = $_FILES["upfile"]["name"];
        $sizeimg = $_FILES["upfile"]["size"];
        $Idtaikhoan = $_SESSION['is_login']['Idtaikhoan'];
        $Idnganhhoc = $_REQUEST["Idnganhhoc"];
        $Trangthai = 1; // For example, 1 for active post

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = new DateTime();
        $Ngaydang = $now->format('Y-m-d H:i:s');

        $p = new controlBaiviet();

        $kq = $p->InsertBV($Tieude, $Noidung, $Hinhanh, $Ngaydang, $Idtaikhoan, $Idnganhhoc, $tmpimg, $typeimg, $sizeimg);
        
        // Handle the results
        if ($kq == 1) {
            echo '<script>alert("Thêm bài viết thành công")</script>';
        } elseif ($kq == 0) {
            echo '<script>alert("Không thể thêm bài viết")</script>';
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

</body>
</html>
