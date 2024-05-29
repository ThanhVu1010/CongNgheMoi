<?php
include_once("Controller/cBaiviet.php");
include_once("Controller/cNganhhoc.php");

// Kiểm tra xem có tham số Idbaiviet được truyền vào qua URL không
if(isset($_GET['Idbaiviet'])) {
    $Idbaiviet = $_GET['Idbaiviet'];
    
    // Khởi tạo các đối tượng controller
    $p = new controlBaiviet();
    $p_nganh = new controlNganh();

    // Lấy danh sách ngành học
    $list_nganh = $p_nganh->getAllNganh();

    // Lấy thông tin của bài viết cần sửa
    $baiviet = $p->getBaivietbyIDnganh($idbv);

    $baiviet_info = $p->getBaivietInfo($Idbaiviet);

    // Xử lý khi người dùng nhấn nút cập nhật
    if (isset($_POST["btn"])) {
        $Tieude = $_POST["Tieude"];
        $Noidung = $_POST["Noidung"];
        $tmpimg = $_FILES["upfile"]["tmp_name"];
        $typeimg = $_FILES["upfile"]["type"];
        $Ngaydang = $_POST["Ngaydang"];
        $Hinhanh = $_FILES["upfile"]["name"];
        $sizeimg = $_FILES["upfile"]["size"];
        $Idnganhhoc = $_POST["Idnganhhoc"];
        
        // Gọi phương thức cập nhật bài viết từ controller
        $result = $p->UpdateBV($Idbaiviet, $Tieude, $Noidung, $Hinhanh, $Ngaydang, $Idnganhhoc, $tmpimg, $typeimg, $sizeimg);
        
        // Xử lý kết quả cập nhật
        if ($result == 1) {
            echo '<script>alert("Cập nhật bài viết thành công")</script>';
            echo header("refresh:0; url='admin.php?mod=ListBV'");
            // Redirect hoặc thực hiện hành động khác sau khi cập nhật thành công
        } else {
            echo '<script>alert("Không thể cập nhật bài viết")</script>';
        }
    }
} else {
    // Trường hợp không có Idbaiviet được truyền vào
    echo "Không tìm thấy bài viết cần sửa";
    // Hoặc thực hiện chuyển hướng người dùng về trang khác
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

th,
td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 8px;
    margin-top: 6px;
    margin-bottom: 16px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"],
input[type="reset"] {
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

input[type="submit"]:hover,
input[type="reset"]:hover {
    opacity: 0.9;
}

.text-danger {
    color: #ff0000;
}

label {
    font-weight: bold;
}
</style>

<!-- Phần giao diện HTML -->
<div id="content" style="margin-left:240px;">
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
        <div class="container-fluid px-4 add mt-3">
            <div class="upload p-3" style="position: relative;">
                <h3 class="mb-5">Sửa bài viết</h3>
                <table class="admin_upload">
                    <form action="" enctype="multipart/form-data" method="post">
                        <!-- Hiển thị thông tin cũ của bài viết -->
                        <tr>
                            <th>Tiêu đề:</th>
                            <th><input type="text" name="Tieude" placeholder="Nhập tiêu đề"
                                    value="<?php echo $baiviet_info['Tieude']; ?>"></th>
                        </tr>
                        <tr>
                            <th>Nội dung:</th>
                            <th><textarea name="Noidung" rows="5"
                                    placeholder="Nhập nội dung"><?php echo $baiviet_info['Noidung']; ?></textarea></th>
                        </tr>
                        <tr>
                            <th>Ngày đăng:</th>
                            <th><input type="date" name="Ngaydang"
                                    value="<?php echo date('Y-m-d', strtotime($baiviet_info['Ngaydang'])); ?>"></th>
                        </tr>

                        <tr>
                            <th>Ảnh hiện tại:</th>
                            <th><img src="assets/baiviet/<?php echo $baiviet_info['Hinhanh']; ?>" alt="Ảnh hiện tại">
                            </th>
                        </tr>
                        <tr>
                            <th>Chọn ảnh mới:</th>
                            <th><input type="file" name="upfile" id=""></th>
                        </tr>
                        <tr>
                            <th>Chọn chuyên mục:</th>
                            <th>
                                <select name="Idnganhhoc">
                                    <?php foreach ($list_nganh as $item) { ?>
                                    <option value="<?php echo $item['Idnganhhoc']; ?>"
                                        <?php if($item['Idnganhhoc'] == $baiviet_info['Idnganhhoc']) echo "selected"; ?>>
                                        <?php echo $item['Tennganhhoc']; ?></option>
                                    <?php } ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <td></td>
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