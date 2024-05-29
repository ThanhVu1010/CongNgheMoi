<?php
include_once("Controller/cBuoiTV.php");
$p = new controlBuoiTV();

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Kiểm tra và xử lý khi form được submit
if (isset($_POST['btnSubmit'])) {
  // Lấy ID buổi tư vấn từ URL
  $idbtv = isset($_GET['Idbuoituvan']) ? $_GET['Idbuoituvan'] : 0;

  if (isset($_SESSION['is_login']) && $_SESSION['is_login']['Idtaikhoan']) {
    $Idtaikhoan = $_SESSION['is_login']['Idtaikhoan'];
    $noidungcauhoi = isset($_POST['cauHoiMoi']) ? htmlspecialchars($_POST['cauHoiMoi']) : '';

    // Thêm câu hỏi mới vào cơ sở dữ liệu
    $result = $p->Insertcauhoi($noidungcauhoi, $Idtaikhoan, $idbtv);
    if ($result) {
      echo '<script>alert("Câu hỏi đã được thêm thành công.")</script>';
    } else {
      echo '<script>alert("Có lỗi xảy ra khi thêm câu hỏi. Vui lòng thử lại.")</script>';
    }
  } else {
    echo '<script>alert("Vui lòng đăng nhập để gửi câu hỏi.")</script>';
    echo header("refresh: 0; url='index.php?mod=login'");
  }
}

// Tiếp tục với phần hiển thị thông tin buổi tư vấn và câu hỏi
if (isset($_GET['Idbuoituvan'])) {
  $idbtv = $_GET['Idbuoituvan'];
  $buoitv = $p->getShowchitietBTV($idbtv);

  if (!$buoitv) {
    echo "Không có buổi tư vấn nào được tìm thấy với ID này.";
    exit;
  }
} else {
  echo "Không có ID buổi tư vấn được cung cấp.";
  exit;
}

$cauhoitv = $p->getCauhoi();
?>



<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 style='color: white;'>Buổi tư vấn</h2>

      </div>
    </div>
  </div>
</div>

<div class="single-product section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="left-image">
          <img src="assets/buoituvan/<?php echo $buoitv['buoituvan']['Hinh']; ?>" alt="">
        </div>
      </div>
      <div class="col-lg-6 align-self-center">
        <h3><?php echo $buoitv['buoituvan']['Tenbuoituvan'];  ?></h3>
        <ul>
          <li><span>Thời gian diễn ra: </span><?php echo $buoitv['buoituvan']['Thoigian']; ?></li>
          <li><span>Thời gian đăng ký:</span> <?php echo $buoitv['buoituvan']['Thoigiandangky']; ?></li>
          <li><span>Số lượng tham gia: </span><?php echo $buoitv['buoituvan']['SoluongThamgia']; ?></li>
          <li><span>Số lượng đã đăng ký:</span> <?php echo $buoitv['buoituvan']['Sluongdangky']; ?></li>
          <li><span>Hình thức: </span><?php echo $buoitv['buoituvan']['Hinhthuc']; ?></li>
          <li><span>Địa điểm:</span> <?php echo $buoitv['buoituvan']['Diadiem']; ?></li>
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
                  <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Đặt câu hỏi</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Đánh giá</button>
                </li>
              </ul>
            </div>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <h3>Danh sách câu hỏi: </h3>
                <?php
                // Khởi tạo biến đếm
                $soThuTu = 1;

                // Lặp qua kết quả truy vấn, sử dụng một vòng lặp while để xử lý mỗi hàng
                while ($row = $cauhoitv->fetch_assoc()) {
                  // Hiển thị số thứ tự và nội dung câu hỏi
                  echo "<p>Câu " . $soThuTu . ": " . $row['Noidungcauhoi'] . "</p>";

                  // Tăng số thứ tự lên sau mỗi lần lặp
                  $soThuTu++;
                }
                ?>

                <!-- Form để nhập câu hỏi mới -->
                <form action="#" method="POST">
                  <div class="form-group">
                    <label for="cauHoiMoi">Nhập câu hỏi mới:</label>
                    <input type="text" class="form-control" id="cauHoiMoi" name="cauHoiMoi" placeholder="Nhập câu hỏi của bạn tại đây">
                  </div>
                  <button type="submit" class="btn btn-primary" name="btnSubmit">Gửi câu hỏi</button>
                </form>

              </div>

              <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>