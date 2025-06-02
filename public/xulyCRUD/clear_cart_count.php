<?php
session_start();

// Kiểm tra xem biến session 'new_cart_count' có tồn tại không
if (isset($_SESSION['new_cart_count'])) {
    // Nếu có, đặt lại số lượng giỏ hàng về 0
    $_SESSION['new_cart_count'] = 0;
    echo "Cart count cleared";
} else {
    echo "No cart count to clear";
}
?>