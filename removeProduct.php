<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ biểu mẫu
    $removeID = $_POST["drinkID"];
    // // Xử lý dữ liệu (ví dụ: có thể lưu vào giỏ hàng hoặc cơ sở dữ liệu)
    // // Ví dụ: Lưu vào session giỏ hàng
   
    include "config.php";
    
        $sql ="DELETE FROM `drink` WHERE drink_id='$removeID'";
        $stm = $pdh->query($sql);
        echo "Xóa thành công";
    
   
} else {
    echo "Lỗi truy cập server";
}
?>