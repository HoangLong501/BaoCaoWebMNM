<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ biểu mẫu

    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id=$_SESSION['user_id'];
        $drinkID = $_POST["drinkID"];
        // Xử lý dữ liệu (ví dụ: có thể lưu vào giỏ hàng hoặc cơ sở dữ liệu)
        // Ví dụ: Lưu vào session giỏ hàng
        include "config.php";
        $sql1="SELECT * FROM `order_product` WHERE user_id='$user_id'";
        $stm = $pdh->query($sql1);
        $rows = $stm->fetchAll(PDO::FETCH_NUM);
        $orderArr=$rows[0][0];
        $stm->closeCursor();
        if ($orderArr) {
            // Nếu đã có order_detail, cập nhật quantity
            $sql = "INSERT INTO `order_detail` (`order_id`, `drink_id`, `quantity`)
            VALUES ('$orderArr', '$drinkID', 1)
            ON DUPLICATE KEY UPDATE `quantity` = `quantity` + 1;";
            $stm2 = $pdh->query($sql);
            echo "Cập nhật thành công";
        } else {    
           
            
        }
     }else {
        //echo "Vui lòng đăng nhập!";
        echo "Cập nhật thành công";
     }

} else {
    echo "Lỗi kết nối đến server";
}
 
?>