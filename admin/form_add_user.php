<?php
include "header.php";
include "sidebar.php";
?>
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="#" title="Go to Home" class="tip-bottom current">
                <i class="icon-home"></i> Home
            </a>
        </div>
        <h1>Add User</h1>
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
                            <div class="control-group">
                                <label class="control-label">Username</label>
                                <div class="controls">
                                    <input type="text" class="span11" name="username" required /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                    <input type="password" class="span11" name="password" required /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" class="span11" name="email" required /> *
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Role</label>
                                <div class="controls">
                                    <select name="role" class="span11" required>
                                        <option value="">-- Select Role --</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                        
                                    </select> *
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Add</button>
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
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate random ID
    $id = uniqid();
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'nhom5');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user into database
    $sql = "INSERT INTO users (id, username, password, email, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $id, $username, $password, $email, $role);

    if ($stmt->execute()) {
        echo "<script>alert('User THêm Thành Công!'); window.location.href='users.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
<?php include "footer.php" ?>
