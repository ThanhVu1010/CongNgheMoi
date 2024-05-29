<?php
include_once("Controller/cBaiviet.php");

$p = new controlBaiviet();

if (isset($_GET['Idbaiviet'])) {
    $idbv = $_GET['Idbaiviet'];
    $baiviet = $p->getShowchitiet($idbv);

    if (!$baiviet) {
        echo "Không có bài viết nào được tìm thấy với ID này.";
        exit; // Stop execution if no article is found
    }
} else {
    echo "Không có ID bài viết được cung cấp.";
    exit; // Stop execution if no ID is provided
}

if (isset($_POST['btnSubmitBinhLuan'])) {
    $idbtv = isset($_GET['Idbaiviet']) ? $_GET['Idbaiviet'] : 0;

    if (isset($_SESSION['is_login']) && $_SESSION['is_login']['Idtaikhoan']) {
        $Idtaikhoan = $_SESSION['is_login']['Idtaikhoan'];
        $noidung = isset($_POST['noidungBinhLuan']) ? htmlspecialchars($_POST['noidungBinhLuan']) : '';

        $result = $p->NhapBinhluan($noidung, $Idtaikhoan, $idbv);
        if ($result) {
            // Use redirect after post to prevent duplicate submissions
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        } else {
            echo '<script>alert("Có lỗi xảy ra khi thêm bình luận. Vui lòng thử lại.");</script>';
        }
    } else {
        echo '<script>alert("Vui lòng đăng nhập để gửi bình luận.")</script>';
        echo header("refresh: 0; url='index.php?mod=login'");
    }
}
$binhluan = $p->getBinhluan();
?>



<div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2 style='color: white;'>Bài viết</h2>

          <h4><?php

            if (isset($baiviet['nganhhoc']) && is_array($baiviet['nganhhoc'])) {
              foreach ($baiviet['nganhhoc'] as $nganhhoc) {
                echo $nganhhoc['Tennganhhoc'];
              }
          }else {
            echo "Không truy cập được ngành học";
          }
          ?></h4>

         
        </div>
      </div>
    </div>
  </div>

  <div class="single-product section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="left-image">
            <img src="assets/baiviet/<?php echo $baiviet['baiviet']['Hinhanh']; ?> " alt="">
          </div>
        </div>
        <div class="col-lg-6 align-self-center">
        <h3><?php echo $baiviet['baiviet']['Tieude'];  ?></h3>
        <?php
          // Hiển thị đoạn văn bản đến dấu chấm đen
          $noidung = $baiviet['baiviet']['Noidung'];
          $dot_position = strpos($noidung, '.');
          if ($dot_position !== false) {
              $first_part = substr($noidung, 0, $dot_position + 2); 
              $second_part = substr($noidung, $dot_position + 2); 
          } else {
              // Nếu không tìm thấy dấu chấm đen, hiển thị toàn bộ nội dung
              $first_part = $noidung;
              $second_part = '';
          }

          // Hiển thị phần đầu tiên (đoạn văn bản đến dấu chấm đen)
          //echo "<p>$first_part</p>";

          // Hiển thị hình ảnh
         // echo "<img src='{$baiviet['baiviet']['Hinhanh']}' alt='Hình ảnh bài báo'>";

          // Hiển thị phần tiếp theo của bài báo
         // echo "<p>$second_part</p>";
        ?>

          <p><?php echo $first_part  ?></p>
          
          <ul>
            <li><span>Tác giả: </span> <?php 
            if (isset($baiviet['taikhoan']) && is_array($baiviet['taikhoan'])) {
              foreach ($baiviet['taikhoan'] as $taikhoan) {
                echo $taikhoan['Hoten'];
              }
          }else {
            echo "Không truy cập được ngành học";
          }  ?></li>
            <li><span>Danh mục:</span> <a href="#"><?php

              if (isset($baiviet['nganhhoc']) && is_array($baiviet['nganhhoc'])) {
                foreach ($baiviet['nganhhoc'] as $nganhhoc) {
                  echo $nganhhoc['Tennganhhoc'];
                }
              }else {
              echo "Không truy cập được ngành học";
              }
              ?></a></li>
            
          </ul>
        </div>
        <div class="col-lg-12">
          <div class="sep"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="more-info">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="tabs-content">
            <div class="row">
              <div class="nav-wrapper ">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Nội dung</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Bình luận</button>
                  </li>
                </ul>
              </div>              
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <p><?php echo nl2br($baiviet['baiviet']['Noidung']); ?></p>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <?php
                  // Khởi tạo biến đếm
                  $soThuTu = 1;
                  // Kiểm tra xem có bình luận nào không và hiển thị chúng
                  if ($binhluan && $binhluan->num_rows > 0):
                    while ($row = $binhluan->fetch_assoc()):
                ?>
                  <div class="Binhluan">
                    <p><strong><?php echo $soThuTu; ?>: Bình luận của <?php echo htmlspecialchars($row['Tendangnhap']); ?>:</strong></p>
                    <p><?php echo htmlspecialchars($row['NoidungBL']); ?></p>
                    <p><small>Đánh giá vào ngày: <?php echo htmlspecialchars($row['Thoigian']); ?></small></p>
                  </div>
                <?php
                      $soThuTu++; // Tăng biến đếm sau mỗi bình luận
                    endwhile;
                  else:
                ?>
                  <p>Chưa có bình luận nào.</p>
                <?php endif; ?>

                <!-- Form để nhập bình luận mới -->
                <form action="#" method="POST"> 
                  <div class="form-group">
                    <label for="noidungBinhLuan">Nhập bình luận mới:</label>
                    <input type="text" class="form-control" id="noidungBinhLuan" name="noidungBinhLuan" placeholder="Nhập bình luận của bạn tại đây">
                  </div>
                  <input type="hidden" name="Idtaikhoan" value="<?php echo $Idtaikhoan; ?>">
                  <input type="hidden" name="Idbaiviet" value="<?php echo $Idbaiviet; ?>">
                  <button type="submit" class="btn btn-primary" name="btnSubmitBinhLuan">Gửi</button>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 