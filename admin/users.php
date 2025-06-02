<?php
include "header.php";
include "sidebar.php";
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom current"><i
                    class="icon-home"></i> Home</a></div>
        <h1>Manage User</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><a href="form_add_user.php"> <i class="icon-plus"></i>
                            </a></span>
                        <h5>Products</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered
                                   table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['id'])) {
                                    $user->DeleteUser($_GET['id']);
                                } ?>
                                <?php foreach ($getAllItem = $user->getAllUser() as $values) {
                                    $quyen = "user";
                                    if ($values['role'] === 1) {
                                        $quyen = "admin";
                                    }
                                    ?>
                                    <tr class="">
                                        <td><?php echo $values['username']; ?></td>
                                        <td>*****</td>
                                        <td><?php echo $quyen ?></td>

                                        <td>
                                            <?php if ($values['role'] != 1) { ?>
                                                <a href="edit_user.php?id=<?php echo $values['id']; ?>"
                                                    class="btn btn-success btn-mini">Edit</a>
                                            <?php }  ?>
                                               
                                            <?php if ($values['role'] != 1) { ?>
                                                <!-- Cập nhật nút Delete để gọi hàm xác nhận -->
                                                <a href="#" class="btn btn-danger btn-mini" 
                                                   onclick="confirmDelete(<?php echo $values['id']; ?>)">Delete</a>
                                            <?php }  ?>
                                                 
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="row" style="margin-left: 18px;">
                            <ul class="pagination">
                                <li class="active">1</li>
                                <li>2</li>
                                <li>3</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->

<script type="text/javascript">
    // Hàm hiển thị hộp thoại xác nhận
    function confirmDelete(id) {
        if (confirm("Bạn có muốn xóa user?")) {
            window.location.href = "users.php?id=" + id; // Chuyển hướng đến trang xóa
        }
    }
</script>

<?php include "footer.php" ?>
