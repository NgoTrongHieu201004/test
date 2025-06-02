<?php
include "header.php";
include "sidebar.php";

if (isset($_GET['id_type'])) {
   
    $id_type = $_GET['id_type'];
    $protypes = $protype->HienThiMotType($id_type);
}
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i>
                Home</a></div>
        <h1>Update Protypes</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i></span>
                        <h5>Protypes info</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <!-- BEGIN FORM -->
                        <form action="./xulyCRUD_admin/xulySuaType.php" method="post" class="form-horizontal"
                            enctype="multipart/form-data">
                            <input style="display: none;" type="text" class="span11" name="id" value="<?php echo $protypes['id_type'] ?>" />
                            <div class="control-group">
                                <label class="control-label">Name</label>
                                <div class="controls">
                                <input type="text" class="span11" name="name" value="<?php echo $protypes['name_type'] ?>" /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Choose
                                    icon </label>
                                <div class="controls">
                                    <input type="file" name="fileUpload" id="fileUpload">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END FORM -->
            </div>
        </div>
    </div>
</div>

<!-- END CONTENT -->
<?php  include "footer.php" ?>