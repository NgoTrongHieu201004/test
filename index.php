<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Công Nghệ - Thiết Bị Hiện Đại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.3.0/flickity.min.css">
    <link rel="stylesheet" href="public/css/style.css">

    <style>
      
        .hot-carousel {
      background: linear-gradient(135deg, #0f2b5d 0%, #1a4c98 100%);
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 15px 30px rgba(0,0,0,0.3);
      position: relative;
    }

    .hot-badge {
      position: absolute;
      top: 20px;
      left: -35px;
      background: #ff4444;
      color: white;
      padding: 8px 40px;
      transform: rotate(-45deg);
      font-weight: bold;
      z-index: 10;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .carousel-item {
      min-height: 450px;
    }

    .product-content {
      padding: 2.5rem;
      color: white;
      position: relative;
    }

    .hot-label {
      display: inline-block;
      background: #ff4444;
      color: white;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.9rem;
      margin-bottom: 1rem;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }

    .product-title {
      font-size: 2.8rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
      color: #fff;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .product-price {
      font-size: 2rem;
      color: #4fc3f7;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .original-price {
      font-size: 1.2rem;
      text-decoration: line-through;
      color: #aaa;
    }

    .discount-badge {
      background: #ff4444;
      padding: 3px 10px;
      border-radius: 5px;
      font-size: 1rem;
    }

    .product-description {
      font-size: 1.2rem;
      line-height: 1.8;
      color: #e3f2fd;
      margin-bottom: 2rem;
    }

    .product-features {
      display: flex;
      gap: 20px;
      margin-bottom: 2rem;
    }

    .feature-item {
      background: rgba(255,255,255,0.1);
      padding: 10px 20px;
      border-radius: 10px;
      font-size: 0.9rem;
    }

    .product-image-container {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      position: relative;
    }

    .product-image {
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.3);
      transition: transform 0.3s ease;
      object-fit: cover;
    }

    .product-image:hover {
      transform: scale(1.08);
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 50px;
      height: 50px;
      background: rgba(255,255,255,0.2);
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
      margin: 0 20px;
    }

    .carousel-indicators {
      bottom: 20px;
    }

    .carousel-indicators button {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      margin: 0 5px;
      background-color: #4fc3f7;
    }

    .buy-button {
      background: linear-gradient(45deg, #2196f3, #4fc3f7);
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      color: white;
      font-weight: bold;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(33, 150, 243, 0.3);
    }

    .buy-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(33, 150, 243, 0.4);
    }
    </style>
</head>

<body>


    <!-- Navbar -->
    <?php include "header.php"; ?>


    <!-- Carousel -->
    <div class="container py-5">
        <div id="hotProductCarousel" class="carousel slide hot-carousel" data-bs-ride="carousel">
            <div class="hot-badge">HOT!</div>

            <div class="carousel-inner">

                <?php  
                      $isActive = true; 
                      $hotProduct = $products->HienThiSanPhamBanChay(3);
                      foreach($hotProduct as $values):

                ?>


                <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="product-content">
                                <span class="hot-label">🔥 Sản phẩm HOT</span>
                                <h2 class="product-title"><?php echo $values['name'] ?></h2>
                                <div class="product-price">
                                    <span class="current-price"><?php echo number_format($values['price'], 0, '', '.') ?> ₫</span>
                                </div>
                                <div class="product-features">
                                    <span class="feature-item">✨ Titanium</span>
                                    <span class="feature-item">📸 48MP</span>
                                </div>
                                <p class="product-description"><?php echo $values['description'] ?></p>
                                <a href="single.php?id=<?php echo $values['id'] ?>"><button class="buy-button">Mua ngay</button></a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="product-image-container">
                                <img src="public/img/<?php echo $values['image'] ?>" alt="iPhone 15 Pro Max"
                                    class="product-image img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <?php $isActive = false; endforeach; ?>

            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#hotProductCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#hotProductCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#hotProductCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#hotProductCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#hotProductCarousel" data-bs-slide-to="2"></button>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="container my-5">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="p-3 border rounded animated-card">
                    <i class="fas fa-truck feature-icon"></i>
                    <h4>Miễn Phí Vận Chuyển</h4>
                    <p class="text-muted">Cho đơn hàng trên 5 triệu</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded animated-card">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <h4>Bảo Hành 12 Tháng</h4>
                    <p class="text-muted">Đổi trả miễn phí</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded animated-card">
                    <i class="fas fa-headset feature-icon"></i>
                    <h4>Hỗ Trợ 24/7</h4>
                    <p class="text-muted">Tư vấn miễn phí</p>
                </div>
            </div>
        </div>
    </div>

     <!-- Products -->
     <div class="container my-5" id="products">
        <h2 class="text-center mb-4">Sản Phẩm Nổi Bật</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4" id="product-list">
            <?php
            $productsList = $products->HienThiSanPhamMoi(0, 90);
            usort($productsList, function ($a, $b) {
                $dateA = new DateTime($a['create_at']);
                $dateB = new DateTime($b['create_at']);
                return $dateB <=> $dateA; // Sắp xếp giảm dần theo ngày tạo
            });
            foreach($productsList as $a => $values):
            ?>
                <div class="col product-item">
                    <div class="card h-100 product-card">
                        <div class="position-relative">
                            <img src="public/img/<?php echo $values['image'] ?>" class="card-img-top" alt="iPhone">
                            <span class="category-badge"><?php echo $type->HienThiMotType($values['type_id'])[0]['name_type'] ?></span>
                        </div>
                        <div class="card-body">
                        <a class="h5 d-block mb-3 text-secondary text-uppercase font-weight-bold  text-decoration-none"
                        href="single.php?id=<?php echo $values['id']?>&type_id=<?php echo $values['type_id']?>&manu_id=<?php echo $values['manu_id']?> "><?php echo $values['name'] ?></a>
                            <p class="card-text">Chip A17 Pro, Camera 48MP, Pin 4422 mAh</p>
                            <div class="price-tag"><?php echo number_format($values['price'], 0, '', '.') ?>₫</div>
                            <a href="./public/xulyCRUD/xulythemcart.php?idUser=<?php echo $idUser ?>&idProduct=<?php echo $values['id'] ?>">
                                <button class="btn btn-primary w-100"><i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

  

    <!-- Footer -->
    <?php include "footer.php" ?>
    <script>
       
        let currentIndex = 0;
        const products = document.querySelectorAll('.product-item');
        const totalProducts = products.length;

        function showNextProducts() {
           
            products.forEach(product => {
                product.style.display = 'none';
            });

            
            for (let i = 0; i < 3; i++) {
                const index = (currentIndex + i) % totalProducts; 
                products[index].style.display = 'block';
            }

            
            currentIndex = (currentIndex + 3) % totalProducts;
        }

        
        showNextProducts();

        
        setInterval(showNextProducts, 5000);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.3.0/flickity.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>