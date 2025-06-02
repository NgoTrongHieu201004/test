<?php
session_start(); // Khởi tạo session để lưu thông tin người dùng sau khi đăng nhập thành công

// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'nhom5'); // Thay thế bằng thông tin đúng

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Nhận dữ liệu từ form
$username = $_POST['username'];
$password = $_POST['password'];

if ($username === 'admin' && $password === '123456') {
    
    $_SESSION['user_id'] = 1; 
    $_SESSION['username'] = 'admin';
    $_SESSION['role'] = 'admin';

    
    header("Location: admin/index.php");
    exit();
}

// Kiểm tra xem người dùng có tồn tại trong cơ sở dữ liệu không
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Kiểm tra mật khẩu
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Kiểm tra mật khẩu
    if (password_verify($password, $user['password'])) {
        // Lưu thông tin người dùng vào session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email'];

        // Chuyển hướng đến trang chính (ví dụ trang index.php)
        header("Location: index.php");
        exit();
    } else {
        // Mật khẩu sai
        echo "<h2 style='color: red; text-align: center;'>Mật khẩu sai!</h2>";
    }
} else {
    // Tên người dùng không tồn tại
    echo "<h2 style='color: red; text-align: center;'>Tên người dùng không tồn tại!</h2>";
}

// Đóng kết nối
$conn->close();
?>
