<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "config.php";
    $maloai= $_POST['mansx'];
    $tenloai= $_POST['tennsx'];
    $sql ="INSERT INTO `manufacturer`(`manu_id`, `manu_name`) VALUES ('$maloai','$tenloai')";
    $stm = $pdh->query($sql);
    echo "Thêm thành công Manu";
} else {
    echo "Thêm thất bại";
}
 

?>