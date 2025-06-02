<?php
require "../../config.php";
require "../models/db.php";
require "../models/carts.php";
require "../models/thanhtoan.php";
require "../models/products.php";
session_start(); 
$cart = new Carts();
$thanhtoan = new ThanhToan();
$product = new Products();
$check = false;

if (isset($_POST['submit'])) {
   $idUser = $_POST['idUser'];
   $tongtien = $_POST['tong'];
   $insertedId = $thanhtoan->ThemDonThanhToan($idUser, $tongtien);
    if ($insertedId) {
       foreach($cart->HienThiCart_User($idUser) as $value):
        $cartProduct = $product->HienThiMotSanPham($value['id_product']);
                      foreach($cartProduct as $x):
                        $tien = $x['price'] * $value['soluong'];
                        $id_product = $x['id'];
                        if ($thanhtoan->ThemSanPhamThanhToan($insertedId,$id_product,$value['soluong'],$tien)) {
                            $check = true;
                        }
                     ;


                      endforeach;
       endforeach;
    }
    if ($check == true) {
       $cart->XoaCart_idUser($idUser);
         // Chuyển hướng kèm theo thông báo
   header('location:../../sanpham.php?messagethongbao=Thanh Toán Thành công!!');
   exit();
    }
}
?>