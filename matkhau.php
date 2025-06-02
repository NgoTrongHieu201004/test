<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nhom5";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý form quên mật khẩu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['input'];

    // Kiểm tra xem tên người dùng hoặc email có tồn tại không
    $stmt = $conn->prepare("SELECT email FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $input, $input);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Gửi email khôi phục mật khẩu (giả sử bạn đã cấu hình email)
        // Ở đây bạn có thể thêm mã gửi email và tạo token
        $success_message = "Email khôi phục mật khẩu đã được gửi đến địa chỉ của bạn.";
    } else {
        $error = "Tên người dùng hoặc email không tồn tại.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <style>
  body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #2193b0, #6dd5ed); /* Nền gradient cho body */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.forgot-password-box {
    background: linear-gradient(135deg, #2193b0, #6dd5ed); /* Nền gradient cho bảng quên mật khẩu */
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 400px;
    color: black;
}

.forgot-password-header {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #6dd5ed;
    color: black;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

.btn:hover {
    background-color:#2193b0;
}

.error-message, .success-message {
    text-align: center;
    margin-bottom: 10px;
}

.error-message {
    color: red;
}

.success-message {
    color: green;
}

</style>
</head>
<body>
    <div class="forgot-password-box">
        <div class="forgot-password-header">QUÊN MẬT KHẨU</div>
        <?php if (isset($error)) { ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php } ?>
        <?php if (isset($success_message)) { ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php } ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="input" class="form-label">Tên người dùng hoặc Email</label>
                <input type="text" id="input" name="input" class="form-control" required>
            </div>
            <button type="submit" class="btn">Gửi yêu cầu khôi phục</button>
        </form>
        <div style="text-align: center; margin-top: 15px;">
            <a href="login.php">Trở về đăng nhập</a>
        </div>
    </div>
</body>
</html>