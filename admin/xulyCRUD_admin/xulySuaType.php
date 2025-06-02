<?php

include "../../config.php";
include "../models/db.php";
include "../models/protype.php";

$type = new Protype();

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    if ($type->SuaProduct($id,$name)) {
        header('location:.././protype.php');
    }
}

?>