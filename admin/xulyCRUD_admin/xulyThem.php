<?php

include "../../config.php";
include "../models/db.php";
include "../models/product.php";

$product = new Product();


if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $manu_id = $_POST['manu'];
   $price = $_POST['price'];
   $image = basename($_FILES["fileUpload"]["name"]);
   $description = $_POST['description'];
   $feature = $_POST['featured'];
   $type_id = $_POST['type'];


   if ($product->ThemProduct($name,$manu_id,$price,$image,$description,$feature,$type_id)) {
    $target_dir = "../.././public/img/";
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
     move_uploaded_file($_FILES["fileUpload"]["tmp_name"],$target_file);
     header('location:.././product.php');
   }

}

?>