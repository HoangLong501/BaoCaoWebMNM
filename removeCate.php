<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ biểu mẫu
    $removeID = $_POST["xoaLoai"];
    // // Xử lý dữ liệu (ví dụ: có thể lưu vào giỏ hàng hoặc cơ sở dữ liệu)
    // // Ví dụ: Lưu vào session giỏ hàng
   
    include "config.php";
    $sql1="select cat_id from drink WHERE cat_id='$removeID'";
    $stm = $pdh->query($sql1);
    $rows = $stm->fetchAll(PDO::FETCH_NUM);
    if(sizeof($rows)>0){
        echo "Xóa thất bại !";
    }else{
        $sql ="DELETE FROM `category` WHERE cat_id='$removeID'";
        $stm = $pdh->query($sql);
        echo "Xóa thành công";
    }
    // Phản hồi về trang gửi yêu cầu Ajax
   
} else {
    echo "Lỗi truy cập server";
}
?>