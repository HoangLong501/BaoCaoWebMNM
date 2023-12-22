<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ biểu mẫu
    $removeID = $_POST["removeID"];
    // Xử lý dữ liệu (ví dụ: có thể lưu vào giỏ hàng hoặc cơ sở dữ liệu)
    // Ví dụ: Lưu vào session giỏ hàng
   
    include "config.php";
    $sql1="select drink_id from order_detail WHERE drink_id=$removeID";
    $stm = $pdh->query($sql1);
    $rows = $stm->fetchAll(PDO::FETCH_NUM);
    if(sizeof($rows)>0){
        $sql ="DELETE FROM `order_detail` WHERE drink_id=$removeID";
        $stm = $pdh->query($sql);
        echo "Xóa thành công";
    }else{
        echo "Xóa thất bại";
    }
    // Phản hồi về trang gửi yêu cầu Ajax
} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include "config.php";
   $updateID = $_GET['updateID'];
    $updateQuantity=$_GET['updateQuantity'];
    $sql1="UPDATE `order_detail` SET `quantity`='$updateQuantity' WHERE drink_id='$updateID'";
    $stm = $pdh->query($sql1);
    echo "Cập nhật thành công";
}else "Lỗi truy cập server";
?>