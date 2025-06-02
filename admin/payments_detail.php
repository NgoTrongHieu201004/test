<?php
include "header.php";
include "sidebar.php";
?>
<div id="content">
<div class="container">
        <!-- Order Info Section -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Order Details</h4>
            </div>
            <?php
                $detail = $thanhtoan->HienThiTheoID($_GET['id']);
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6><strong>Buyer Name:</strong> <?php echo $user->getUser($detail[0]['id_user'])[0]['username'] ?></h6>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h6><strong>Order Date:</strong> <?php echo $detail[0]['created_at'] ?></h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product List Section -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Products</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                               foreach($thanhtoan->HienThiSanPhamTheoDon($detail[0]['id']) as $values):
                               
                            ?>
                            <tr>
                                <td><img src="../public/img/<?php echo $products->HienThimotProductimg($values['id_product'])['image'] ?>" alt="Product 1" class="img-thumbnail" style="height: 150px;"></td>
                                <td><?php echo $products->HienThimotProductimg($values['id_product'])['name'] ?></td>
                                <td><?php echo $values['soluong'] ?></td>
                                <td><?php echo number_format($values['price'], 0, ',', '.') ?> VNĐ</td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Total Price Section -->
        <div class="card">
            <div class="card-body text-end">
                <h5><strong>Total Price:</strong> <?php echo number_format($detail[0]['tongtien'], 0, ',', '.') ?> VNĐ</h5>
            </div>
        </div>
    </div>


</div>




<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>