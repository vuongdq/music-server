<?php
require '../includes/config.php';
if (isset($_SESSION['user_id'])) {
    header('Location: manage.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location: manage.php');
            exit;
        }
    }
    $error = "Sai thông tin đăng nhập!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập - Music Server</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>