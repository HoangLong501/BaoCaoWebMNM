<?php
$servername = "localhost"; // Thay thế bằng tên máy chủ CSDL của bạn
$username = "root"; // Thay thế bằng tên người dùng CSDL của bạn
$password = ""; // Thay thế bằng mật khẩu CSDL của bạn
$dbname = "drinkstore1"; // Thay thế bằng tên CSDL của bạn
    try{
    $pdh = new PDO("mysql:host=$servername; dbname=$dbname"  , $username  , $password  );
    $pdh->query("  set names 'utf8'"  );
    }
    catch(Exception $e){
            echo $e->getMessage(); exit;
    }
?>
