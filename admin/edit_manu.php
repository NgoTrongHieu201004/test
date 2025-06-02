<?php
include "header.php";
include "sidebar.php";

// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'nhom5');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra nếu có tham số id_manu trong URL
if (isset($_GET['id_manu'])) {
    $id_manu = $_GET['id_manu'];
    
    // Lấy thông tin nhà sản xuất từ cơ sở dữ liệu
    $sql = "SELECT * FROM manufactures WHERE id_manu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id_manu);
    $stmt->execute();
    $result = $stmt->get_result();
    $manufacturer = $result->fetch_assoc();
    
    // Nếu không tìm thấy nhà sản xuất
    if (!$manufacturer) {
        echo "<script>alert('Manufacturer not found.'); window.location.href='manufacture.php';</script>";
        exit;
    }

    // Xử lý khi form được submit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name_manu = $_POST['name_manu']; // Tên nhà sản xuất

        // Kiểm tra nếu có file ảnh được upload
        $image = basename($_FILES["fileUpload"]["name"]);
        if (!empty($image)) {
            $target_dir = "../public/img/";
            $target_file = $target_dir . $image;
        } else {
            // Giữ nguyên hình ảnh cũ nếu không upload ảnh mới
            $image = $manufacturer['icon'];
        }

        // Câu lệnh cập nhật vào database
        $sql = "UPDATE manufactures SET name_manu = ?, icon = ? WHERE id_manu = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name_manu, $image, $id_manu);

        if ($stmt->execute()) {
            // Upload file ảnh lên server nếu có ảnh mới
            if (!empty($image) && move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
                echo "<script>alert('Manufacturer updated successfully!'); window.location.href='manufacture.php';</script>";
            } else {
                echo "<script>alert('Manufacturer updated without image.'); window.location.href='manufacture.php';</script>";
            }
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }
} else {
    echo "<script>alert('No manufacturer ID provided.'); window.location.href='manufacture.php';</script>";
    exit;
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
        <h1>Edit Manufacturer</h1>
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
                                <label class="control-label">Manufacturer ID</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="id_manu" value="<?php echo $manufacturer['id_manu']; ?>" readonly /> *
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Manufacturer Name</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="name_manu" value="<?php echo $manufacturer['name_manu']; ?>" required /> *
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Manufacturer Image (Icon)</label>
                                <div class="controls">
                                    <div class="card h-100 product-card">
                                        <div class="position-relative">
                                            <img id="previewImg" src="../public/img/<?php echo $manufacturer['icon']; ?>" style="height: 350px;
                                                object-fit: scale-down; transition: transform 0.3s ease;" class="card-img-top" alt="Preview">
                                        </div>
                                    </div>
                                    <input type="file" name="fileUpload" id="fileUpload" onchange="showFileName()">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-success">Update Manufacturer</button>
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
