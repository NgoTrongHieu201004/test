<?php
class Manufacture extends Db{
    //Viet phuong thuc lay ra tat ca san pham moi nhat
    function getAllManu(){
        $sql = self::$connection->prepare("SELECT * 
        FROM manufactures ORDER BY created_at DESC");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function HienThiMotManu($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM manufactures WHERE id_manu = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc(); // Trả về một dòng dưới dạng mảng liên kết
    }
    function DeleteManu($id) {
        $sql = self::$connection->prepare("DELETE FROM `manufactures` WHERE `id_manu` = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
    }
    
    
    
    
}