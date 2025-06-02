<?php
include "header.php";
include "sidebar.php";
?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom current"><i
                    class="icon-home"></i> Home</a></div>
        <h1>Manage Payments</h1>
    </div>
    <div class="container">
    <hr>

        <!-- Card chứa Danh Sách Đơn Hàng -->
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Danh Sách Đơn Hàng</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Price</th>
                            <th>created_at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="orderList">
                        
                         <?php
                                $url = $_SERVER['PHP_SELF'];
                                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                                $perPage = 5;
                                // Lấy tổng số sản phẩm
                                $total = count($thanhtoan->HienThiAll()); // Cập nhật hàm getAllProducts để lấy tổng số sản phẩm
                                $PaginateVer = $thanhtoan->PaginateVerPayments($url, $total, $perPage, 3, $page);
                                foreach ($thanhtoan->getAllsByLimit($page, $perPage) as $key => $values):
                                    ?>
                        <tr>
                            <td><?php echo $user->getUser($values['id_user'])[0]['username'] ?></td>
                            <td><?php echo $user->getUser($values['id_user'])[0]['email'] ?></td>
                            <td><?php echo number_format($values['tongtien'], 0, ',', '.') ?> VNĐ</td>
                            <td><?php echo $values['created_at'] ?></td>
                            <td><a href="payments_detail.php?id=<?php echo $values['id']; ?>" class="btn
                                    btn-success btn-mini">detail</a></td>
                        </tr> 
                        <?php endforeach?>
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







<?php include "footer.php"; ?>