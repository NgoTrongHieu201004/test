<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Công Nghệ - Thiết Bị Hiện Đại</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/stylesanpham.css">
    <style>
        .section-title {
    margin-bottom: 15px;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #FFFFFF;
    border: 1px solid #dee2e6;
    border-left: 5px solid #3491d0;
  }
  
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include "header.php";?>

    <!-- Banner -->
    <div class="container">
        <div class="banner animated-card">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold">Khuyến Mãi Mùa Hè 🌞</h1>
                    <p class="lead">Giảm giá lên đến 50% cho các sản phẩm công nghệ hot nhất</p>
                    <div class="d-flex gap-3">
                        <a href="#products" class="btn btn-light btn-lg"><i class="fas fa-shopping-bag me-2"></i>Mua Ngay</a>
                        <a href="#" class="btn btn-outline-light btn-lg"><i class="fas fa-gift me-2"></i>Ưu Đãi</a>
                    </div>
                </div>
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
     
        <div class="row ">
        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">kết quả tìm kiếm: </h4>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="">Xem tất cả</a>
                            </div>
                        </div>
                        <?php 
                        if(isset($_GET['keyfind'])&& $_GET['keyfind']!='' ){
                            $getSearchAll = $products->getSearchAll($_GET['keyfind']) ;
                            if(empty($getSearchAll)){
                                echo "không có kết quả ";
                            }else{
                                $url = $_SERVER['PHP_SELF'];
                                $perPage = 3 ; 
                                $page = (isset($_GET['page']))?$_GET['page']:1;
                                $offset = 3;
                                $total = count($getSearchAll);
                                $paginationVer3 = $products->paginateVer3($url,$total,$perPage,$page,$offset,$_GET['keyfind']) ;
                                $getSearchLimit = $products->getSearchLimit($_GET['keyfind'],$perPage,$page);
                        foreach ($getSearchLimit as $key=>$values){?>
                        <div class="col-md-4 fade-in">
                                <div class="card product-card">
                                    <div class="position-relative">
                                        <img src="public/img/<?php echo $values['image']; ?>" class="card-img-top" alt="iPhone 14 Pro Max">
                                        <span class="product-badge">Mới</span>
                                    </div>
                                    <div class="card-body">
                                   
                                    <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold  text-decoration-none" href="single.php?id=<?php echo $values['id'] ?>"><?php echo $values['name'] ?></a>
                                        
                                        <div class="price-tag"><?php echo number_format($values['price'], 0, '', '.'); ?>₫</div>
                                        <a href="./public/xulyCRUD/xulythemcart.php?idUser=<?php echo $idUser ?>&idProduct=<?php echo $values['id'] ?>">
                                        <button class="btn btn-cart">
                                            <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                        </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                        <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        
                        <?php echo $paginationVer3; ?>
                    </ul>
                </nav>
            </div>
                        <?php }}else{
                            echo "Vui lòng nhập từ khóa để tìm kiếm ";
                        } ?>
        </div>

    </div>

    <!-- Footer -->
    <?php include "footer.php" ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>