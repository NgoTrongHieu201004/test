<?php

include "../../config.php";
include "../models/db.php";
include "../models/protype.php";

$type = new Protype();
if (isset($_POST['submit'])) {
  
   $name_type = $_POST['name'];
   
   if($type->ThemProType($name_type)) {
    header('location:.././protype.php');
   }
}


?>