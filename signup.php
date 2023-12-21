<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>


<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form  class="mx-1 mx-md-4 form" action="" method="POST"  >

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="name" type="text" id="form3Example1c" class="form-control" required  />
                      <label class="form-label" for="form3Example1c">Your Name</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <input type="tel" id="phone" name="phone" required class="form-control" />
                        <label class="form-label" for="phone">Your Phone</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="password" type="password" id="form3Example4c" class="form-control" required/>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input name="address" type="text" id="form3Example4cd" class="form-control" required />
                      <label class="form-label" for="form3Example4cd">Address</label>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input  type="submit" class="btn btn-primary btn-lg" value="Register" name="btnregister"/>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="./img/anh1.jpg"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include "config.php";

if (isset($_POST["btnregister"])) {
    $user_name = $_POST["name"];
    $password = $_POST["password"];
    $phone =$_POST["phone"];
    $address=$_POST["address"];
    $user_id = uniqid('user_'); //tự tạo id

    // Kiểm tra xem tên người dùng đã tồn tại trong cơ sở dữ liệu hay chưa
    $sql_check = "SELECT * FROM user WHERE user_name = '$user_name'";
    $stmt_check = $pdh->query($sql_check);
    $rows = $stmt_check->fetchAll(PDO::FETCH_NUM);

    if (sizeof($rows) > 0) {
        echo "<script>alert('Tên người dùng đã tồn tại');</script>";
    } else {
        // Nếu tên người dùng chưa tồn tại, thực hiện thêm vào cơ sở dữ liệu
        $sql_insert = "INSERT INTO user (user_id, user_name, password) VALUES ('$user_id', '$user_name', '$password')";

        $sql_insert = "INSERT INTO `user`(`user_id`, `user_name`, `is_admin`, `password`, `phone`, `address`)
        VALUES ('$user_id','$user_name',0,'$password','$phone','$address')";
        
        $stmt_insert = $pdh->prepare($sql_insert);
        if ($stmt_insert->execute()) {
            echo "<script>alert('Đăng ký thành công');</script>";
            // Chuyển hướng người dùng đến trang đăng nhập hoặc trang khác sau khi đăng ký thành công
            //
            $sql="INSERT INTO `order_product`(`order_id`, `user_id`) VALUES ('OD$user_id.','$user_id')";
            $stm= $pdh->query($sql);
            header("Location: login.php");
            exit();
            
        } else {
            echo "<script>alert('Đã xảy ra lỗi khi đăng ký');</script>";
        }
        $stmt->closeCursor();
    }
}
?>


</body>
<!-- <script>
   alert("Tai khoản đã tồn tại");
   var form=document.querySelector('.form');
   form.setAttribute(onsubmit,'return disableReload()');
</script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>