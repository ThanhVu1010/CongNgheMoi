<style>
    .gioithieu-container {
        display: flex;
        justify-content: center; /* Canh giữa nội dung theo chiều ngang */
        align-items: center; /* Canh đều nội dung theo chiều dọc */
        flex-wrap: wrap; /* Cho phép các phần tử chồng lên nhau khi không đủ không gian */
    }

    .member {
        width: 400px;
        text-align: center;
        margin: 100px; /* Khoảng cách giữa các thành viên */
    }

    .introduction {
        width: 1000px;
        text-align: center;
        margin: 40px auto; /* Đưa introduction vào giữa và giảm margin top */
    }

    .introduction p {
        font-size: 20px; 
    }
    
    .gioithieumember {
        width: 400px;
        text-align: center;
        margin: 20px auto; 
        font-weight: bold; 
    }

    .gioithieumember p {
        font-size: 20px;
        color: #007bff; 
    }

    .member img {
        width: 300px;
    }
</style>

<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Giới thiệu</h3>
                <span><a href="index.php">Trang chủ</a> <a href="?mod=gioithieu"> > Giới thiệu</a></span>
            </div>
        </div>
    </div>
</div>

<div class="introduction">
    <p>Việc lựa chọn ngành học phù hợp là một quyết định quan trọng ảnh hưởng đến tương lai của mỗi học sinh. Tuy nhiên, nhiều học sinh gặp khó khăn trong việc tìm kiếm thông tin và lựa chọn ngành học phù hợp với bản thân.
Chatbot là công nghệ trí tuệ nhân tạo có khả năng giao tiếp với con người một cách tự nhiên. Chatbot có thể được ứng dụng vào hệ thống tư vấn ngành học để hỗ trợ học sinh trong việc lựa chọn ngành học phù hợp.
</p>
</div>
<div class="gioithieumember">
    <p>Các thành viên tham gia</p>
</div>
<div class="gioithieu-container">
    <div class="member">
        <img src="assets/image/dreamspark.png" alt="Thành viên 1">
        <h2>Nguyễn Thanh Vũ</h2>
        <p>20010591</p>
    </div>
    <div class="member">
        <img src="assets/image/dreamspark.png" alt="Thành viên 2">
        <h2>Phạm Vĩnh Phúc</h2>
        <p>20005661</p>
    </div>
</div>
