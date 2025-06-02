<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Đơn Hàng và Sản Phẩm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/styledonhang.css">
    <style>
       
    </style>
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<?php include "header.php"  ?>

    <div class="container order-container">
        <h1 class="text-center mb-4 text-primary">Danh Sách Đơn Hàng</h1>

        <?php 
        $donhangs = $donhang->HienThiDon($idUser);
        foreach($donhangs as $index=> $value):
            $sanpham = $donhang->HienThiSanPhamTheoDon($value['id']);  // Lấy danh sách sản phẩm theo đơn hàng
            $count = count($sanpham);
        ?>

        <!-- Order 1 -->
        <div class="card">
            <div class="card-header" onclick="toggleProducts(<?php echo $value['id']; ?>)">
                <h5>
                    Đơn hàng Ngày: <?php echo $value['created_at'] ?>
                    <span class="badge bg-light text-dark ms-2"><?php echo $count; ?> sản phẩm</span>
                </h5>
                <i class="fas fa-chevron-down" id="icon-<?= $value['id'] ?>"></i>
            </div>
            <div class="card-body product-list" id="products-<?= $value['id'] ?>" style="display: none;">

              <?php   
                   foreach($sanpham as $x):
                    $sanphamdonhang = $products->HienThiMotSanPham($x['id_product']);
                      foreach($sanphamdonhang as $y):
              ?>
                <div class="product-item">
                    <img src="./public/img/<?php echo $y['image'] ?>" alt="Sản phẩm A" class="product-image">
                    <div class="product-details">
                        <h6><?php echo $y['name'] ?></h6>
                        <div class="d-flex justify-content-between">
                            <span>Số lượng: <?php echo $x['soluong'] ?></span>
                            <span class="product-price"><?php echo number_format($x['price'], 0, '', '.')  ?> ₫</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; endforeach; ?>

                <div class="total-amount">
                    Tổng cộng: <?php echo number_format($value['tongtien'], 0, '', '.')  ?> ₫
                </div>
            </div>
        </div>

        <?php endforeach?>
        
    </div>


    <?php include "footer.php"  ?>
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <script>
        function toggleProducts(orderId) {
            var productList = document.getElementById('products-' + orderId);
            var icon = document.getElementById('icon-' + orderId);
            
            if (productList.style.display === "none" || productList.style.display === "") {
                productList.style.display = "block";
                icon.style.transform = "rotate(180deg)";
            } else {
                productList.style.display = "none";
                icon.style.transform = "rotate(0deg)";
            }
        }
    </script>
</body>
</html>