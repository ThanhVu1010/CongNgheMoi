<?php
include_once("Controller/cBaiviet.php");

include_once("Controller/cNganhhoc.php");

$p = new controlBaiviet();

$n = new controlNganh();
$nganh = $n->getAllNganh();
$baiviet = $p->getAllBaiviet();

?>


<div class="main-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="caption header-text">
                    <h6>Welcome to DreamSpark</h6>
                    <h2>DreamSpark - Nơi khám phá bản lĩnh, chinh phục tương lai!</h2>
                    <p>Tự hào cùng bạn chinh phục đỉnh cao với DreamSpark - Nơi tư vấn tuyển sinh hàng đầu!</p>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="right-image">
                    <img src="assets/image/Hinhnen3.jpg" alt="">

                </div>
            </div>
        </div>
    </div>
</div>



<div class="section trending">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Bài viết</h2>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="main-button">
                    <a href="?mod=baiviet">View All</a>
                </div>

            </div>

            <div class="row">
                <?php
        $count = 0;
        foreach ($baiviet as $bv) {
          if ($count >= 4) {
            break;
          }
        ?>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <a href="?mod=chitietBV&Idbaiviet=<?php echo $bv['Idbaiviet'] ?>">
                            <div class="thumb">

                                <img src="assets/baiviet/<?php echo $bv['Hinhanh'] ?>" alt="">

                            </div>
                            <div class="down-content">
                                <h4><?php echo $bv['Tieude']; ?></h4>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
          $count++;
        }
        ?>
            </div>
        </div>
    </div>
</div>


<div class="section categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-heading">
                    <h2>Các ngành phổ biến hiện tại</h2>
                </div>
            </div>
            <div class="row">
                <div class="horizontal-scroll">
                    <?php
          foreach ($nganh as $n) {
          ?>
                    <div class="category-item">
                        <a href="?mod=baiviet">
                            <h4><?php echo $n['Tennganhhoc']; ?></h4>
                            <div class="thumb">
                                <img src="assets/nganhhoc/<?php echo $n['hinhanh'] ?>" alt="">
                            </div>
                        </a>
                    </div>
                    <?php
          }
          ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
window.onload = function() {
    var scrollContainer = document.querySelector('.horizontal-scroll');

    function autoScroll() {
        if (scrollContainer.scrollLeft < (scrollContainer.scrollWidth - scrollContainer.clientWidth)) {
            scrollContainer.scrollLeft += 1;
        } else {
            scrollContainer.scrollLeft = 0; // Reset scroll position to start when it reaches the end
        }
    }
    var scrollInterval = setInterval(autoScroll, 20); // Adjust speed by changing the interval

    // Optional: Clear interval on mouse over to pause the auto scroll
    scrollContainer.addEventListener('mouseover', function() {
        clearInterval(scrollInterval);
    });

    // Optional: Resume scroll on mouse out
    scrollContainer.addEventListener('mouseout', function() {
        scrollInterval = setInterval(autoScroll, 20);
    });
};
</script>

<style>
.horizontal-scroll {
    display: flex;
    overflow-x: auto;
    gap: 20px;
    /* Spacing between items */
    padding: 20px 0;
    align-items: center;
    /* Aligns items vertically */
    -ms-overflow-style: none;
    /* Hides scrollbar for IE and Edge */
    scrollbar-width: none;
    /* Hides scrollbar for Firefox */
}

.horizontal-scroll::-webkit-scrollbar {
    display: none;
    /* Hides scrollbar for Chrome, Safari, and Opera */
}

.horizontal-scroll .category-item {
    width: 200px;
    /* Ensures uniform width */
    height: 150px;
    /* Ensures uniform height */
    flex-shrink: 0;
    text-align: center;
    background-color: #007BFF;
    color: white;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    /* Center content vertically */
}

.horizontal-scroll .thumb img {
    max-height: 100px;
    object-fit: cover;
    width: 100%;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
</style>