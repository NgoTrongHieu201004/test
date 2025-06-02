<?php

class Protypes extends db
{
    public function HienThiType()
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function HienThiMotType($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes WHERE id_type = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
}
