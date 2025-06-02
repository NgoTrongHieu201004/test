<?php
session_start();
session_unset(); // Xóa tất cả các biến phiên
session_destroy(); // Hủy phiên
header("Location: index.php"); // Chuyển hướng về trang chính
exit();
?>