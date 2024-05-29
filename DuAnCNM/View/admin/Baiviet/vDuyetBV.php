<?php
include_once("Controller/cBaiviet.php");
include_once("Controller/cNganhhoc.php");
$p = new controlBaiviet();
$n = new controlNganh();

$nganhhoc = $n->getAllNganh();

if (isset($_GET['Idnganhhoc'])) {
    $baivietTheoNganh = $p->getBaivietbyIDnganh($_GET['Idnganhhoc']);
} else {
    $baiviet = $p->getBaivietbyTrangthai(); 
    $baivietTheoNganh = $baiviet; 
}



?>

<div id="content" style="margin-left:240px;">

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
                <form method="post" action="">
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
                                <th>Duyệt bài viết</th>

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
                                </td>
                                <td>
                                    <input type="checkbox" name="duyet[<?php echo $item['Idbaiviet']; ?>]" />
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <input type="submit" name="btn_duyet" value="Duyệt các bài đã chọn" />
                </form>
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

<?php
// KIỂM TRA NẾU ĐÃ NHẤN NÚT DUYỆT VÀ DUYỆT MẢNG KHÔNG RỖNG
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_duyet']) && !empty($_POST['duyet'])) {
    $idsToApprove = array_keys($_POST['duyet']); // Lấy ID của các bài viết cần duyệt
  
    foreach ($idsToApprove as $idbaiviet) {
        $p->DuyetBaiViet([$idbaiviet]); // Gửi một mảng chứa ID tới phương thức DuyetBaiViet
    }

    header("Location: admin.php?mod=Approve");
    exit();
}
?>
