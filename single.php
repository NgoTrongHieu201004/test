<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Mục Sản Phẩm - Shop Công Nghệ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
  .center {
 display: block;
 margin-left: auto;
 margin-right: auto;
 width: auto;
}

    </style>
</head>
<body>
    <!-- Navbar -->
    <?php include "header.php";?>

    <!-- Category Header -->
    <div class="container my-4">
        <div class="category-header text-center">
            <p class="lead mb-0">Khám phá các sản phẩm công nghệ chất lượng cao với giá tốt nhất</p>
        </div>
    </div>

    <!-- Main Categories -->
    <div class="container">
        <!-- Tabs -->
        <ul class="nav nav-tabs" id="productTabs" role="tablist">

        <?php  
        foreach($type->HienThiType() as $x):
           
        ?>
            <li class="nav-item" role="presentation">
            <a class="btn" href="sanpham.php?type-id=<?php echo $x['id_type'] ?>">
                <button class="nav-link " id="phone-tab" data-bs-toggle="tab" data-bs-target="#phone" type="button" role="tab">
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
                    if (isset($_GET['type-id'])) {
                        $type_id = $_GET['type-id'];
                        // Nếu không có tham số 'manu-id', gán mặc định là 1
                        $manu_id = isset($_GET['manu-id']) ? $_GET['manu-id'] : 1;
                       
                    } else {
                      
                        $type_id = 1;
                        $manu_id = 1;
                    }
                    
                    foreach($manu->HienThiManu() as $x): ?>

                        <li class="nav-item">
                        <a class="btn" href="sanpham.php?type-id=<?php echo $type_id ?>&manu-id=<?php echo $x['id_manu'] ?>">
                            <button class="nav-link " data-bs-toggle="tab" data-bs-target="#apple-phone">
                                <?php echo $x['name_manu'] ?>
                            </button>
                    </a>
                        </li>
                        <?php endforeach ?>
                        

                    </ul>
                </div>

                <div class="tab-content">
                    
                </div>
            </div>

             <!-- Products -->
    <div class="container my-5" id="products">
     
     <div class="row ">
      <div class="col">
                        
                    
                     <?php 
                     $id = (isset($_GET['id']))?$_GET['id']:1;
                          foreach($products->detailItems($id) as $key=>$values){
                       ?>
                     <div class="col fade-in">
                             <div class="card product-card">
                                 <div class="position-relative">
                                     <img src="public/img/<?php echo $values['image']; ?>" class="center img-fluid" alt="ảnh">
                                     <span class="product-badge">Mới</span>
                                 </div>
                                 <div class="card-body">
                                
                                 <a class="h1 d-block mb-3 text-secondary text-uppercase font-weight-bold  text-decoration-none" href="single.php?id=<?php echo $values['id'] ?>"><?php echo $values['name'] ?></a>       
                                     <div class="price-tag"><?php echo number_format($values['price'], 0, '', '.'); ?>₫</div>
                                     <h5><?php echo $values['description'] ?></h5>
                                     <a href="./public/xulyCRUD/xulythemcart.php?idUser=<?php echo $idUser ?>&idProduct=<?php echo $values['id'] ?>">
                                     <button class="btn btn-cart">
                                         <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                     </button>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     <?php } ?>
                     <!-- sản phẩm thường mua cùng -->
        <div class="container my-5" id="products">
        <h2 class="text-center mb-4">Sản Phẩm Liên Quan</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4" id="product-list">
            <?php
   
            $type_id= (isset($_GET["type_id"]))?$_GET["type_id"]:1;
            $manu_id= (isset($_GET["manu_id"]))?$_GET["manu_id"]:1;
            if($type_id == 1 ||$type_id ==4 ||$type_id ==5){
                $productsList = $products-> HienThiSanPhamLienQuan2 ($id, $type_id);
            }else{
                $productsList = $products->HienThiSanPhamLienQuan($id,$type_id,$manu_id);
            }
            
            usort($productsList, function ($a, $b) {
                $dateA = new DateTime($a['create_at']);
                $dateB = new DateTime($b['create_at']);
                return $dateB <=> $dateA; // Sắp xếp giảm dần theo ngày tạo
            });
            foreach($productsList as $a => $values):
            ?>
                <div class="col product-item-related">
                    <div class="card h-100 product-card">
                        <div class="position-relative">
                            <img src="public/img/<?php echo $values['image'] ?>" class="card-img-top" alt="iPhone">
                            <span class="category-badge"><?php echo $type->HienThiMotType($values['type_id'])[0]['name_type'] ?></span>
                        </div>
                        <div class="card-body">
                            <a class="h5 d-block mb-3 text-secondary text-uppercase font-weight-bold text-decoration-none" href="single.php?id=<?php echo $values['id'] ?>"><?php echo $values['name'] ?></a>
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
                       <!-- Comment List Start -->
                    <div class="mb-3">
                        <?php $length = random_int(0,3) ?>
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold " id="lenghtComment"> Đánh giá</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-4 status-area">
                            <?php  for ($i = 0 ; $i < $length ; $i++){?>
                            <div class="media mb-4">
                                <img src="public/img/icon_avatar.png" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                <div class="media-body">
                                    <h6><a class="text-secondary " style = "font-weight: bold; text-decoration: none;" href="">John Doe</a> <small><i>01 Jan 2045</i></small></h6>
                                    <p>Diam amet duo labore stet elitr invidunt ea clita ipsum voluptua, tempor labore
                                        accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                    <button class="btn btn-sm btn-outline-secondary">Reply</button>
                                </div>
                            </div>
                            
                           <?php }?>
                        </div>
                    </div>
                        <!-- Comment List End -->

                    <!-- Comment Form Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Viết đánh giá</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-4">
                            <form>
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Tên *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                    </div>
                                </div>                           
                                <div class="form-group">
                                    <label for="message">Đánh giá *</label>
                                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                              
                            </form>
                                 <div class="form-group mb-0" style ="margin-top: 10px;">
                                <button  class="btn btn-primary font-weight-semi-bold py-2 px-3" value ="submit" id ="submit" >Post</button>
                                </div>
                        </div>
                    </div>
                    <!-- Comment Form End -->
                     <?php ?>
     </div>

 </div>
           
        </div>
    </div>
  

 <!-- Footer -->
 <?php include "footer.php" ?>
 <script>
       
       let currentIndex = 0;
        const products = document.querySelectorAll('.product-item-related');
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
     <script>

let  name  = document.querySelector('#name');
let  message  = document.querySelector('#message');
let email = document.querySelector('#email');
const btnPost  = document.querySelector('#submit');
const statusArea  = document.querySelector('.status-area');
var count = 0 ; 
let lenghtComment = document.querySelector('#lenghtComment')

var today = new Date();
btnPost.addEventListener('click', function(){

    if (name.value !== '' && message.value !== '' && email.value !== '' ) {
        statusArea.insertAdjacentHTML('afterbegin', ' <div class="media mb-4">'+
                                '<img src="public/img/icon_avatar.png" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">'+
                                '<div class="media-body">'+
                                   ' <h6><a class="text-secondary " style = "font-weight: bold; text-decoration: none;" href="">'+name.value+'</a> <small><i>'+ today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear()+'</i></small></h6>'+
                                    '<p>'+message.value+'</p>'+
                                  ' <button class="btn btn-sm btn-outline-secondary">Reply</button>'+
                                '</div>'+
                            '</div>'
                       );
                name.value = '';
                email.value = '';
                message.value = '';
                alert('Cảm ơn bạn đã phản hồi với chúng tôi !');
            } else {
                alert('Vui lòng nhập đầy đủ thông tin trước khi đăng !');
            }
   

  
                  

})

</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>