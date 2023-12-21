<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
  .divider:after,
  .divider:before {
  content: "";
  flex: 1;
  height: 1px;
  background: #eee;
  }
  .h-custom {
  height: calc(100% - 73px);
  }
  @media (max-width: 450px) {
  .h-custom {
  height: 100%;
  }
  }

</style>
<body>

<header>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="./img/logo.jpg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      Drink Store
    </a>
  </div>
</nav>


<?php
include "config.php"; 
session_start();
//nếu đã đăng nhập -> trang index
if(isset($_SESSION['user_id'])){ 
  header("Location: index.php");
  exit();
}

if(isset($_POST['btnLogin'])) {
    $username = $_POST['name'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE user_name = '$username' AND password = '$password' and is_admin =1;";
    $stm = $pdh->query($sql);
    $rows = $stm->fetchAll(PDO::FETCH_NUM);
    if(sizeof($rows)>0){
      echo "<script>alert('Đăng nhập thành công Admin.');</script>";
      $_SESSION['admin']=1;
      $_SESSION['user_id']=$rows[0][0];
      header("Location: index.php");
      exit();
    }else{
      $sql = "SELECT * FROM user WHERE user_name = :username AND password = :password";
      $stmt = $pdh->prepare($sql);
      $stmt->execute(['username' => $username, 'password' => $password]);
      $user = $stmt->fetch(PDO::FETCH_NUM);
      if ($user) {
        echo "<script>alert('Đăng nhập thành công.');</script>";
        $_SESSION['admin']=0;
        $_SESSION['user_id']=$user[0];
        $idtemp=$_SESSION['user_id']; //nếu đăng nhập thành công -> lưu user trong session
        echo "<script>alert('$idtemp');</script>";
        header("Location: index.php");
        exit(); 
      } else {
        echo "<script>alert('Sai thông tin');</script>";
        session_destroy();
      }
      $stmt->closeCursor();
    }

    
}
?>



</header>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-8 col-lg-6 col-xl-4">
        <img src="./img/anh1.jpg"
          class="img-fluid img-login" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="" method="POST" >
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-facebook-f"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-twitter"></i>
            </button>

            <button type="button" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-linkedin-in"></i>
            </button>
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Or</p>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid name" name="name" required/>
            <label class="form-label" for="form3Example3">Name</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" id="form3Example4" class="form-control form-control-lg"
              placeholder="Enter password" name="password" required />
            <label class="form-label" for="form3Example4">Password</label>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Remember me
              </label>
            </div>
            <a href="#!" class="text-body">Forgot password?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <input type="submit" class="btn btn-primary btn-lg" value="Login" name="btnLogin">
            <!-- <a href="homepage.php" type="submit" class="btn btn-primary btn-lg"s
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</a> -->
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="signup.php"
                class="link-danger">Register</a></p>
          </div>
          

        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2023. Kim Hoàng Long - Võ Hoàng Nam.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</section>   


    <!-- <script src="kiemtraFORM.js"></script> -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>