<?php

// Kiểm tra xem người dùng đã đăng nhập chưa
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;



if (isset($_GET['messagethongbao'])) {
    $message = $_GET['messagethongbao'];
    echo "<script>alert('$message');</script>";
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Mục Sản Phẩm - Shop Công Nghệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/stylesanpham.css">
    <!-- Thêm CSS tùy chỉnh cho các nút -->
    <!-- Thêm CSS tùy chỉnh cho các nút -->
</head>

<body>
    <!-- Navbar -->
    <?php include "header.php"; ?>

    <!-- Category Header -->
    <div class="container my-4">
        <div class="category-header text-center">
            <h1 class="display-4 fw-bold mb-3">Danh Mục Sản Phẩm</h1>
            <p class="lead mb-0">Khám phá các sản phẩm công nghệ chất lượng cao với giá tốt nhất</p>
        </div>
    </div>

    <!-- Main Categories -->
    <div class="container">
        <!-- Tabs -->
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <?php
            foreach ($type->HienThiType() as $x):
                ?>
                <li class="nav-item" role="presentation">
                    <a class="btn" href="sanpham.php?type-id=<?php echo $x['id_type'] ?>">
                        <button class="nav-link" id="phone-tab" data-bs-toggle="tab" data-bs-target="#phone" type="button"
                            role="tab">
                            <i class="<?php echo $x['icon'] ?>"></i><?php echo $x['name_type'] ?>
                        </button>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="productTabsContent">
            <!-- Điện thoại -->
            <div class="tab-pane fade show active" id="phone" role="tabpanel">
                <div class="text-center mb-4">
                    <ul class="nav nav-pills">
                        <?php
                        $type_id = isset($_GET['type-id']) ? $_GET['type-id'] : 1;
                        $manu_id = isset($_GET['manu-id']) ? $_GET['manu-id'] : 1;

                        foreach ($manu->HienThiManu() as $x): ?>
                            <li class="nav-item">
                                <a class="btn"
                                    href="sanpham.php?type-id=<?php echo $type_id ?>&manu-id=<?php echo $x['id_manu'] ?>">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#apple-phone">
                                        <?php echo $x['name_manu'] ?>
                                    </button>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>

                <div class="tab-content">
                    <!-- Apple Phones -->
                    <div class="tab-pane fade show active" id="apple-phone">
                        <div class="row g-4">
                            <?php
                            $url = $_SERVER['PHP_SELF'];
                            $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                            $offset = 3;
                            $perPage = 3;
                            $total = count($products->getProductsByTypeAndManu($manu_id, $type_id));
                            $PaginateVer4 = $products->PaginateVer4($url, $total, $perPage, $offset, $page, $manu_id, $type_id);
                            foreach ($products->getProductsByTypeAndManuLimit($manu_id, $type_id, $page, $perPage) as $key => $values):
                                // Kiểm tra nếu $values['create_at'] tồn tại và có định dạng hợp lệ
                                if (isset($values['create_at'])) {
                                    $currentDate = new DateTime();
                                    $productDate = new DateTime($values['create_at']); // Ngày tạo sản phẩm
                                    $interval = $currentDate->diff($productDate)->days;
                                    $isNew = $interval <= 7; // Kiểm tra nếu sản phẩm mới trong vòng 7 ngày
                                }
                            ?>
                            
                                <div class="col-md-4 fade-in">
                                    <div class="card product-card">
                                        <div class="position-relative">
                                            <img src="public/img/<?php echo $values['image'] ?>" class="card-img-top"
                                                alt="iPhone 14 Pro Max">
                                                <?php if (isset($isNew) && $isNew): ?>
                                                <span class="product-badge">Mới</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body">
                                            <a class="h5 d-block mb-3 text-secondary text-uppercase font-weight-bold  text-decoration-none"
                                                href="single.php?id=<?php echo $values['id']?>&type_id=<?php echo $values['type_id']?>&manu_id=<?php echo $values['manu_id']?> "><?php echo $values['name'] ?></a>

                                            <div class="price-tag">
                                                <?php echo number_format($values['price'], 0, '', '.') ?>₫
                                            </div>
                                            <a href="./public/xulyCRUD/xulythemcart.php?idUser=<?php echo $idUser ?>&idProduct=<?php echo $values['id'] ?>">
                                                <button type="submit" name="submit" class="btn btn-cart">
                                                    <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <!-- Samsung Phones -->

                </div>
            </div>

            <!-- Laptop Content -->
            <div class="tab-pane fade" id="laptop" role="tabpanel">
                <!-- Tương tự như phần điện thoại -->
            </div>

            <!-- Accessory Content -->
            <div class="tab-pane fade" id="accessory" role="tabpanel">
                <!-- Tương tự như phần điện thoại -->
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="row mt-5">
        <div class="col-12">
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php echo  $PaginateVer4; ?>
                </ul>
            </nav>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php" ?>

    <script>
    // Chọn tất cả các nút trong danh sách
    const buttons = document.querySelectorAll('#productTabs .nav-link');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            // Xóa lớp 'active' khỏi tất cả các nút
            buttons.forEach(btn => btn.classList.remove('active'));

            // Thêm lớp 'active' vào nút được nhấn
            this.classList.add('active');
        });
    });
    
</script>

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>