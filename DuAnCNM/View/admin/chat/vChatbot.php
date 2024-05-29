<?php

include_once("Controller/cAdmin.php");

$p = new controlAdmin();


$chatbot = $p->Viewchatbot();
?>

<div id="content" style="margin-left:240px;">
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
        <h1 style="padding-left: 400px; ">Dữ liệu chatbot</h1>

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Quản lý</h5>
                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Câu hỏi</th>
                                    <th>Câu trả lời</th>
                                    <th>Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty($chatbot)) {
                                    foreach ($chatbot as $item) { ?>
                                <tr>
                                    <th><?php echo  $i++ ?></th>
                                    <td><?php echo $item['Cauhoi'] ?></td>
                                    <td><?php echo $item['Cautraloi'] ?></td>

                                    <td>
                                        <button class="btn btn-secondary">
                                            <a style="color: #fff;"
                                                href="admin.php?mod=DeleteChatbot&Idchatbot=<?php echo $item['Idchatbot']; ?>"
                                                onclick="return confirm('Bạn chắc chắn muốn xóa chứ!');">Xóa</a>
                                        </button>
                                        <button class="btn btn-secondary">
                                            <a href="admin.php?mod=UpdateChatbot&Idchatbot=<?php echo $item['Idchatbot']; ?>"
                                                style="color: #fff;">Sửa</a>
                                        </button>
                                    </td>
                                </tr>
                                <?php }
                                } else {
                                    ?>

                            </tbody>
                        </table>
                        <h5 class="text-center  text-danger">Không có dữ liệu nào !</h5>
                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>