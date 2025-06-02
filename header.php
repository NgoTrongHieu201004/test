<?php
session_start();?>
<?php
require "config.php";
require "./public/models/db.php";
require "./public/models/products.php";
require "./public/models/manufactures.php";
require "./public/models/protypes.php";
require "./public/models/carts.php";
require "./public/models/thanhtoan.php";
// Không cần gọi lại session_start() ở đây nếu đã gọi trong config.php

$products = new Products();
$type = new Protypes();
$manu = new Manufactures();
$cart = new Carts();
$donhang = new ThanhToan();

if (isset( $_SESSION['user_id'])) {
    # code...
    $idUser = $_SESSION['user_id'];
}
else{
    $idUser = 0 ;
}
?>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fas fa-laptop-code me-2"></i>
            Shop Công Nghệ
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home me-1"></i>Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="sanpham.php"><i class="fas fa-store me-1"></i>Sản phẩm</a></li>
                <li class="nav-item position-relative">
    <a class="nav-link" href="cart.php" onclick="clearCartCount();">
        <i class="fas fa-shopping-cart me-1"></i>Giỏ hàng
        <?php if (isset($_SESSION['new_cart_count']) && $_SESSION['new_cart_count'] > 0): ?>
            <span class="badge bg-danger position-absolute top-0 start-0 translate-middle rounded-pill">
                <?php echo $_SESSION['new_cart_count']; ?>
            </span>
        <?php endif; ?>
    </a>
</li>

                <li class="nav-item"><a class="nav-link" href="donhang.php"><i class="fa-solid fa-clock"></i></i>Dơn Hàng</a></li>
            </ul>
            
            <form action="result.php" method="get" class="d-none d-lg-flex">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" name="keyfind" class="form-control border-0" placeholder="Tìm sản phẩm">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text bg-primary text-dark border-0 px-3">
                            <i style="padding: 5px;" class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <div class="ms-3">
            <?php
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (isset($_SESSION['user_id'])) {
        
        echo "<span class='navbar-text'> ". htmlspecialchars($_SESSION['username']) . "</span>";
        if($_SESSION['role'] == 1){
            echo '<a href="admin/index.php" class="btn btn-custom btn-sm ms-1 btn-success">Admin</a>';
        }
        echo '<a href="logout.php" class="btn btn-custom btn-sm ms-1 btn-outline-danger">Đăng xuất</a>';
        
    } else {
        echo '<a href="login.php" class="btn btn-custom btn-sm">Đăng nhập</a>';
        echo '<a href="register.php" class="btn btn-custom btn-sm ms-2">Đăng ký</a>';
    }
    
?>
            </div>
        </div>
    </div>       
</nav>

<div class="container mt-3">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <?php
                // Kiểm tra xem có thông báo từ URL không
                if (isset($_GET['message'])) {
                    echo "<div class='alert alert-success' role='alert'>" . htmlspecialchars($_GET['message']) . "</div>";
                }
                ?>
            </div>
            <div class="col-auto">            
            </div>
        </div>
    </div>


<script>
    function clearCartCount() {
    fetch('./public/xulyCRUD/clear_cart_count.php')  // Gọi file PHP để cập nhật session
        .then(response => response.text())
        .then(data => {
            console.log(data);  // Xem phản hồi từ server (nếu cần thiết)
            // Ẩn badge nếu giỏ hàng trống
            const badge = document.querySelector('.badge.bg-danger');
            if (badge) {
                  badge.style.display = 'none';
            }
        });
}

</script>
