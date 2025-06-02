<?php
class User extends Db {
    public function getAllUser() {
        $sql = self::$connection->prepare("SELECT * FROM users ORDER BY created_at DESC");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getUser($id) {
        $sql = self::$connection->prepare("SELECT * FROM users WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }


    function DeleteUser($id) {
        $sql = self::$connection->prepare("DELETE FROM `users` WHERE `id` = ?");
        $sql->bind_param("i", $id);
        $sql->execute();
    }
     //Phân trang
     public function getProductsByLimit($page, $perPage)
     {
         $start = ($page - 1) * $perPage;
         $sql = self::$connection->prepare("SELECT * FROM users ORDER BY created_at DESC LIMIT ?, ?");
         $sql->bind_param("ii", $start, $perPage);
         $sql->execute(); // Thực thi câu lệnh SQL
         $items = array();
         $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
         return $items; // Trả về mảng các sản phẩm
     }
 
 
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