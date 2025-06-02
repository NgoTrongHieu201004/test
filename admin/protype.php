<?php
include "header.php";
include "sidebar.php";
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom current"><i
                    class="icon-home"></i> Home</a></div>
        <h1>Manage ProType</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><a href="form_add_type.php"> <i class="icon-plus"></i>
                            </a></span>
                        <h5>ProType</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered
                                    table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                <?php foreach ($getAllItem = $protype->getAllProtypes() as $values) {
                            
                                    ?>
                                    <tr class="">
                                        <td><?php echo $values['name_type']; ?></td>

                                        <td>
                                            <a href="update_protype.php?id_type=<?php echo $values['id_type']; ?>" class="btn
                                    btn-success btn-mini">Edit</a>
                                    <a href="#" class="btn btn-danger btn-mini" onclick="confirmDelete(<?php echo $values['id_type']; ?>)">Delete</a>
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
</div>
<script type="text/javascript">
    // Hàm hiển thị hộp thoại xác nhận
    function confirmDelete(id_manu) {
        if (confirm("Bạn có muốn xóa Type này?")) {
            window.location.href = "./xulyCRUD_admin/xulyXoa.php?id_type=" + id_manu; // Chuyển hướng đến trang xóa
        }
    }
</script>
<!-- END CONTENT -->
<?php include "footer.php" ?>