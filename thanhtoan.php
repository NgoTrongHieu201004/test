<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/stylethanhtoan.css">
</head>
<body>
    
 <?php include "header.php" ?>

 <?php 

          if ($_GET['count'] == 0) {
            header('location:./sanpham.php?messagethongbao=Bạn chưa có sản phẩm trong giỏ hang!!');
            exit();
          }
          else{

    


            $cartUser = $cart->HienThiCart_User($idUser);
            $Tong = 0;
            foreach ($cartUser as $value) {
                $cartProduct = $products->HienThiMotSanPham($value['id_product']);
                foreach($cartProduct as $x):
                  $tien = $x['price'] * $value['soluong'];
                  $Tong += $tien;
                endforeach;
            }
 ?>
    <div class="main-content">
        <div class="form-section">
            <form action="./public/xulyCRUD/xulyThanhToan.php" method="post">
                <div class="form-group">
                    <label for="name">Họ và Tên</label>
                    <input type="text" id="name" name="name" value="<?php echo $_SESSION['username'] ?>" placeholder="Nhập họ và tên" required>
                </div>

                <div class="form-group">
                    <label for="email">Địa Chỉ Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $_SESSION['email'] ?>" placeholder="Nhập địa chỉ email" required>
                </div>

                <div class="form-group">
                    <label for="card-number">Số Thẻ</label>
                    <input type="text" id="card-number" name="card_number" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                </div>
                <input type="text" id="tong" name="tong" value="<?php echo $Tong;?>" required style="display: none;">
                <input type="text" id="idUser" name="idUser" value="<?php echo $idUser;?>" required style="display: none;">

                <button type="submit" name="submit" class="payment-button">Thanh Toán Ngay</button>
            </form>
        </div>

        <div class="summary-section">
            <h2>Thông Tin Đơn Hàng</h2>
            <div class="product-details">

            <?php
                   $Tongtien = 0;
                   foreach($cartUser as $value):
                      $cartProduct = $products->HienThiMotSanPham($value['id_product']);
                      foreach($cartProduct as $x):
                        $tien = $x['price'] * $value['soluong'];
                        $Tongtien += $tien;

                ?>

                <div class="product">
                    <img src="public/img/<?php echo $x['image'] ?>" alt="Ảnh Sản Phẩm">
                    <div class="product-info">
                        <p><strong><?php echo $x['name'] ?></strong></p>
                        <p class="quantity">Số lượng: <?php echo $value['soluong'] ?></p>
                        <p class="price">Giá: <?php echo number_format($x['price'] * $value['soluong'], 0, '', '.'); ?> ₫</p>
                    </div>
                </div>

                <?php endforeach; 
            endforeach; ?>
                <p class="total">Tổng Cộng:<?php echo number_format($Tongtien, 0, '', '.');?> ₫</p>
            </div>
        </div>
    </div>
<?php       }?>
</body>

<?php include "footer.php" ?>
</html>