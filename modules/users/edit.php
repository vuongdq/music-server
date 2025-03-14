<?php
require '../includes/functions.php'; // Sửa từ '../../includes/functions.php'
checkRole('admin');
$id = (int)$_GET['id'];
$user = $conn->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $role = $_POST['role'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];
    $conn->query("UPDATE users SET username='$username', password='$password', role='$role' WHERE id=$id");
    header('Location: ../../public/manage.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa User</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <div class="container">
        <h2>Sửa User</h2>
        <form method="POST">
            <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
            <input type="password" name="password" placeholder="Mật khẩu mới (để trống nếu không đổi)">
            <select name="role" required>
                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="editor" <?php if ($user['role'] == 'editor') echo 'selected'; ?>>Editor</option>
            </select>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="../../public/manage.php" class="btn btn-warning">Quay lại</a>
        </form>
    </div>
</body>
</html>