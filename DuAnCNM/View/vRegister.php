<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

</head>
<style>
    /* General body and container styling */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    overflow: hidden;
    width: 350px;
}

/* Form styling */
form {
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.form-heading {
    margin-bottom: 20px;
    color: #333;
}

.form-group {
    position: relative;
    margin-bottom: 15px;
}

.form-input {
    width: 100%;
    padding: 10px;
    padding-left: 40px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

/* Icon styling in input fields */
.form-group i {
    position: absolute;
    top: 10px;
    left: 10px;
    color: #555;
}

/* Button styling */
.form-submit {
    background-color: #5cb85c;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.form-submit:hover {
    background-color: #4cae4c;
}

/* Overlay container styling */
.overlay-container {
    background: rgba(0,0,0,0.7);
    color: #ffffff;
    padding: 20px;
    text-align: center;
}

.overlay-panel {
    padding: 15px;
    color: #fff;
}

/* Responsive adjustments */
@media (max-width: 600px) {
    .container {
        width: 90%;
    }
}

</style>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="post">
                <h1 class="form-heading">ĐĂNG KÝ</h1>
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-input" placeholder="Tên đăng nhập" name="username" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <input type="password" class="form-input" placeholder="Mật khẩu" name="password" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-input" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-address-card"></i>
                    <input type="text" class="form-input" placeholder="Họ tên" name="fullname" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-phone"></i>
                    <input type="text" class="form-input" placeholder="Số điện thoại" name="phone" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" class="form-input" placeholder="Địa chỉ" name="address" required>
                </div>
                <input type="submit" value="Đăng ký" class="form-submit" name="btn_register">
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào Mừng Bạn!</h1>
                    <p>Đăng ký để sử dụng các dịch vụ của chúng tôi.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

<?php
function startSessionIfNotStarted() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}
startSessionIfNotStarted();
include_once("../Controller/cLogin.php");


if (isset($_REQUEST['btn_register'])) {
    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);
    $email = trim($_REQUEST['email']);
    $fullname = trim($_REQUEST['fullname']);
    $phone = trim($_REQUEST['phone']);
    $address = trim($_REQUEST['address']);
    $role = 3; // Assuming default role for new users

    $controlLogin = new controllogin();
    $result = $controlLogin->registerAccount($username, $password, $fullname, $email, $address, $phone, '', $role);

    if ($result == 1) {
        echo "<script>alert('Đăng ký thành công!'); window.location.href='/DuAnCNM/?mod=login';</script>";
    } else {
        echo "<script>alert('Đăng ký thất bại. Vui lòng thử lại.');</script>";
    }
}
?>
