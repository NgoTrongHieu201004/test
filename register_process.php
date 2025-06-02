<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'nhom5');


// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Nhận dữ liệu từ form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Kiểm tra nếu mật khẩu và xác nhận mật khẩu không khớp
if ($password !== $confirm_password) {
    die("<h2 style='color: red; text-align: center;'>Mật khẩu và xác nhận mật khẩu không khớp!</h2>");
}

// Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
$password_hashed = password_hash($password, PASSWORD_BCRYPT);

// Kiểm tra xem tên người dùng hoặc email đã tồn tại chưa
$sql_check = "SELECT * FROM users WHERE username = ? OR email = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("<h2 style='color: red; text-align: center;'>Tên người dùng hoặc email đã tồn tại!</h2>");
}

// Chèn dữ liệu vào bảng users
$sql_insert = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("sss", $username, $password_hashed, $email);

if ($stmt->execute()) {
    echo "<h2 style='color: green; text-align: center;'>Đăng ký thành công!</h2>";
    echo "<p style='text-align: center;'><a href='login.php'>Đăng nhập ngay</a></p>";
} else {
    echo "<h2 style='color: red; text-align: center;'>Đăng ký thất bại. Vui lòng thử lại!</h2>";
}

// Đóng kết nối
$conn->close();
?>
