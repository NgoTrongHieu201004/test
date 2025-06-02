<?php
// Cấu hình kết nối đến cơ sở dữ liệu
define('DB_HOST', 'localhost');       // Địa chỉ máy chủ cơ sở dữ liệu
define('DB_USER', 'root');            // Tên người dùng cơ sở dữ liệu
define('DB_PASSWORD', '');            // Mật khẩu cơ sở dữ liệu (rỗng trong XAMPP)
define('DB_NAME', 'nhom5');           // Tên cơ sở dữ liệu của bạn
define('PORT', 3306);                 // Cổng MySQL (mặc định là 3306)
define('DB_CHARSET', 'utf8');         // Bộ mã ký tự

// Lớp db để tạo kết nối
class db
{
    public static $connection;
    public function __construct()
    {
        // Kiểm tra xem đã có kết nối hay chưa, nếu chưa tạo kết nối mới
        if (!self::$connection) {
            self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, PORT);
            self::$connection->set_charset(DB_CHARSET);
        }
        return self::$connection;
    }
}
?>
