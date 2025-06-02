<?php
include "header.php";
include "sidebar.php";

// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'nhom5');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_manu = $_POST['id_manu']; // Lấy ID nhà sản xuất
    $name_manu = $_POST['name_manu']; // Tên nhà sản xuất

    // Kiểm tra nếu có file ảnh được upload
    $image = basename($_FILES["fileUpload"]["name"]);
    $target_dir = "../public/img/";
    $target_file = $target_dir . $image;

    // Câu lệnh thêm vào database
    $sql = "INSERT INTO manufactures (id_manu, name_manu, icon) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $id_manu, $name_manu, $image);

    if ($stmt->execute()) {
        // Upload file ảnh lên server
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            echo "<script>alert('Manufacturer Thêm Thành Công!'); window.location.href='manufacture.php';</script>";
        } else {
            echo "<script>alert('Error uploading image.');</script>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="#" title="Go to Home" class="tip-bottom current">
                <i class="icon-home"></i> Home
            </a>
        </div>
        <h1>Add New Manufacturer</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> 
                        <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Manufacturer Info</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <!-- BEGIN FORM -->
                        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">ID (Hệ Thống Tạo ID)</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="id_manu" /> *
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Name</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="name_manu" required /> *
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"> Image (Icon)</label>
                                <div class="controls">
                                    <div class="card h-100 product-card">
                                        <div class="position-relative">
                                            <img id="previewImg" src="../public/img/placeholder.jpg" style="height: 350px;
                                                object-fit: scale-down; transition: transform 0.3s ease;" class="card-img-top" alt="Preview">
                                        </div>
                                    </div>
                                    <input type="file" name="fileUpload" id="fileUpload" onchange="showFileName()" required>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-success">Add Manufacturer</button>
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
<?php include "footer.php"; ?>

<script>
// Preview selected image
function showFileName() {
    var fileInput = document.getElementById('fileUpload');
    var file = fileInput.files[0];

    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
}
</script> 
