<?php
include "header.php";
include "sidebar.php";
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i> Home</a></div>
        <?php if(isset($_GET['key'])&& $_GET['key']!=''){ 
            $key = $_GET['key'];
            $searchAll =  $products->SreachAllItemBy($key);  
            if(empty($searchAll)){echo "Không Tìm Thấy Sản phẩm với từ khoá $key !";}else{
            $url =$_SERVER['PHP_SELF']."?key=".$key;
            $offset = 4 ; 
            $page = isset($_GET['page'])? $_GET['page']:1; 
            $perpage = 3 ; 
            $total = count ($searchAll); ?>
        <h6> Kết Quả:  <?php echo $total ;?> sản phẩm được tìm thấy trùng khớp với từ khoá "<?php echo $key ;  ?>"</h6>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><a href="form.html"> <i class="icon-plus"></i>
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
                                foreach($products->SreachLimitItem($key,$page,$perpage) as $values){
                                 ?>
                                <tr class="">
                                    <td width="250">
                                        <img src="../public/img/<?php echo $values['image']; ?>" />
                                    </td>
                                    <td><?php echo $values['name']; ?></td>                                 
                                    <td> <?php echo substr($values['description'],0,200) ; ?></td>
                                    <td><?php echo $manufacture->HienThiMotManu($values['manu_id'])['name_manu']; ?></td>                                  
                                    <td><?php echo $values['feature']; ?></td> 
                                    <td><?php echo number_format($values['price'], 0, '', '.'); ?>₫</td>
                                    <td><?php echo $protype->HienThiMotType($values['type_id'])['name_type']; ?></td>
                                    <td><?php echo $values['create_at']; ?></td>
                                    <td>
                                        <a style = "margin: 10px;" href="#45" class="btn
                                                    btn-success btn-mini">Edit</a>
                                        <a href="#45" class="btn
                                                    btn-danger btn-mini">Delete</a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <div class="row" style="margin-left: 18px;">
                            <ul class="pagination">
                              <?php echo $products->PaginateVer($url, $total, $perpage, $offset, $page)?> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }}else{echo "Vui Lòng nhập từ khoá !";}  ?>
</div>
<!-- END CONTENT -->
<?php include "footer.php" ?>