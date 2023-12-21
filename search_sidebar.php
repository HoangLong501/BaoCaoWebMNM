<?php
    // Kiểm tra xem có dữ liệu được gửi từ biểu mẫu không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ biểu mẫu
    $drinkName = $_POST["drinkNavID"];
    
    include "config.php";
    $sql1="select * from drink WHERE manu_id='$drinkName'";
    $stm = $pdh->query($sql1);
    $rows = $stm->fetchAll(PDO::FETCH_OBJ);
    foreach($rows as $row)
                    {
                        $title=$row->drink_name;
                        $id=$row->drink_id;
                        // $price=$row->price;
                        $price=1000;
                        
                        echo "
                        <div class='card col-3' style='width: 18rem;'>
                            <form class='formCart'   >
                                <img src='./img_product/$row->img' class='card-img-top' alt='...'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$title</h5>
                                    <p class='card-text'>Giá bán $price $</p>
                                    <button type='button' onclick='submitForm($id)'class='btn btn-primary btnNav' >Thêm vào giỏ hàng</button>
                                </div>
                            </form>
                        </div>
                        ";  
                    }
    
    // Phản hồi về trang gửi yêu cầu Ajax
} else {
    // Nếu không phải là yêu cầu POST, có thể thực hiện các xử lý khác ở đây (nếu cần)
}
?>