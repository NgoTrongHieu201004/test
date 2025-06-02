<?php

class ThanhToan extends db{
    
    public function ThemSanPhamThanhToan($payment_id, $id_product, $soluong, $price)
    {
        $sql = self::$connection->query("INSERT INTO `payment_details`(`payment_id`, `id_product`, `soluong`, `price`) VALUES ('$payment_id',' $id_product','$soluong','$price')");
        // Kiểm tra và trả về kết quả
        if ($sql) {
            return true; // Truy vấn thành công
        } else {
            return false; // Truy vấn thất bại
        }
    }
    public function ThemDonThanhToan($id_user, $tongtien)
    {
        $sql = self::$connection->query("INSERT INTO `payments`(`id_user`, `tongtien`) VALUES ('$id_user','$tongtien')");
        if ($sql) {
            return self::$connection->insert_id; 
        } else {
            return false; 
        }
    }
    
    public function HienThiDon($id_user)
    {
        $sql = self::$connection->prepare("SELECT * FROM payments WHERE id_user = ? ORDER BY created_at DESC");
        $sql->bind_param("i", $id_user); // "i" là kiểu dữ liệu Integer
        $sql->execute(); // Thực thi câu lệnh SQL
        $items = array();
        $result = $sql->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);
        return $items; 
    }
    
public function HienThiSanPhamTheoDon($id_payment)
{
    $sql = self::$connection->prepare("SELECT * FROM payment_details WHERE payment_id = ?");
    $sql->bind_param("i", $id_payment); // "i" là kiểu dữ liệu Integer
    $sql->execute(); // Thực thi câu lệnh SQL
    $items = array();
    $result = $sql->get_result();
    $items = $result->fetch_all(MYSQLI_ASSOC);
    return $items; 
}

    function LayIDDonThanhToan($idUser, $tongtien) {
        $query = "INSERT INTO payments (id_user, tongtien) VALUES ('$idUser', '$tongtien')";
        if (mysqli_query($this->conn, $query)) {
            return mysqli_insert_id($this->conn);  
        }
        return false;  // In case of failure
    }

    //bieu đồ
    public function HienThiTienTheoThang(){
        $sql = self::$connection->prepare(" SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, 
            SUM(tongtien) AS total FROM payments 
            GROUP BY month 
            ORDER BY month ASC ");
        $sql->execute();
        $result = $sql->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);
        return $items; 
    }

    public function HienThiAll()
    {
        $sql = self::$connection->prepare("SELECT * FROM payments ORDER BY created_at DESC");
        $sql->execute(); // Thực thi câu lệnh SQL
        $items = array();
        $result = $sql->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);
        return $items; 
    }
    public function HienThiTheoID($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM payments WHERE id = ?");
        $sql->bind_param("i", $id); // "i" là kiểu dữ liệu Integer
        $sql->execute(); // Thực thi câu lệnh SQL
        $items = array();
        $result = $sql->get_result();
        $items = $result->fetch_all(MYSQLI_ASSOC);
        return $items; 
    }
    public function getAllsByLimit($page, $perPage)
    {
        $start = ($page - 1) * $perPage;
        $sql = self::$connection->prepare("SELECT * FROM payments ORDER BY created_at DESC LIMIT ?, ?");
        $sql->bind_param("ii", $start, $perPage);
        $sql->execute(); // Thực thi câu lệnh SQL
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; // Trả về mảng các sản phẩm
    }
    //phan trang product
    public function PaginateVerPayments($url, $total, $perPage, $offset, $page)
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
    
}

?>