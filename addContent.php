<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ biểu mẫu

   $drinkName= $_POST['drinkNameADM'];
   $manu= $_POST['selectManu'];
    $cate=$_POST['selectCate'];
   $price= $_POST['drinkPriceADM'];
   $id= $_POST['drinkIDADM'];
   include "config.php";
   $sql1="SELECT * FROM `drink` WHERE drink_id='$id'";
   $stm = $pdh->query($sql1);
   $rows = $stm->fetchAll(PDO::FETCH_NUM);
   if(sizeof($rows)>0){
        echo "ID ĐÃ TỒN TẠI!";
   }else {
        if ($_FILES["inputFile"]["error"] > 0) {
            echo "Lỗi: " . $_FILES["inputFile"]["error"] ."Không nhận được file";
        } else {
            // Di chuyển tệp tin tạm lên máy chủ
            $targetDirectory = "img_product/"; // Thư mục lưu trữ tệp tin tải lên
            $url =  basename($_FILES["inputFile"]["name"]);
            $targetFile = $targetDirectory . basename($_FILES["inputFile"]["name"]);
          
            if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $targetFile)) {
                echo "Tệp tin đã được tải lên thành công.";
              
                $sql="INSERT INTO `drink`(`drink_id`, `drink_name`, `price`,  `img`, `manu_id`,`cat_id`) 
                VALUES ('$id','$drinkName','$price','$url','$manu','$cate')";
                $stm = $pdh->query($sql);

            } else {
                echo "Có lỗi khi tải lên tệp tin.";
            }
        }
   }





   


   //echo "$drinkName . $manu .  $price ,$id";
} else {
    echo "Lỗi kết nối đến server";
}
 




?>