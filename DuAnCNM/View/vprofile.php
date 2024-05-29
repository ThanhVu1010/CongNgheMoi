<?php


if (!isset($_SESSION['is_login']['Idtaikhoan'])) {
    die("Không tìm thấy thông tin người dùng trong session.");
}

$idtaikhoan = $_SESSION['is_login']['Idtaikhoan'];
include_once("Controller/cProfile.php");

$controller = new ControlProfile();
$user = $controller->getUserById($idtaikhoan);

if (!$user) {
    die("Không tìm thấy thông tin người dùng trong cơ sở dữ liệu.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_update'])) {
    $tendangnhap = $_POST['Tendangnhap'] ?? '';
    $matkhau = $_POST['Matkhau'] ?? '';
    $hoten = $_POST['Hoten'] ?? '';
    $sdt = $_POST['SDT'] ?? '';
    $diachi = $_POST['Diachi'] ?? '';
    $email = $_POST['Gmail'] ?? '';
    $hinhanh = $_FILES['HinhAnh'] ?? null;

    if ($hinhanh && move_uploaded_file($hinhanh['tmp_name'], 'assets/image/' . $hinhanh['name'])) {
        if ($controller->updateUser($idtaikhoan, $tendangnhap, $matkhau, $hoten, $sdt, $diachi, $email, $hinhanh['name'])) {
            echo  "<script>alert('Cập nhật thành công!');</script>";
            $user = $controller->getUserById($idtaikhoan);
        } else {
            echo "<script>alert('Cập nhật thông tin thất bại!');</script>";
        }
    } else {
        echo "<script>alert('Lỗi trong quá trình tải lên hình ảnh!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa hồ sơ người dùng</title>
    
</head>
<style>
    .edit-form-container {
    width: 600px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    margin: 0 auto;
    overflow-y: auto;
    margin-top: 50vh;
    transform: translateY(-50%);
}

.form-group {
    margin-bottom: 10px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input[type="text"],
.form-group input[type="password"],
.form-group input[type="file"],
.form-group input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.password-group {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.password-group input[type="password"] {
    flex: 1;
}

.password-group button {
    padding: 10px;
    margin-left: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.password-group button:hover {
    background-color: #45a049;
}

.edit-form-container input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    display: block;
    width: 100%;
    cursor: pointer;
    margin-top: 20px;
}

.edit-form-container input[type="submit"]:hover {
    background-color: #45a049;
}

.edit-form-container h4 {
    text-align: center;
    margin-bottom: 20px;
}

</style>

<div class="main-banner">
    <div class="container">
    <div class="edit-form-container">
        <h4>Hồ sơ cá nhân</h4>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Tendangnhap">Tên đăng nhập:</label>
                <input type="text" id="Tendangnhap" name="Tendangnhap" value="<?php echo htmlspecialchars($user['Tendangnhap']); ?>">
            </div>

            <div class="form-group password-group">
                <label for="Matkhau">Mật khẩu:</label>
                <input type="password" id="Matkhau" name="Matkhau" disabled value="<?php echo htmlspecialchars($user['Matkhau']); ?>">
                <button type="button" id="changePasswordBtn">Đổi</button>
            </div>

            <div class="form-group">
                <label for="Hoten">Họ tên:</label>
                <input type="text" id="Hoten" name="Hoten" value="<?php echo htmlspecialchars($user['Hoten']); ?>">
            </div>

            <div class="form-group">
                <label for="SDT">Số điện thoại:</label>
                <input type="text" id="SDT" name="SDT" value="<?php echo htmlspecialchars($user['SDT']); ?>">
            </div>

            <div class="form-group">
                <label for="Gmail">Email:</label>
                <input type="text" id="Gmail" name="Gmail" value="<?php echo htmlspecialchars($user['Gmail']); ?>">
            </div>

            <div class="form-group">
                <label for="Diachi">Địa chỉ:</label>
                <input type="text" id="Diachi" name="Diachi" value="<?php echo htmlspecialchars($user['Diachi']); ?>">
            </div>

            <div class="form-group">
                <label for="HinhAnh">Hình ảnh:</label>
                <input type="file" id="HinhAnh" name="HinhAnh">
            </div>

            <div class="form-group">
                <input type="submit" name="btn_update" value="Cập nhật">
            </div>
        </form>
    </div>
    </div>
</div>
    <script>
    document.getElementById('changePasswordBtn').addEventListener('click', function() {
        var passwordInput = document.getElementById('Matkhau');
        passwordInput.disabled = false;
        passwordInput.focus();
    });
    </script>

</html>
