<?php
// Kiểm tra xem người dùng đã đăng nhập chưa
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng | Shop Công Nghệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/stylecart.css">
    <!-- Thêm CSS tùy chỉnh cho các nút -->
    <!-- Thêm CSS tùy chỉnh cho các nút -->

</head>

<body>
    <!-- Navbar -->
    <?php include "header.php" ?>

    <?php
        $cartUser = $cart->HienThiCart_User($idUser);
        $count = count($cartUser);
        $Tong = 0;
        foreach ($cartUser as $value) {
            $Tong += $value['soluong'];
        }

     ?>

    <!-- Main Content -->
    <div class="container">
        <div class="cart-container">
            <div class="cart-header text-center">
                <h2><i class="fas fa-shopping-cart me-2"></i>Giỏ Hàng Của Bạn</h2>
                <p class="mb-0"><?php echo $Tong ?> sản phẩm trong giỏ hàng</p>
            </div>

            <div class="products-list">
                <!-- Product 1 -->

                <?php
                   $Tongtien = 0;
                   foreach($cartUser as $value):
                      $cartProduct = $products->HienThiMotSanPham($value['id_product']);
                      foreach($cartProduct as $x):
                        $tien = $x['price'] * $value['soluong'];
                        $Tongtien += $tien;

                ?>

                <div class="product-card">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <img src="public/img/<?php echo $x['image'] ?>" alt="iPhone 14" class="product-image">
                        </div>
                        <div class="col-md-4">
                            <h5 class="mb-2"><?php echo $x['name'] ?></h5>
                            <span class="badge bg-primary mt-2">Bảo hành 24 tháng</span>
                        </div>
                        <div class="col-md-2">
                            <span class="price" data-unit-price="<?php echo $x['price']; ?>">
                                <?php echo number_format($x['price'] * $value['soluong'], 0, '', '.'); ?> ₫
                            </span>
                        </div>
                        <div class="col-md-2">
                            <div class="quantity-control">
                                <button class="quantity-btn"
                                    onclick="decreaseQuantity(this, <?php echo $x['id']; ?>)">-</button>
                                <input type="number" class="quantity-input" value="<?php echo $value['soluong'] ?>"
                                    min="1" readonly>
                                <button class="quantity-btn"
                                    onclick="increaseQuantity(this, <?php echo $x['id']; ?>)">+</button>
                            </div>
                        </div>
                        <div class="col-md-2 text-end">
                            <a
                                href="./public/xulyCRUD/xulyXoaCart.php?idUser=<?php echo $_SESSION['user_id'] ?>&idProduct=<?php echo $x['id'] ?>">
                                <button class="btn delete-btn">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; 
            endforeach; ?>


            </div>

            <!-- Checkout Section -->
            <div class="checkout-section">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h4 class="mb-2">Tổng cộng: <span
                                id="totalPrice"><?php echo number_format($Tongtien, 0, '', '.') ?> ₫</span></h4>
                        <p class="mb-0"><i class="fas fa-info-circle me-2"></i>Đã bao gồm VAT & Phí vận chuyển</p>
                    </div>
                    <div class="col-lg-6 text-lg-end">
                        <a href="thanhtoan.php?count=<?php echo $count ?>"><button class="checkout-btn">
                                <i class="fas fa-lock me-2"></i>Thanh Toán An Toàn
                            </button></a>

                    </div>
                </div>
            </div>

            <!-- Nút Đăng Xuất -->
            <?php if ($isLoggedIn): ?>

            <div class="text-center mt-4">
                <p>Vui lòng <a href="login.php">đăng nhập</a> để tiếp tục.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php" ?>

    <script>
    function formatCurrency(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount).replace('VND', '₫');
    }

    function decreaseQuantity(button, productId) {
        const productCard = button.closest('.product-card');
        const input = productCard.querySelector('.quantity-input');
        let quantity = parseInt(input.value);

        if (quantity > 1) {
            input.value = quantity - 1;
            updateProductPrice(productCard); // Cập nhật giá tiền sản phẩm
            updateTotal(); // Cập nhật tổng số lượng và tổng tiền
            updateCartQuantity(input.value, productId); // Gửi cập nhật lên server
        }
    }

    function increaseQuantity(button, productId) {
        const productCard = button.closest('.product-card');
        const input = productCard.querySelector('.quantity-input');
        let quantity = parseInt(input.value);

        input.value = quantity + 1;
        updateProductPrice(productCard); // Cập nhật giá tiền sản phẩm
        updateTotal(); // Cập nhật tổng số lượng và tổng tiền
        updateCartQuantity(input.value, productId); // Gửi cập nhật lên server
    }


    function updateProductPrice(productCard) {
        const pricePerUnit = parseInt(productCard.querySelector('.price').getAttribute('data-unit-price'));
        const quantity = parseInt(productCard.querySelector('.quantity-input').value);
        const newPrice = pricePerUnit * quantity;

        productCard.querySelector('.price').innerText = formatCurrency(newPrice);
    }


    function updateCartQuantity(newQuantity, productId) {
        var idUser = <?php echo $_SESSION['user_id']; ?>; // Giả sử bạn đã lưu user_id trong session
        var xhr = new XMLHttpRequest();
        xhr.open('GET', './public/xulyCRUD/xulySuaCart.php?idUser=' + idUser + '&idProduct=' + productId + '&soluong=' +
            newQuantity, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Số lượng đã được cập nhật thành công!');
            } else {
                console.log('Có lỗi xảy ra khi cập nhật số lượng.');
            }
        };
        xhr.send();
    }


    function updateTotal() {
        let totalQuantity = 0;
        let totalPrice = 0;

        const products = document.querySelectorAll('.product-card');
        products.forEach(product => {
            const pricePerUnit = parseInt(product.querySelector('.price').getAttribute('data-unit-price'));
            const quantity = parseInt(product.querySelector('.quantity-input').value);
            totalQuantity += quantity;
            totalPrice += pricePerUnit * quantity;
        });

        // Cập nhật tổng số lượng và tổng tiền
        document.getElementById('totalPrice').innerText = formatCurrency(totalPrice);
        document.querySelector('.cart-header p').innerText = `${totalQuantity} sản phẩm trong giỏ hàng`;
    }


    // Thêm hiệu ứng cho nút xóa
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const productCard = this.closest('.product-card');
            productCard.style.opacity = '0';
            productCard.style.transform = 'scale(0.8)';
            setTimeout(() => {
                productCard.remove();
                updateTotal();
            }, 300);
        });
    });
    </script>
</body>

</html>