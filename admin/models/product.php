<?php
class Product extends Db
{
    //Viet phuong thuc lay ra tat ca san pham moi nhat
    public function HienThiMotSanPham($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function HienThimotProductimg($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        return $sql->get_result()->fetch_assoc(); // Trả về một dòng dưới dạng mảng liên kết
    }
    public function HienThiSanPhamMoiAdmin()
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY create_at DESC");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    public function ThemProduct($name, $manu_id, $price, $image, $description, $feature, $type_id)
    {
        $sql = self::$connection->query("INSERT INTO `products`(`name`, `manu_id`, `price`, `image`, `description`, `feature`, `type_id`) VALUES
         ('$name','$manu_id','$price','$image','$description','$feature','$type_id')");
        // Kiểm tra và trả về kết quả
        if ($sql) {
            return true; // Truy vấn thành công
        } else {
            return false; // Truy vấn thất bại
        }
    }
    public function XoaProduct($id_product)
    {
        // Chuẩn bị câu lệnh SQL với dấu hỏi thay cho tham số
        $sql = self::$connection->prepare("DELETE FROM products WHERE  id = ?");
        $sql->bind_param("i", $id_product);
        $sql->execute();
        if ($sql->affected_rows > 0) {
            echo "Xóa thành công!";
        } else {
            echo "Không tìm thấy sản phẩm trong giỏ hàng để xóa.";
        }
        $sql->close();
    }
    public function SuaProduct($id, $name, $manu_id, $price, $image, $description, $feature, $type_id)
    {
        // Chuẩn bị câu lệnh UPDATE
        $sql = self::$connection->prepare("UPDATE `products` 
                                           SET `name` = ?, `manu_id` = ?, `price` = ?, `image` = ?, 
                                               `description` = ?, `feature` = ?, `type_id` = ? 
                                           WHERE `id` = ?");

        // Ràng buộc tham số vào câu lệnh SQL
        $sql->bind_param("siissssi", $name, $manu_id, $price, $image, $description, $feature, $type_id, $id);

        // Thực thi câu lệnh SQL
        if ($sql->execute()) {
            return true;  // Thành công
        } else {
            return false; // Thất bại
        }
    }

    //Phân trang
    public function getProductsByLimit($page, $perPage)
    {
        $start = ($page - 1) * $perPage;
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY create_at DESC LIMIT ?, ?");
        $sql->bind_param("ii", $start, $perPage);
        $sql->execute(); // Thực thi câu lệnh SQL
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; // Trả về mảng các sản phẩm
    }


    // phân trang tìm kiếm product
    public function PaginateVer($url, $total, $perPage, $offset, $page)
    {
        // Nếu tổng số sản phẩm <= 0, không có phân trang
        if ($total <= 0)
            return "";

        // Tổng số trang
        $totalLinks = ceil($total / $perPage);

        // Nếu chỉ có 1 trang, không cần phân trang
        if ($totalLinks <= 1)
            return "";

        // Điều chỉnh $page nằm trong phạm vi hợp lệ
        if ($page < 1)
            $page = 1;
        if ($page > $totalLinks)
            $page = $totalLinks;

        // Xác định phạm vi trang hiển thị
        $from = $page - $offset;
        $to = $page + $offset;

        // Đảm bảo $from và $to không vượt quá giới hạn
        if ($from < 1) {
            $from = 1;
            $to = min($offset * 2, $totalLinks);
        }
        if ($to > $totalLinks) {
            $to = $totalLinks;
            $from = max(1, $totalLinks - $offset * 2 + 1);
        }

        // Liên kết trước
        $prevLink = "";
        if ($page > 1) {
            $prev = $page - 1;
            $prevLink = "<li class='page-item'><a class='page-link' href='$url&page=$prev'>Trước</a></li>";
        }

        // Liên kết tiếp
        $nextLink = "";
        if ($page < $totalLinks) {
            $next = $page + 1;
            $nextLink = "<li class='page-item'><a class='page-link' href='$url&page=$next'>Tiếp</a></li>";
        }

        // Tạo các liên kết phân trang
        $link = "";
        for ($i = $from; $i <= $to; $i++) {
            $activeClass = ($i == $page) ? " active" : ""; // Trang hiện tại
            $link .= "<li class='page-item$activeClass'><a class='page-link' href='$url&page=$i'>$i</a></li>";
        }

        // Trả về chuỗi HTML hoàn chỉnh
        return $prevLink . $link . $nextLink;
    }
    //phan trang product
    public function PaginateVer2($url, $total, $perPage, $offset, $page)
    {
        // Nếu tổng số sản phẩm <= 0, không có phân trang
        if ($total <= 0)
            return "";

        // Tổng số trang
        $totalLinks = ceil($total / $perPage);

        // Nếu chỉ có 1 trang, không cần phân trang
        if ($totalLinks <= 1)
            return "";

        // Điều chỉnh $page nằm trong phạm vi hợp lệ
        if ($page < 1)
            $page = 1;
        if ($page > $totalLinks)
            $page = $totalLinks;

        // Xác định phạm vi trang hiển thị
        $from = $page - $offset;
        $to = $page + $offset;

        // Đảm bảo $from và $to không vượt quá giới hạn
        if ($from < 1) {
            $from = 1;
            $to = min($offset * 2, $totalLinks);
        }
        if ($to > $totalLinks) {
            $to = $totalLinks;
            $from = max(1, $totalLinks - $offset * 2 + 1);
        }

        // Liên kết trước
        $prevLink = "";
        if ($page > 1) {
            $prev = $page - 1;
            $prevLink = "<li class='page-item'><a class='page-link' href='$url?page=$prev'>Trước</a></li>";
        }

        // Liên kết tiếp
        $nextLink = "";
        if ($page < $totalLinks) {
            $next = $page + 1;
            $nextLink = "<li class='page-item'><a class='page-link' href='$url?page=$next'>Tiếp</a></li>";
        }

        // Tạo các liên kết phân trang
        $link = "";
        for ($i = $from; $i <= $to; $i++) {
            $activeClass = ($i == $page) ? " active" : ""; // Trang hiện tại
            $link .= "<li class='page-item$activeClass'><a class='page-link' href='$url?page=$i'>$i</a></li>";
        }

        // Trả về chuỗi HTML hoàn chỉnh
        return $prevLink . $link . $nextLink;
    }

     public function SreachAllItemBy($key){
        $name = '%'.$key.'%';
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE name like ? ");
        $sql->bind_param('s',$name);
        $sql->execute();
        $products = array();
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $products;
     }
     public function SreachLimitItem($key,$page,$count){
        $start = ($page-1)*$count;
        $name = '%'.$key.'%';
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE name like ? LIMIT ?,? ");
        $sql->bind_param('sii',$name,$start, $count );
        $sql->execute();
        $products = array();
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $products;
     }
     

}