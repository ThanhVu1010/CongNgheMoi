<?php
include_once ("Controller/cAdmin.php"); 
$p = new controlAdmin();
$userCount = $p->getUserCount();
$MCount = $p->getMajorCount();
$BVCount = $p->getBVCount();
$BLCount = $p->getBLCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<style>
/* Basic Reset */
body,
h1,
p {
    margin: 0;
    padding: 0;
}

/* Theme and Background */
body.theme-light {
    background-color: #f7fafc;
    color: #1a202c;
}

body.theme-dark {
    background-color: #2d3748;
    color: #e2e8f0;
}

.container {
    display: flex;
    height: 100vh;
    align-items: center;
    justify-content: center;
    min-height: 100vh; 
    width: 100%; 
    padding: 20px; 
    
}
/*
.container {
    display: flex;
    align-items: start; /* Thay vì center để cho phép nội dung mở rộng theo chiều dọc 
    justify-content: center;
    min-height: 100vh; /* Đảm bảo container có đủ chiều cao 
    width: 100%; /* Đảm bảo container chiếm đủ không gian ngang 
    padding: 20px; /* Thêm padding để tránh việc content dính sát mép 
}
*/
.content {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Giảm kích thước tối thiểu để các card có thể xếp ngang */
    width: 100%; /* Đảm bảo content chiếm đủ không gian */
    padding-left: 300px;
}



.card {
    display: flex;
    align-items: center;
    justify-content: start; /* Để icon và thông tin thẳng hàng */
    background-color: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    padding: 24px; /* Tăng padding để card rộng rãi hơn */
    width: 100%; /* Đảm bảo card mở rộng đầy đủ chiều ngang */
}


.icon-bg {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px; /* Tăng kích thước background của icon */
    height: 60px; /* Tăng kích thước background của icon */
    background-color: pink;
    border-radius: 30px; /* Đảm bảo là hình tròn */
    margin-right: 20px; /* Tăng khoảng cách giữa icon và text */
}

.icon {
    
    width: 30px; /* Kích thước của icon */
    height: 30px; /* Kích thước của icon */
}

.stat-title {
    font-size: 18px; /* Tăng kích thước font của tiêu đề */
    color: #4a5568;
    margin-bottom: 4px; /* Khoảng cách giữa tiêu đề và số liệu */
}

.stat-value {
    font-size: 22px; /* Tăng kích thước font của số liệu */
    font-weight: bold;
    color: #2d3748;
}

/* Dark theme adjustments */
.theme-dark .card {
    background-color: #4a5568;
}

.theme-dark .stat-title,
.theme-dark .stat-value {
    color: #cbd5e0;
}
</style>

<body class="theme-light">
    <div class="container">
        <!-- Main Content -->
        <div class="content">
            <!-- Card -->
            <div class="card">
                <div class="icon-bg">
                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                        </path>
                    </svg>
                </div>
                <div class="info">
                    <p class="stat-title">Tổng người dùng</p>
                    <p class="stat-value"><?php echo htmlspecialchars($userCount); ?></p>
                </div>
            </div>
            <!-- More cards can be added in similar fashion -->
            <div class="card">
                <div class="icon-bg">
                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="info">
                    <p class="stat-title">Số ngành học</p>
                    <p class="stat-value"><?php echo htmlspecialchars($MCount); ?></p>
                </div>
            </div>
            <!-- More cards can be added in similar fashion -->
            <div class="card">
                <div class="icon-bg">
                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="info">
                    <p class="stat-title">Số bài viết</p>
                    <p class="stat-value"><?php echo htmlspecialchars($BVCount); ?></p>
                </div>
            </div>
            <!-- More cards can be added in similar fashion -->
            <div class="card">
                <div class="icon-bg">
                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="info">
                    <p class="stat-title">Số bình luận</p>
                    <p class="stat-value"><?php echo htmlspecialchars($BLCount); ?></p>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Include Tailwind CSS -->
<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>

</html>