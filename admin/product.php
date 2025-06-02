<?php
include "header.php";
include "sidebar.php";
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom current"><i
                    class="icon-home"></i> Home</a></div>
        <h1>Manage Products</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><a href="form_add_product.php"> <i
                                    class="icon-plus"></i>
                            </a></span>
                        <h5>Products</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered
                                    table-striped">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>name</th>
                                    <th>Descriptions</th>
                                    <th>Manu</th>
                                    <th>Feature</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $url = $_SERVER['PHP_SELF'];
                                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                                $perPage = 5;
                                // Lấy tổng số sản phẩm
                                $total = count($products->HienThiSanPhamMoiAdmin()); // Cập nhật hàm getAllProducts để lấy tổng số sản phẩm
                                $PaginateVer = $products->PaginateVer2($url, $total, $perPage, 3, $page);
                                foreach ($products->getProductsByLimit($page, $perPage) as $key => $values):
                                    ?>

                                    <tr class="">
                                        <td width="250">
                                            <img src="../public/img/<?php echo $values['image']; ?>" />
                                        </td>
                                        <td><?php echo $values['name']; ?></td>
                                        <td><?php echo substr($values['description'],0,200) ; ?></td>
                                        <td><?php echo $manufacture->HienThiMotManu($values['manu_id'])['name_manu']; ?>
                                        </td>
                                        <td><?php echo $values['feature']; ?></td>
                                        <td><?php echo number_format($values['price'], 0, '', '.') ?> đ</td>
                                        <td><?php echo $protype->HienThiMotType($values['type_id'])['name_type']; ?></td>
                                        <td><?php echo $values['create_at']; ?></td>
                                        <td>
                                            <a style = "margin: 10px;" href="./update_product.php?id_product=<?php echo $values['id']; ?>" class="btn
                                                    btn-success btn-mini">Edit</a>
                                            <a href="#"
                                            onclick="confirmDelete(<?php echo $values['id']; ?>)" class="btn
                                                    btn-danger btn-mini">Delete</a>

                                        </td>
                                    </tr>

                                <?php endforeach ?>
                            </tbody>

                        </table>
                        <div class="row" style="margin-left: 18px;">
                            <div class="col-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <?php echo $PaginateVer; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<?php include "footer.php" ?>
<script>
      function confirmDelete(id) {
        if (confirm("Bạn có muốn xóa Product này?")) {
            window.location.href = "./xulyCRUD_admin/xulyXoa.php?id_product=" + id; // Chuyển hướng đến trang xóa
        }
    }
</script>