
<?php
require "../../config.php";
require "../models/db.php";
require "../models/carts.php";

if (isset($_GET['idUser']) && isset($_GET['idProduct'])) {
   $id_user = $_GET['idUser'];
   $id_product = $_GET['idProduct'];
   $cart = new Carts();
   $cart->XoaCart($id_user,$id_product);
   header('location:../../cart.php');
}
?>