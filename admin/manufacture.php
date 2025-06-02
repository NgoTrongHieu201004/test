<?php
include "header.php";
include "sidebar.php";
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom current"><i
                    class="icon-home"></i> Home</a></div>
        <h1>Manage Categories</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><a href="form_add_manu.php"> <i class="icon-plus"></i>
                            </a></span>
                        <h5>Manufacture</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered
                                    table-striped">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_GET['id_manu'])) {
                                    $manufacture->DeleteManu($_GET['id_manu']);
                                } ?>
                                <?php foreach ($getAllItem = $manufacture->getAllManu() as $values) {
                                    $imageName = strtolower(str_replace(' ', '_', $values['icon']));
                                    ?>
                                    <tr class="">
                                        <td width="100"> <img src="../public/img/<?php echo $imageName; ?>"
                                                alt="<?php echo $values['icon']; ?>" width="100" /></td>
                                        <td><?php echo $values['name_manu']; ?></td>

                                        <td>
                                            <a href="edit_manu.php?id_manu=<?php echo $values['id_manu']; ?>" class="btn
                                    btn-success btn-mini">Edit</a>
                                    <a href="#" class="btn btn-danger btn-mini" onclick="confirmDelete(<?php echo $values['id_manu']; ?>)">Delete</a>
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
        if (confirm("Bạn có muốn xóa manufacture này?")) {
            window.location.href = "manufacture.php?id_manu=" + id_manu; // Chuyển hướng đến trang xóa
        }
    }
</script>
<!-- END CONTENT -->
<?php include "footer.php" ?>