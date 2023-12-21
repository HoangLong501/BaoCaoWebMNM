<?php

// Thông tin kết nối CSDL
$servername = "localhost"; // Thay thế bằng tên máy chủ CSDL của bạn
$username = "root"; // Thay thế bằng tên người dùng CSDL của bạn
$password = ""; // Thay thế bằng mật khẩu CSDL của bạn
$dbname = "drinkstore1"; // Thay thế bằng tên CSDL của bạn

// Tạo kết nối
// $conn = new BDO($servername, $username, $password, $dbname);

// // Kiểm tra kết nối
// if ($conn->connect_error) {
//     die("Kết nối thất bại: " . $conn->connect_error);
// }
try{
    $pdh = new PDO("mysql:host=$servername; dbname=$dbname"  , $username  , $password  );
    $pdh->query("  set names 'utf8'"  );
    
    }
    catch(Exception $e){
            echo $e->getMessage(); exit;
    }
// // Truy vấn để lấy tất cả sách từ bảng "book"
// $sql = "SELECT * FROM book";
// $result = $conn->query($sql);

// // Kiểm tra và in ra thông tin sách
// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         echo "ID: " . $row["book_id"]. " - Tên sách: " . $row["book_name"].  "<br>";
//     }
// } else {
//     echo "Không có sách nào trong CSDL.";
// }

// Đóng kết nối
//$conn->close();

?>
