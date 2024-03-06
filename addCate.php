<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "config.php";
    $maloai= $_POST['maloai'];
    $tenloai= $_POST['tenloai'];
    $sql ="INSERT INTO `category`(`cat_id`, `cat_name`) VALUES ('$maloai','$tenloai') ON DUPLICATE KEY UPDATE `cat_name` ='$tenloai';";
    $stm = $pdh->query($sql);
    echo "Thêm thành công";
} else {
    echo "Thêm thất bại";
}
 

?>