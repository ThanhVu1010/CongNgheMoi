<?php
include_once('Controller/cBuoiTV.php');
include_once("Controller/cNganhhoc.php");

$n = new controlNganh();
$nganhhoc = $n->getAllNganh();

$p = new controlBuoiTV();

// Kiểm tra xem có tham số Idnganhhoc trong URL không và nó có phải là số không
if(isset($_GET['Idnganhhoc']) && is_numeric($_GET['Idnganhhoc'])) {
    $Idnganhhoc = $_GET['Idnganhhoc'];
    // Gọi phương thức lấy tất cả buổi tư vấn theo ID ngành học
    $buoitv = $p->getBuoiTVByNganhHoc($Idnganhhoc);
} else {
    // Nếu không có tham số Idnganhhoc hoặc không phải là số, lấy tất cả buổi tư vấn
    $buoitv = $p->getAllBuoiTV();
}


function tinhThoiGianConLai($ngayMoDangKy, $ngayDienRa)
{
    $ngayMoDangKy = strtotime($ngayMoDangKy);
    $ngayDienRa = strtotime($ngayDienRa);

    // Tính số giây còn lại (tính từ bây giờ đến trước ngày diễn ra 2 ngày)
    $hienTai = time();
    $thoiGianKetThucDangKy = $ngayDienRa - (2 * 24 * 60 * 60); // Subtract 2 days in seconds
    $thoiGianConLai = $thoiGianKetThucDangKy - $hienTai;
    return $thoiGianConLai > 0 ? $thoiGianConLai : 0; // Ensure we don't return negative time
    
}



?>

<style>
.tab-list {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
    margin-bottom: 20px;
    /* Khoảng cách giữa danh mục và phần bài viết */
}

.tab-item {
    margin-right: 10px;
    /* Khoảng cách giữa các tab */
}

.tab-link {
    text-decoration: none;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: #333;
}

.tab-link.is_active {
    background-color: #007bff;
    /* Màu nền cho tab được chọn */
    color: #fff;
    border-color: #007bff;
}

.trending-box {
    margin-top: 20px;
    /* Khoảng cách giữa danh mục và phần bài viết */
}
</style>


<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Bài viết</h3>
                <span><a href="index.php">Trang chủ</a> <a href="?mod=buoitv"> > Buổi tư vấn</a></span>
            </div>

        </div>
    </div>
</div>
<div class="section trending">
    <div class="container">
        <div class="select-container">
            <select name="nganhhoc" onchange="handleSelectChange(this)">
                <option value="?mod=buoitv">Tất cả</option>
                <?php foreach ($nganhhoc as $nh): ?>
                <option value="?mod=buoitv&Idnganhhoc=<?= htmlspecialchars($nh['Idnganhhoc']); ?>"
                    <?= (isset($_GET['Idnganhhoc']) && $_GET['Idnganhhoc'] == $nh['Idnganhhoc']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($nh['Tennganhhoc']); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <script>
        function handleSelectChange(selectElement) {
            var value = selectElement.value;
            if (value === '?mod=buoitv') {
                window.location.href = value;
            } else {
                window.location.href = selectElement.value;
            }
        }
        </script>


        <div class="row trending-box">
            <?php
            $count = 0;
            if (isset($buoitv) && !empty($buoitv)) {
                foreach ($buoitv as $btv) {
                    $thoiGianConLai = tinhThoiGianConLai($btv['Thoigiandangky'], $btv['Thoigian']);
                    // Điều kiện để đóng div .row mở ở cuối vòng lặp
                    $closeRow = false;
            ?>
            <div class="col-lg-3 col-md-6 align-self-center mb-30 trending-items col-md-6 adv">
                <div class="item">
                    <?php if ($thoiGianConLai > 0): ?>
                    <a href="?mod=chitietBTV&Idbuoituvan=<?php echo htmlspecialchars($btv['Idbuoituvan']); ?>">
                        <?php endif; ?>
                        <div class="thumb">
                            <img src="assets/buoituvan/<?php echo htmlspecialchars($btv['Hinh']); ?>" alt="">
                        </div>
                        <div class="down-content">
                            <span>Ngành học:
                                <?php echo isset($btv['Tennganhhocs']) ? htmlspecialchars($btv['Tennganhhocs']) : "Không xác định"; ?></span>
                            <h4><?php echo htmlspecialchars($btv['Tenbuoituvan']); ?></h4>

                            <span style="padding-left: 25px;">Thời gian đăng ký còn lại:
                                <?php echo $thoiGianConLai > 0 ? gmdate("H:i:s", $thoiGianConLai) : "Đã quá hạn đăng ký"; ?></span>
                        </div>
                        <?php if ($thoiGianConLai > 0): ?>
                    </a>
                    <span style="padding-left: 25px;">Số lượng tham gia:
                        <?php echo htmlspecialchars($btv['SoluongThamgia']); ?></span><br>
                    <span style="padding-left: 25px;">Số lượng đã đăng ký:
                        <?php echo htmlspecialchars($btv['Sluongdangky']); ?></span><br>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                    if ($count % 4 == 3) { // Đóng div row sau mỗi 4 items
                        echo '</div><div class="row">';
                        $closeRow = true;
                    }
                    $count++;
                }
                if (!$closeRow) {
                    echo '</div>'; // Đóng div row nếu chưa đóng
                }
            } else {
                echo '<p>Không có buổi tư vấn nào cho ngành học này.</p>';
            }
            ?>
        </div>
    </div>
</div>


<script>
// Function to update a single countdown timer
function updateCountdown(countdownElement, secondsLeft) {
    // Calculate days, hours, minutes left
    var days = Math.floor(secondsLeft / (3600 * 24));
    var hours = Math.floor((secondsLeft % (3600 * 24)) / 3600);
    var minutes = Math.floor((secondsLeft % 3600) / 60);

    // Format the countdown string
    var countdownTime = "";
    if (days > 0) countdownTime += days + " ngày ";
    if (hours > 0) countdownTime += hours + " giờ ";
    if (minutes > 0) countdownTime += minutes + " phút";

    // Set the countdown string
    countdownElement.textContent = countdownTime;

    // Update the countdown every second if time is left
    if (secondsLeft > 0) {
        setTimeout(function() {
            updateCountdown(countdownElement, secondsLeft - 1);
        }, 1000);
    }
}

// Start the countdown timer for all elements with class 'countdown-timer'
function startCountdown() {
    var countdownElements = document.getElementsByClassName('countdown-timer');

    // Loop through all countdown elements
    for (var i = 0; i < countdownElements.length; i++) {
        (function() {
            var countdownElement = countdownElements[i];
            var endTime = parseInt(countdownElement.getAttribute('data-end-time'));

            // Calculate seconds left based on current time and end time
            var secondsLeft = Math.ceil(endTime / 1000);
            updateCountdown(countdownElement, secondsLeft);
        })(); // Immediately Invoked Function Expression (IIFE) for proper closure scope
    }
}

// Initialize the countdown when the window loads
window.onload = startCountdown;
</script>