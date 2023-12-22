<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/nova-square" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>                 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    .title{
        font-size: 20px;
        width: 100%;
        font-family: 'Nova Square', sans-serif;
        
    }
    .card{
        margin-left: 12px;
    }


</style>
<script>
        function submitRemoveCart(id) {
            // Lấy dữ liệu từ biểu mẫu
           
            var formData = $(".form").serialize();
          
            formData += "&removeID=" + id;
            // Sử dụng Ajax để gửi yêu cầu đến server-side PHP            
            $.ajax({
                type: "POST",
                url: "removeCart.php", // Tên tệp xử lý PHP
                data: formData,
                success: function(respone) {
                    alert(respone); // Hiển thị kết quả từ server
                    location.reload();
                }
            });
        }

        function submitUpdateCart(id) {
            // Lấy dữ liệu từ biểu mẫu
            let tem ='.updateQuantity'+'_'+id;
            var updateQuantity =document.querySelector(tem).value;
            var formData = $(".formUpdate").serialize();
          
            formData += "&updateID=" + id ;
            formData += "&updateQuantity=" + updateQuantity ;
            // Sử dụng Ajax để gửi yêu cầu đến server-side PHP            
            $.ajax({
                type: "GET",
                url: "removeCart.php", // Tên tệp xử lý PHP
                data: formData,
                success: function(respone) {
                    alert(respone); // Hiển thị kết quả từ server
                    location.reload();
                }
            });
        }
</script>
<body>
<?php

    
?>



    <div class="header">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
            <a href="index.php" class="navbar-brand">Drink Store</a>
            

          
                    
            
            </div>
        </nav>

    </div>



    <div class="content row">
        <div class="product-cart col">
            <div class="title">
            <span><h1><center>THÔNG TIN GIỎ HÀNG</center></h1> </span> 
            </div>

           


            <section class="vh-100" style="background-color: #fdccbc;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">

        <?php
                    include "config.php";
                    session_start();
                    $user_id=$_SESSION['user_id'];
                    $sql1="SELECT * FROM `order_product` WHERE user_id='$user_id'";
                    $stm = $pdh->query($sql1);
                    $rows = $stm->fetchAll(PDO::FETCH_NUM);
                    $orderArr=$rows[0][0];
                    $stm->closeCursor();
                    

                    $sql = "SELECT d.drink_id, d.drink_name, d.img, od.quantity, d.price , 
                    od.quantity*d.price as total FROM drink d JOIN order_detail od ON d.drink_id = od.drink_id where od.order_id='$orderArr';";
                    $stm = $pdh->query($sql);
                    $rows = $stm->fetchAll(PDO::FETCH_OBJ);
                    $count=sizeof($rows);
                    echo "<p><span class='h4'>Shopping Cart </span><span class='h4'>($count item in your cart)</span></p>";
                    foreach($rows as $row)
                    {
                        $id=$row->drink_id;
                        $quantity=$row->quantity;
                        echo "
                        
                        <div class='card mb-4'>
          <div class='card-body p-4'>

            <div class='row align-items-center'>
              <div class='col-md-2'>
                <img src='./img_product/$row->img'
                  class='img-fluid' style='max-width: 50%' alt='Generic placeholder image'>
              </div>
              <div class='col-md-2 d-flex justify-content-center'>
                <div>
                  <p class='small text-muted mb-4 pb-2'>Name</p>
                  <p class='lead fw-normal mb-0'>$row->drink_name</p>
                </div>
              </div>
              <div class='col-md-2 d-flex justify-content-center'>
                <div>
                  <p class='small text-muted mb-4 pb-2'>Quantity</p>
                  <input min='1' value='$row->quantity' max='1' type='number'class='form-control updateQuantity_$id' />
                </div>
              </div>
              <div class='col-md-2 d-flex justify-content-center'>
                <div>
                  <p class='small text-muted mb-4 pb-2'>Price</p>
                  <p class='lead fw-normal mb-0'>$row->price</p>
                </div>
              </div>
              <div class='col-md-2 d-flex justify-content-center'>
                <div>
                  <p class='small text-muted mb-4 pb-2'>Total</p>
                  <p class='lead fw-normal mb-0'>$row->total</p>
                </div>
              </div>
              <div class='col-md-2 d-flex justify-content-center'>
                    <form class='formUpdate'>
                    
                    <button type='button' onclick='submitUpdateCart($id)'class='btn'><i class='fa-regular fa-pen-to-square'></i></button>
                    </form>

                    <form class='form'>
                        <button type='button' onclick='submitRemoveCart($id)'class='btn'><i class='fa-regular fa-trash-can'></i></button>
                        
                    </form>
              </div>
               
                
              
                </div>

          </div>
        </div>



                        ";  
                    }
                ?>
        <div class="card mb-5">
          <div class="card-body p-4">
                <?php
                    // sửa lại câu select
                    $sql = "SELECT 
                    SUM(d.price * od.quantity*2) AS total 
                FROM 
                    drink d
                JOIN 
                    order_detail od ON d.drink_id = od.drink_id where od.order_id='$orderArr' ;";
                    $stm = $pdh->query($sql);
                    $rows = $stm->fetchAll(PDO::FETCH_OBJ);
                    
                    $total= $rows[0]->total;
                    echo "
                    <div class='float-end'>
                        <p class='mb-0 me-5 d-flex align-items-center'>
                          <span class='small text-muted me-2'>Order total:</span> <span
                            class='lead fw-normal'>$total</span>
                        </p>
                      </div>
                    
                    ";
                ?>
            
            
          </div>
        </div>

        <div class="d-flex justify-content-end">
          <button type="button" class="btn btn-primary btn-lg">THANH TOÁN</button>
        </div>

      </div>
    </div>

</section>



                
            </div>
        </div>
      

    </div>

    


    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="scripts.js"></script>
</html>