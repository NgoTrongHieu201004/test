<?php
include "../../config.php";
include "../models/db.php";
include "../models/product.php";
$product = new Product();

if (isset($_POST['submit']) &&isset($_GET['id_product'])) {
    $id = $_GET['id_product'];
    $name = $_POST['name'];
    $manu_id = $_POST['manu'];
    $price = $_POST['price'];
    if ($_FILES["fileUpload"]["name"]) {
        $image = basename($_FILES["fileUpload"]["name"]);
    } else {
       
        $currentProduct = $product->HienThimotProductimg($id);
        $image = $currentProduct['image']; 
        var_dump($image);
    }
    $description = $_POST['description'];
    $feature = $_POST['featured'];
    $type_id = $_POST['type'];

    if ($product->SuaProduct($id, $name, $manu_id, $price, $image, $description, $feature, $type_id)) {
       if ($_FILES["fileUpload"]["name"]) {
        $target_dir = "../.././public/img/";
        $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
        move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file);
    }
    header('Location: .././product.php');
       
    }
}
?>