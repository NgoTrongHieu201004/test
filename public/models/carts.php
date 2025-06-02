<?php

class Carts extends db
{
    public function ThemCart($id_user, $id_product, $soluong)
    {
        $sql = self::$connection->query("INSERT INTO carts(id_user,id_product,soluong) values ('$id_user','$id_product','$soluong')");
    }
    public function HienThiCarts()
    {
        $sql = self::$connection->prepare("SELECT * FROM carts");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    public function HienThiCart_User($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM carts WHERE id_user = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function HienThiMotCart_User($id_user, $id_product)
    {
        $sql = self::$connection->prepare("SELECT * FROM carts WHERE id_user = ? AND id_product = ?");
        $sql->bind_param("ii", $id_user, $id_product);
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_assoc();  // Trả về một mảng hoặc null nếu không tìm thấy.
    }
    public function XoaCart($id_user, $id_product)
    {
        // Chuẩn bị câu lệnh SQL với dấu hỏi thay cho tham số
        $sql = self::$connection->prepare("DELETE FROM carts WHERE id_user = ? AND id_product = ?");
        $sql->bind_param("ii", $id_user, $id_product);
        $sql->execute();
        if ($sql->affected_rows > 0) {
            echo "Xóa thành công!";
        } else {
            echo "Không tìm thấy sản phẩm trong giỏ hàng để xóa.";
        }
        $sql->close();
    }
    public function XoaCart_idUser($id_user)
    {
        // Chuẩn bị câu lệnh SQL với dấu hỏi thay cho tham số
        $sql = self::$connection->prepare("DELETE FROM carts WHERE id_user = ? ");
        $sql->bind_param("i", $id_user);
        $sql->execute();
        if ($sql->affected_rows > 0) {
            echo "Xóa thành công!";
        } else {
            echo "Không tìm thấy sản phẩm trong giỏ hàng để xóa.";
        }
        $sql->close();
    }

    public function SuaCart($id_user, $id_product, $soluong)
    {
        $sql = self::$connection->prepare("UPDATE carts SET soluong = ? WHERE id_user = ? AND id_product = ?");
        $sql->bind_param("iii", $soluong, $id_user, $id_product);
        $sql->execute();
        if ($sql->affected_rows > 0) {
            echo "Cập nhật thành công!";
        } else {
            echo "Không tìm thấy sản phẩm trong giỏ hàng để cập nhật.";
        }
        $sql->close();
    }



}