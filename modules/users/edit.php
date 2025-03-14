<?php
require '../../includes/functions.php';
checkRole('admin');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
    header('Location: ../../public/manage.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm User</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <div class="container">
        <h2>Thêm User</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
            </select>
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="../../public/manage.php" class="btn btn-warning">Quay lại</a>
        </form>
    </div>
</body>
</html>