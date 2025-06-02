<?php
include "header.php";
include "sidebar.php";

// Database connection
$conn = new mysqli('localhost', 'root', '', 'nhom5');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET username = ?, email = ?, role = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $username, $email, $role, $password, $id);
    } else {
        $sql = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $role, $id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('User updated Thành Công!'); window.location.href='users.php';</script>";
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
        <h1>Edit User</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> 
                        <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>User Info</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <!-- BEGIN FORM -->
                        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <div class="control-group">
                                <label class="control-label">Username</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="username" value="<?php echo $user['username']; ?>" required /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" class="span11" name="email" value="<?php echo $user['email']; ?>" required /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Role</label>
                                <div class="controls">
                                    <select name="role" class="span11" required>
                                    <option value="User" <?php echo ($user['role'] == 'User') ? 'selected' : ''; ?>>User</option>
                                        <option value="Admin" <?php echo ($user['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                        
                                       
                                    </select> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password (Để trống giữ password hiện tại)</label>
                                <div class="controls">
                                    <input type="password" class="span11" name="password" />
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Update</button>
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
<?php include "footer.php" ?>
