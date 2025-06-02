<?php
class Protype extends Db{
    //Viet phuong thuc lay ra tat ca san pham moi nhat
    function getAllProtypes(){
        $sql = self::$connection->prepare("SELECT * 
        FROM protypes ORDER BY created_at DESC");
        $sql->execute();//return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function HienThiMotType($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM protypes WHERE id_type = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc(); // Trả về một dòng dưới dạng mảng liên kết
    }
    public function XoaProType($id_type)
    {
        // Chuẩn bị câu lệnh SQL với dấu hỏi thay cho tham số
        $sql = self::$connection->prepare("DELETE FROM protypes WHERE id_type = ?");
        $sql->bind_param("i", $id_type);
        $sql->execute();
        if ($sql->affected_rows > 0) {
            echo "Xóa thành công!";
        } else {
            echo "Không tìm thấy sản phẩm trong giỏ hàng để xóa.";
        }
        $sql->close();
    }
    public function ThemProType($name_type)
    {
        $sql = self::$connection->query("INSERT INTO `protypes`(`name_type`) VALUES ('$name_type')");
        // Kiểm tra và trả về kết quả
        if ($sql) {
            return true; // Truy vấn thành công
        } else {
            return false; // Truy vấn thất bại
        }
    }
    public function SuaProduct($id, $name)
    {
        $sql = self::$connection->prepare("UPDATE `protypes` SET `name_type` = ? WHERE `id_type` = ?");
        $sql->bind_param("si", $name, $id);
        if ($sql->execute()) {
            return true;  // Thành công
        } else {
            return false; // Thất bại
        }
    }
    
}