<?php
include_once("Controller/cAdmin.php");
$p = new controlAdmin();

if(isset($_GET['Idchatbot'])) {
    $idchatbot = $_GET['Idchatbot'];
    
    // Fetch the chatbot data
    $result = $p->getChatbotById($idchatbot);  // Assuming you have a method like this

    if (!$result) {
        echo "Không tìm thấy dữ liệu chatbot cần sửa";
        exit;
    }

    if (isset($_POST["btn"])) {
        $cauhoi = $_POST["Cauhoi"];
        $cautraloi = $_POST["Cautraloi"];

        // You need to pass the updated data to the update function
        $updateResult = $p->UpdateChatbot($idchatbot, $cauhoi, $cautraloi);

        if ($updateResult == 1) {
            echo '<script>alert("Cập nhật dữ liệu chatbot thành công")</script>';
            echo '<script>location.href="admin.php?mod=ListBV";</script>';
            exit;
        } else {
            echo '<script>alert("Không thể cập nhật dữ liệu chatbot")</script>';
        }
    }
} else {
    echo "Không có ID bài viết được cung cấp.";
    exit;
}

?>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

#content {
    margin-left: 240px;
    background: #ffffff;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.container-fluid {
    max-width: 960px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.upload {
    position: relative;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
}

h3 {
    text-align: center;
    color: #4a4a4a;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 8px;
    margin-top: 6px;
    margin-bottom: 16px;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"],
input[type="reset"] {
    font-size: 16px;
    color: white;
    background-color: #007bff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    float: right;
    margin-right: 10px;
}

input[type="reset"] {
    background-color: #f44336;
}

input[type="submit"]:hover,
input[type="reset"]:hover {
    opacity: 0.9;
}

.text-danger {
    color: #ff0000;
}

label {
    font-weight: bold;
}
</style>

<!-- Phần giao diện HTML -->
<div id="content" style="margin-left:240px;">
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
        <div class="container-fluid px-4 add mt-3">
            <div class="upload p-3" style="position: relative;">
                <h3 class="mb-5">Sửa dữ liệu chatbot</h3>
                <table class="admin_upload">
                    <form action="" enctype="multipart/form-data" method="post">
                        <tr>
                            <th>Câu hỏi:</th>
                            <th><input type="text" name="Cauhoi" placeholder="Nhập câu hỏi"
                                    value="<?php echo htmlspecialchars($result['Cauhoi']); ?>"></th>
                        </tr>
                        <tr>
                            <th>Câu trả lời:</th>
                            <th><textarea name="Cautraloi" rows="5"
                                    placeholder="Nhập câu trả lời"><?php echo htmlspecialchars($result['Cautraloi']); ?></textarea>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="Cập nhật" id="submit" name="btn">
                                <input type="reset" value="Hủy" id="reset" name="btn">
                            </td>
                        </tr>
                    </form>

                </table>
            </div>
        </div>
    </section>
</div>