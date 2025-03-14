<?php
require '../includes/functions.php'; // Sửa từ '../../includes/functions.php'
$id = (int)$_GET['id'];
$playlist = $conn->query("SELECT * FROM playlists WHERE id = $id AND user_id = {$_SESSION['user_id']}")->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $thumbnail = $_POST['old_thumbnail'];
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        deleteFile($thumbnail);
        $thumbnail = uploadFile($_FILES['thumbnail'], '../../assets/images/', ['jpg', 'png']);
    }
    $conn->query("UPDATE playlists SET name='$name', thumbnail='$thumbnail' WHERE id=$id");
    header('Location: ../../public/manage.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa Playlist</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <div class="container">
        <h2>Sửa Playlist</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="old_thumbnail" value="<?php echo $playlist['thumbnail']; ?>">
            <input type="text" name="name" value="<?php echo $playlist['name']; ?>" required>
            <input type="file" name="thumbnail" accept="image/*">
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="../../public/manage.php" class="btn btn-warning">Quay lại</a>
        </form>
    </div>
</body>
</html>