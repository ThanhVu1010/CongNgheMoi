<?php
include_once('Controller/cAdmin.php');
$p = new controlAdmin();
$dsStaff = $p->getStaff();
?>


<div id="content" style="margin-left:240px;">
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
        <h1 style="padding-left: 400px; ">Danh sách người dùng</h1>
        <nav>
            <ol class="breadcrumb">

                <li class="breadcrumb-item">Chuyên viên</li>

            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quản lý</h5>
                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($dsStaff)) {
                                    foreach ($dsStaff as $item) { ?>
                                <tr>
                                    <th><?php echo  $i++ ?></th>

                                    <td>
                                        <?php
                                        // Đường dẫn tới thư mục chứa hình ảnh
                                        $imagePath = "assets/image/" . $item['HinhAnh'];
                                        
                                        // Kiểm tra xem hình ảnh có tồn tại không
                                        if (isset($item['HinhAnh']) && !empty($item['HinhAnh']) && file_exists($imagePath)): ?>
                                        <img src="<?php echo $imagePath; ?>" class="rounded-circle"
                                            style="width: 35px; height: 35px;">
                                        <?php else: ?>
                                        <!-- Hiển thị một hình ảnh mặc định nếu không có hình ảnh nào được cung cấp hoặc không tìm thấy hình ảnh -->
                                        <img src="assets/image/user.jpg" class="rounded-circle"
                                            style="width: 35px; height: 35px;">
                                        <?php endif; ?>
                                        <?php echo $item['Hoten']; ?>
                                    </td>

                                    <td><?php echo $item['SDT'] ?></td>
                                    <td><?php echo $item['Diachi'] ?></td>
                                    <td><?php echo $item['Gmail'] ?></td>
                                    <td>
                                        <button class="btn btn-secondary"><a style="color: #fff;"
                                                href="admin.php?mod=DeleteUser&Idtaikhoan=<?php echo $item['Idtaikhoan'] ?>"
                                                onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')">Xóa</a></button>
                                        <button class="btn btn-secondary"><a
                                                href="admin.php?mod=UpdateUser&po=Cus&Idtaikhoan=<?php echo $item['Idtaikhoan'] ?>"
                                                style="color: #fff;">Sửa</a></button>
                                    </td>
                                </tr>
                                <?php }
                                } else {
                                    ?>

                            </tbody>
                        </table>
                        <h5 class="text-center  text-danger">Không có tài khoản nào !</h5>
                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>