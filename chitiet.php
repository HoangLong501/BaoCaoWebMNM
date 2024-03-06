
<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ biểu mẫu

   $chiTietForm= $_POST['chiTietForm'];
   include "config.php";
   $sql1="SELECT 
    drink.drink_id,
    drink.drink_name,
    drink.price,
    category.cat_id,
    category.cat_name,
    drink.img,
    manufacturer.manu_id,
    manufacturer.manu_name
FROM 
    drink
JOIN 
    category ON drink.cat_id = category.cat_id
JOIN 
    manufacturer ON drink.manu_id = manufacturer.manu_id where drink.drink_id='$chiTietForm'";
   $stm = $pdh->query($sql1);
   $rows = $stm->fetchAll(PDO::FETCH_NUM);
   foreach($rows as $row)
        {
            echo "Drink ID ".$row[0]."\n" ;
            echo "Drink Name ".$row[1]."\n" ;
            echo "Drink price ".$row[2]."\n" ;
            echo "Drink Loai ".$row[4]."\n" ;
            echo "Drink NSX ".$row[7] ;

        }





   


   //echo "$drinkName . $manu .  $price ,$id";
} else {
    echo "Lỗi kết nối đến server";
}
 




?>