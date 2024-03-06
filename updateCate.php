<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "config.php";
    $tensualoai= $_POST['updatecate'];
    $idloai= $_POST['suaLoai'];
    $sql ="UPDATE `category` SET `cat_name`='$tensualoai' WHERE cat_id='$idloai'";
    $stm = $pdh->query($sql);
    echo "Cập nhật thành công";
} else {
    echo " thất bại";
}
 

?>