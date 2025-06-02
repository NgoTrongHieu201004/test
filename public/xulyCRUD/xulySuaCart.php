<?php
require "../../config.php";
require "../models/db.php";
require "../models/carts.php";

if (isset($_GET['idUser']) && isset($_GET['idProduct']) && isset($_GET['soluong'])) {
    $id_user = $_GET['idUser'];
    $id_product = $_GET['idProduct'];
    $soluong = $_GET['soluong']; // Số lượng từ AJAX

    // Tạo đối tượng Cart và gọi phương thức để sửa giỏ hàng
    $cart = new Carts();
    $cart->SuaCart($id_user, $id_product, $soluong);

    echo 'Số lượng đã được cập nhật!';
}