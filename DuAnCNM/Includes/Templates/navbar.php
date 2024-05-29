

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <img src="assets/image/logo.jpg" alt="" style="width: 62px;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="index.php" class="active">Trang chủ</a></li>
                        <li><a href="?mod=baiviet">Bài viết</a></li>
                        <li><a href="index.php?mod=gioithieu">Giới thiệu</a></li>
                        
                        <li class="navbar-item dropdown pe-3 profile-user">
                              <?php if (isset($_SESSION['is_login']['Hoten'])): ?>
                                  <a class="navbar-link text-white navbar-profile d-flex align-items-center pe-0 profile-main" href="#" role="button" data-toggle="dropdown">
                                  <img src="assets/image/<?php echo $_SESSION['is_login']['HinhAnh'] ?>" class="rounded-circle" style="width: 30px; height: 30px;">
                                      <?php if (isset($_SESSION['is_login']['Hoten'])): ?>
                                          <span class="d-none d-md-block  ps-2"> <?php echo $_SESSION['is_login']['Hoten'] ?></span>
                                      <?php endif; ?>
                                  </a>
                                  <ul class="dropdown-menu dropdown-menu-end" style="background-color: #fff; box-shadow: 1px 2px 3px #000;">
                                      <li class="dropdown-header">
                                          <h6 class="text-center"><b><?php echo $_SESSION['is_login']['Hoten'] ?></b></h6>
                                          <p class="text-center"><?php echo $_SESSION['is_login']['tenvaitro']; ?></p>
                                      </li>
                                      <?php if (isset($_SESSION['login']) && $_SESSION['is_login']['Vaitro'] != 3): ?>
                                          <li>
                                              <a class="dropdown-item" href="admin.php">
                                                  <i class="fa-solid fa-gear"></i>
                                                  <span class="ml-2">Vào trang quản lý</span>
                                              </a>
                                          </li>
                                      <?php endif; ?>
                                      <li><hr class="dropdown-divider"></li>
                                      <li>
                                          <a class="dropdown-item" href="?mod=Profile">
                                              <i class="bi bi-person"></i>
                                              <span class="ml-2">Quản lý tài khoản</span>
                                          </a>
                                      </li>
                                      <li><hr class="dropdown-divider"></li>
                                      <li>
                                          <a class="dropdown-item" href="index.php?mod=logout">
                                              <i class="bi bi-box-arrow-right"></i>
                                              <span class="ml-2">Đăng xuất</span>
                                          </a>
                                      </li>
                                  </ul>
                                  <?php else: ?>
                                      <li class="navbar-item">
                                          <a class="navbar-link text-white" href="?mod=login" id="login">Đăng nhập</a>
                                      </li>
                                  <?php endif; ?>
                          </li>

                  </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
  