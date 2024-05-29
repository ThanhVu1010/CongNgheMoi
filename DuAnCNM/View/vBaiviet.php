<?php

include_once("Controller/cBaiviet.php");
include_once("Controller/cNganhhoc.php");
$p = new controlBaiviet();
$n = new controlNganh();

$nganhhoc = $n->getAllNganh();

if (isset($_GET['Idnganhhoc'])) {
    $baivietTheoNganh = $p->getBaivietbyIDnganh($_GET['Idnganhhoc']);
} else {
    $baiviet = $p->getBaiviet(); 
    $baivietTheoNganh = $baiviet; 
}



?>

<style>

.tab-list {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
    margin-bottom: 20px; /* Khoảng cách giữa danh mục và phần bài viết */
}

.tab-item {
    margin-right: 10px; /* Khoảng cách giữa các tab */
}

.tab-link {
    text-decoration: none;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    color: #333;
}

.tab-link.is_active {
    background-color: #007bff; /* Màu nền cho tab được chọn */
    color: #fff;
    border-color: #007bff;
}

.trending-box {
    margin-top: 20px; /* Khoảng cách giữa danh mục và phần bài viết */
}


</style>
<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Bài viết</h3>
                <span><a href="index.php">Trang chủ</a> <a href="?mod=baiviet"> > Bài viết</a></span>
            </div>
        </div>
    </div>
</div>


<div class="section trending">
    <div class="container">
        <div class="select-container">
            <select name="nganhhoc" onchange="handleSelectChange(this)">
                <option value="?mod=baiviet">Tất cả</option>
                <?php foreach ($nganhhoc as $nh): ?>
                    <option value="?mod=baiviet&Idnganhhoc=<?= htmlspecialchars($nh['Idnganhhoc']); ?>" <?= (isset($_GET['Idnganhhoc']) && $_GET['Idnganhhoc'] == $nh['Idnganhhoc']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($nh['Tennganhhoc']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row trending-box">
            <?php
            $count = 0;
            // Kiểm tra xem biến $baivietTheoNganh có tồn tại và không rỗng không
            if(isset($baivietTheoNganh) && !empty($baivietTheoNganh)) {
                foreach ($baivietTheoNganh as $bv) {
                    if ($count % 4 == 0) {
                        echo '<div class="row">';
                    }
            ?>
                    <div class="col-lg-3 col-md-6 align-self-center mb-30 trending-items col-md-6 adv">
                        <div class="item">
                            <a href="?mod=chitietBV&Idbaiviet=<?php echo $bv['Idbaiviet']; ?>">
                                <div class="thumb">
                                    <img src="assets/baiviet/<?php echo $bv['Hinhanh']; ?>" alt="">
                                </div>
                                <div class="down-content">
                                    <span class="category"><?php echo $bv['Tennganhhoc']; ?></span>    
                                    <h4><?php echo $bv['Tieude']; ?></h4>
                                </div>
                            </a>
                        </div>
                    </div>
            <?php
                    $count++;
                    // Đóng div .row sau mỗi 4 bài viết hoặc khi lặp qua tất cả các bài viết
                    if ($count % 4 == 0 || $count == count($bv)) {
                        echo '</div>';
                    }
                }
            } else {
                echo '<p>Không có bài viết nào cho ngành học này.</p>';
            }
            ?>
        </div>
    </div>
</div>


<script>
    function handleSelectChange(selectElement) {
        var value = selectElement.value;
        if (value === '?mod=baiviet') {
            window.location.href = value;
        } else {
             window.location.href = selectElement.value;
        }
    }
</script>