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


?><div id="content" style="margin-left:240px;">
<section class="content-wrapper" style="padding: 20px;">
    <h1 class="text-center">Danh sách bài viết</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Bài viết</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="baivietTable">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Nội dung rút gọn</th>
                                <th>Hình ảnh</th>
                                <th>Ngày đăng</th>
                                <th>Tác giả</th>
                                <th>Thể loại</th>
                                <th>Hành động</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($baivietTheoNganh as $item) {
                                // Rút gọn nội dung
                                $noidungRutGon = strlen($item['Noidung']) > 100 ? substr($item['Noidung'], 0, 100) . "..." : $item['Noidung'];
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $item['Tieude']; ?></td>
                                <td><?php echo $noidungRutGon; ?></td>
                                <td><img src="assets/baiviet/<?php echo $item['Hinhanh']; ?>" alt="" style="width: 75px;"></td>
                                <td><?php echo $item['Ngaydang']; ?></td>
                                <td><?php echo $item['Hoten']; ?></td>
                                <td><?php echo $item['Tennganhhoc']; ?></td>
                                <td>
                                    <a href="admin.php?mod=ViewBaiviet&Idbaiviet=<?php echo $item['Idbaiviet']; ?>" class="btn btn-info">Xem</a>
                                    <a href="admin.php?mod=DeleteBaiViet&Idbaiviet=<?php echo $item['Idbaiviet']; ?>" 
                                    onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')" class="btn btn-danger">Xóa</a>
                                    <a href="admin.php?mod=UpdateBV&Idbaiviet=<?php echo $item['Idbaiviet']; ?>" class="btn btn-info">Sửa</a>
                                </td>
                               
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                   
                    <?php if (empty($baivietTheoNganh)) { ?>
                        <h5 class="text-center text-danger">Không có bài viết nào!</h5>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<script>
$(document).ready(function() {
$('#baivietTable').DataTable();
});
</script>

