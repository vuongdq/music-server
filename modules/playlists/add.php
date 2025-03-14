<?php
require '../includes/functions.php'; // Sửa từ '../../includes/functions.php'
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $thumbnail = uploadFile($_FILES['thumbnail'], '../../assets/images/', ['jpg', 'png']);
    $user_id = $_SESSION['user_id'];
    $conn->query("INSERT INTO playlists (name, thumbnail, user_id) VALUES ('$name', '$thumbnail', $user_id)");
    header('Location: ../../public/manage.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm Playlist</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <div class="container">
        <h2>Thêm Playlist</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Tên playlist" required>
            <input type="file" name="thumbnail" accept="image/*">
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="../../public/manage.php" class="btn btn-warning">Quay lại</a>
        </form>
    </div>
</body>
</html>