<?php
include_once ("Controller/cBaiviet.php");

$p = new controlBaiviet();



if (isset($_GET['Idbaiviet'])) {
  $idbv = $_GET['Idbaiviet'];
  $baiviet = $p->getShowchitiet($idbv);
  
  if (!$baiviet) {
      echo "Không có bài viết nào được tìm thấy với ID này.";
      exit; // Stop execution if no menu item is found
  }
} else {
  echo "Không có ID bài viết được cung cấp.";
  exit; // Stop execution if no ID is provided
}

?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        color: #333;
    }

    .single-product {
        background: #ffffff;
        margin-top: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 5px;
        overflow: hidden;
        padding: 20px;
    }

    .single-product .left-image {
        text-align: center;
    }

    .single-product .left-image img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
    }

    .single-product h3 {
        font-size: 24px;
        color: #333;
        margin-top: 0;
    }

    .single-product ul {
        list-style: none;
        padding: 0;
    }

    .single-product ul li {
        padding: 5px 0;
    }

    .single-product ul li span {
        font-weight: bold;
    }

    .single-product a {
        color: #007bff;
        text-decoration: none;
    }

    .single-product a:hover {
        text-decoration: underline;
    }

    .more-info {
        padding-top: 20px;
    }

    .more-info .tabs-content {
        background: #ffffff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .more-info p {
        white-space: pre-wrap; /* Maintains whitespace formatting from nl2br() */
        font-size: 16px;
        line-height: 1.6;
    }

    .sep {
        height: 1px;
        background-color: #ccc;
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>


<div class="single-product section" style="padding-left: 250px; padding-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-image">
                    <img src="assets/baiviet/<?php echo $baiviet['baiviet']['Hinhanh'] ?>" style="width: 300px;" alt="">
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <h3><?php echo $baiviet['baiviet']['Tieude'];  ?></h3>
                <ul>
                    <li><span>Tác giả: </span> <?php 
            if (isset($baiviet['taikhoan']) && is_array($baiviet['taikhoan'])) {
              foreach ($baiviet['taikhoan'] as $taikhoan) {
                echo $taikhoan['Hoten'];
              }
          }else {
            echo "Không truy cập được ngành học";
          }  ?></li>
                    <li><span>Danh mục:</span> <a href="#"><?php

              if (isset($baiviet['nganhhoc']) && is_array($baiviet['nganhhoc'])) {
                foreach ($baiviet['nganhhoc'] as $nganhhoc) {
                  echo $nganhhoc['Tennganhhoc'];
                }
              }else {
              echo "Không truy cập được ngành học";
              }
              ?></a></li>

                </ul>
            </div>
            <div class="col-lg-12">
                <div class="sep"></div>
            </div>
        </div>
    </div>
</div>

<div class="more-info" style="padding-left: 250px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-content">
                    <div class="row">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <p><?php echo nl2br($baiviet['baiviet']['Noidung']); ?></p>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



