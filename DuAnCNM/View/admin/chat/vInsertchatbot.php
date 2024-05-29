<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Chatbot Data</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Ensures the font is pleasant and readable */
            background-color: #f4f4f4; /* Light grey background */
            margin: 0;
            padding: 0;
        }

        #content {
            margin-left: 240px;
            padding: 20px;
            background-color: #fff; /* White background for the content */
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Adds shadow for depth */
        }

        .content-wrapper {
            width: 100%;
            padding: 20px;
        }

        .container-fluid {
            max-width: 800px; /* Limits the width of the form for better aesthetics */
            margin: auto; /* Centers the container */
            padding: 20px;
            background-color: #ffffff; /* White background for the container */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0,0,0,0.2); /* Subtle shadow for 3D effect */
        }

        .upload {
            position: relative;
            padding: 20px;
        }

        h3 {
            color: #333; /* Dark grey color for headings */
            text-align: center; /* Center aligns the heading */
        }

        table {
            width: 100%; /* Full width tables look better in forms */
            border-collapse: collapse; /* Ensures the borders are collapsed into a single border */
        }

        th, td {
            text-align: left;
            padding: 8px; /* Adds space around text in cells */
        }

        input[type="text"],
        textarea {
            width: 100%; /* Full width inputs */
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc; /* Light grey border */
            border-radius: 4px; /* Rounded borders for the inputs */
        }

        input[type="submit"], input[type="reset"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #5c67f2; /* A nice shade of blue */
            color: white;
            cursor: pointer;
            margin-right: 10px;
        }

        input[type="reset"] {
            background-color: #f44336; /* Red color for reset to make it stand out as a secondary action */
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            opacity: 0.9; /* Slight fade effect on hover */
        }
    </style>
</head>
<body>
    <div id="content">
        <section class="content-wrapper">
            <div class="container-fluid px-4 add mt-3">
                <div class="upload p-3" style="position: relative;">
                    <h3 class="mb-5">Thêm dữ liệu vào Chatbot</h3>
                    <table class="admin_upload">
                        <form action="" enctype="multipart/form-data" method="post">
                            <tr>
                                <th>Câu hỏi:</th>
                                <th><input type="text" name="Cauhoi" placeholder="Nhập câu hỏi"></th>
                            </tr>
                            <tr>
                                <th>Câu trả lời:</th>
                                <th><textarea name="Cautraloi" rows="5" placeholder="Nhập câu trả lời"></textarea></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" value="Thêm" id="submit" name="btn">
                                    <input type="reset" value="Hủy" id="reset" name="btn">
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </section>
    </div>


<?php
include_once("Controller/cAdmin.php");

$p = new controlAdmin();

if (isset($_REQUEST["btn"])) {
    if (empty($error)) {
        // Retrieve and sanitize form data
        $question = $_REQUEST["Cauhoi"];
        $answer = $_REQUEST["Cautraloi"];
       
        $kq = $p->InsertChatbot($question, $answer);
        
        // Handle the results
        if ($kq == 1) {
            echo '<script>alert("Thêm dữ liệu vào Chatbot thành công")</script>';
        } elseif ($kq == 0) {
            echo '<script>alert("Không thể thêm dữ liệu cho chatbot")</script>';
        }else {
            echo "Lỗi";
        }
    }
}
?>

</body>

</html>