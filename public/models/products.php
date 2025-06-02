<?php

class Products extends db
{
    public function HienThi()
    {
        $sql = self::$connection->prepare("SELECT * FROM products");
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array

    }
    public function HienThiMotSanPham($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
   
    public function HienThiSanPhamMoi($start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM products ORDER BY create_at DESC LIMIT ?,?");
        $sql->bind_param("ii", $start, $count);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }

    public function getProductsByTypeAndManu($manu_id, $type_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE manu_id = ? AND type_id = ?");

        $sql->bind_param("ii", $manu_id, $type_id); // "ii" biểu thị 2 tham số kiểu integer
        $sql->execute(); // Thực thi câu lệnh SQL
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; // Trả về mảng các sản phẩm
    }

    public function getProductsByTypeAndManuLimit($manu_id, $type_id,$page,$perPage)
    {
        $start = ($page-1)*$perPage;
        $sql = self::$connection->prepare("SELECT * FROM products WHERE manu_id = ? AND type_id = ? LIMIT ?,?");

        $sql->bind_param("iiii", $manu_id, $type_id,$start,$perPage); // "ii" biểu thị 2 tham số kiểu integer
        $sql->execute(); // Thực thi câu lệnh SQL
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; // Trả về mảng các sản phẩm
    }


    public function getFeaturedItem($start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE featured = 1 ORDER BY created_at DESC LIMIT ?,?");
        $sql->bind_param("ii", $start, $count);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function  Search($keyword, $start, $count)
    {
        $sql = self::$connection->prepare("SELECT * FROM items WHERE content LIKE ? LIMIT ?,?");
        $keyword = "%$keyword%";
        $sql->bind_param("sii", $keyword, $start, $count);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }


    public function  getAllIteByCate($cate_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM items WHERE category = ?");

        $sql->bind_param("i", $cate_id);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function getItemByCate($cate_id, $page, $count)
    {
        $start = ($page - 1) * $count;
        $sql = self::$connection->prepare("SELECT * FROM items WHERE category = ? LIMIT ?,?");
        $sql->bind_param("iii", $cate_id, $start, $count);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array
    }
    public function paginate($url, $total, $perPage)
    {
        $totalLinh = ceil($total / $perPage);
        $link = "";
        for ($i = 1; $i <= $totalLinh; $i++) {
            # code...
            $link = $link . "<a class='badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2' href ='{$url}&page={$i}'> $i </a>";
        }
        return $link;
    }
    public function getSearchLimit($keys, $count, $page)
    {

        $start = ($page - 1) * $count;
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE name LIKE ? LIMIT ?,?");
        $key = "%$keys%";
        $sql->bind_param("sii", $key, $start, $count);
        $sql->execute();
        $products = array();
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $products;
    }
    public function getSearchAll($keys)
    {
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE name LIKE ?");
        $key = "%$keys%";
        $sql->bind_param("s", $key);
        $sql->execute();
        $products = array();
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $products;
    }
    public function paginateVer3($url, $total, $perPage, $page, $offset, $key)
    {
        if ($total <= 0) return "";
        $keys = trim($key);
        $totalLink = ceil($total / $perPage);
        if ($totalLink <= 1) return "";
        $from = $page - $offset;
        $to = $page + $offset;
        if ($from <= 0) {
            $from = 1;
            $to = $offset * 2;
        }
        if ($to > $totalLink) {
            $to = $totalLink;
        }
        $links = "";
        $prevLinks = "" ; 
        $nextLinks = "";
        if($page > 1){
            $prev = $page -1 ; 
            $prevLinks = "<li class='page-item  '><a class='page-link' href='result.php?keyfind=$keys&page=$prev'> Trước </a></li>";
        }
        if($page < $totalLink){
            $next = $page+1; 
            $nextLinks = "<li class='page-item  '><a class='page-link' href='result.php?keyfind=$keys&page=$next'> Tiếp </a></li>";
        }
        for ($i = $from; $i < $to; $i++) {
            $links = $links . "<li class='page-item  '><a class='page-link' href='result.php?keyfind=$keys&page=$i'> $i </a></li>";
        }
        return $prevLinks.$links.$nextLinks;
    }
    public function PaginateVer4($url, $total, $perPage, $offset, $page, $manu_id, $type_id) {
    // Nếu tổng số sản phẩm <= 0, không có phân trang
    if ($total <= 0) return "";

    // Tổng số trang
    $totalLinks = ceil($total / $perPage);

    // Nếu chỉ có 1 trang, không cần phân trang
    if ($totalLinks <= 1) return "";

    // Điều chỉnh $page nằm trong phạm vi hợp lệ
    if ($page < 1) $page = 1;
    if ($page > $totalLinks) $page = $totalLinks;

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
        $prevLink = "<li class='page-item'><a class='page-link' href='sanpham.php?page=$prev&manu-id=$manu_id&type-id=$type_id'>Trước</a></li>";
    }

    // Liên kết tiếp
    $nextLink = "";
    if ($page < $totalLinks) {
        $next = $page + 1;
        $nextLink = "<li class='page-item'><a class='page-link' href='sanpham.php?page=$next&manu-id=$manu_id&type-id=$type_id'>Tiếp</a></li>";
    }

    // Tạo các liên kết phân trang
    $link = "";
    for ($i = $from; $i <= $to; $i++) {
        $activeClass = ($i == $page) ? " active" : ""; // Trang hiện tại
        $link .= "<li class='page-item$activeClass'><a class='page-link' href='sanpham.php?page=$i&manu-id=$manu_id&type-id=$type_id'>$i</a></li>";
    }

    // Trả về chuỗi HTML hoàn chỉnh
    return $prevLink . $link . $nextLink;
}

    public function detailItems($id){
        $sql = self::$connection->prepare("SELECT * FROM `products` WHERE id = ?");
        $sql -> bind_param("i",$id);
        $sql ->execute();
        $products = array();
        $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $products;
    }

    public function HienThiSanPhamBanChay($count)
{
    $sql = self::$connection->prepare("SELECT products.*, SUM(payment_details.soluong) AS total_sold 
        FROM products 
        JOIN payment_details 
        ON products.id = payment_details.id_product 
        GROUP BY products.id
        ORDER BY total_sold DESC 
        LIMIT $count
    ");
    $sql->execute(); // Execute the query
    $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC); // Fetch results as associative array
    return $items; // Return the top 3 products
}

 public function HienThiSanPhamLienQuan($id,$type_id,$manu_id){
    $sql = self::$connection->prepare("SELECT DISTINCT *
                                       FROM `products`
                                       WHERE `products`.`type_id` = ? AND `products`.`manu_id` = ? AND `products`.`id` NOT LIKE ?
                                       ORDER BY `products`.`create_at`DESC
");
    $sql->bind_param("iii",$type_id,$manu_id,$id);
    $sql->execute();
    $products = array();
    $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    return $products;
 }
 public function HienThiSanPhamLienQuan2 ($id, $type_id ){
        
    if($type_id ==1 ){
        $type1=4;
        $type2=5;
    }else if($type_id ==4){
        $type1=1;
        $type2=5;
    }else{
        $type1=1;
        $type2=4;
    }
    
  
    $sql = self::$connection->prepare("SELECT DISTINCT *
                                       FROM `products`
                                       WHERE `products`.`type_id` = ? AND `products`.`type_id` = ? OR `products`.`type_id` = ? AND `products`.`id` NOT LIKE ?
                                       ORDER BY `products`.`create_at`DESC");
    $sql->bind_param("iiii",$type_id,$type1,$type2,$id);
    $sql->execute();
    $products = array();
    $products = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    return $products ; 
 }
}
