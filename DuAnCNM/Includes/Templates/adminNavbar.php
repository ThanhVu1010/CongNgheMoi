<style>
.nav-header img {
    width: 50px;
    height: auto;
    margin-right: 10px;
}

.navbar-brand b {
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

#vertical-menu {
    color: black;
}



#vertical-menu .nav-link {
    color: black;
}

#vertical-menu .nav-link:hover {
    background-color: rgba(6, 173, 239, 255);
    /* Hiệu ứng khi di chuột qua */
}
</style>
<!-- TRANG CHU NAVBAR HEADER -->
<header class="headerMenu сlearfix sb-page-header">
    <div class="nav-header">
        <img src="assets/image/logo.jpg" alt="">
        <a class="navbar-brand" href="admin.php"><b>DreamSpark</b></a>
    </div>

    <div class="nav-controls top-nav">
        <ul class="nav top-menu">
            <li class="navbar-item dropdown pe-3 profile-user">
                <?php if (isset($_SESSION['is_login']['Hoten'])) : ?>
                <a class="navbar-link  navbar-profile d-flex align-items-center pe-0 profile-main" style="color: black;"
                    href="#" role="button" data-bs-toggle="dropdown">
                    <img src="assets/image/<?php echo $_SESSION['is_login']['HinhAnh'] ?>" class="rounded-circle"
                        style="width: 30px; height: 30px;">
                    <?php if (isset($_SESSION['is_login']['Hoten'])) : ?>
                    <span class="d-none d-md-block ps-2"><b><?php echo $_SESSION['is_login']['Hoten'] ?></b></span>
                    <?php endif; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end"
                    style="background-color: #fff; box-shadow: 1px 2px 3px #000;">
                    <li class="dropdown-header">
                        <h6 class="text-center"><b><?php echo $_SESSION['is_login']['Hoten'] ?></b></h6>
                        <p class="text-center"><?php echo $_SESSION['is_login']['tenvaitro']; ?></p>
                    </li>
                    <?php if (isset($_SESSION['login']) && $_SESSION['is_login']['Vaitro'] != 3) : ?>
                    <li>
                        <a class="dropdown-item" href="admin.php">
                            <i class="fa-solid fa-gear"></i>
                            <span class="ml-2">Vào trang quản lý</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="admin.php?mod=Profile">
                            <i class="bi bi-person"></i>
                            <span class="ml-2">Hồ sơ người dùng</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="index.php?mod=logout">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="ml-2">Đăng xuất</span>
                        </a>
                    </li>
                </ul>
                <?php else : ?>
            <li class="navbar-item">
                <a class="navbar-link text-white" href="?mod=login" id="login">Đăng
                    nhập</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </li>
            <?php endif; ?>
            </li>

            <li class="main-li webpage-btn">
                <a class="nav-item-button " href="index.php" target="_blank">
                    <i class="fas fa-binoculars"></i>
                    <span>Xem Website</span>
                </a>
            </li>
        </ul>
    </div>
</header>

<!-- VERTICAL NAVBAR -->

<aside class="vertical-menu" style="padding-left: 30px; padding-top: 100px;" id="vertical-menu">
    <div>
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="admin.php">

                    <span>Trang chủ</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-heading">Chức năng</li>
            <?php

            if (isset($_SESSION['login'])) {
                if ($_SESSION['is_login']['Vaitro'] == 1) {
            ?>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <span>Quản lý người dùng</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="admin.php?mod=Chuyenvien">
                            <span>Danh sách chuyên viên</span>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php?mod=PH/HS">
                            <span>Danh sách phụ huynh/ học sinh</span>
                        </a>
                    </li>

                    <li>
                        <a href="admin.php?mod=addUser">
                            <span>Thêm người dùng</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <span>Quản lý bài viết</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="admin.php?mod=ListBV">
                            <span>Danh sách bài viết</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?mod=Approve">
                            <span>Duyệt bài viết</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?mod=AddBV">
                            <span>Thêm bài viết</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <span>Quản lý chatbot</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="admin.php?mod=InsertChatbot">
                            <span>Nhập dữ liệu chatbot</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?mod=Viewchatbot">
                            <span>Xem dữ liệu chatbot</span>
                        </a>
                    </li>

                </ul>
            </li>

            <?php }
            } ?>




<?php
    if (isset($_SESSION['login'])) {
    if ($_SESSION['is_login']['Vaitro'] == 2) {
    ?>
       <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <span>Quản lý bài viết</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="admin.php?mod=ListBV">
                            <span>Danh sách bài viết</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?mod=AddBV">
                            <span>Thêm bài viết</span>
                        </a>
                    </li>

                </ul>
            </li>


            <?php }
            } ?>


        </ul>
    </div>
</aside>