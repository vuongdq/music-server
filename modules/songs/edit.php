<?php
require '../../includes/functions.php';
$id = (int)$_GET['id'];
$song = $conn->query("SELECT * FROM songs WHERE id = $id")->fetch_assoc();
$playlists = $conn->query("SELECT * FROM playlists WHERE user_id = {$_SESSION['user_id']}");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $artist = $conn->real_escape_string($_POST['artist']);
    $playlist_id = (int)$_POST['playlist_id'];
    $thumbnail = $_POST['old_thumbnail'];
    $url = $_POST['old_url'];
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        deleteFile($thumbnail);
        $thumbnail = uploadFile($_FILES['thumbnail'], '../../assets/images/', ['jpg', 'png']);
    }
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        deleteFile($url);
        $url = uploadFile($_FILES['file'], '../../assets/audio/', ['mp3']);
    }
    $conn->query("UPDATE songs SET title='$title', artist='$artist', url='$url', thumbnail='$thumbnail', playlist_id=$playlist_id WHERE id=$id");
    header('Location: ../../public/manage.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa Song</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <div class="container">
        <h2>Sửa Song</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="old_thumbnail" value="<?php echo $song['thumbnail']; ?>">
            <input type="hidden" name="old_url" value="<?php echo $song['url']; ?>">
            <input type="text" name="title" value="<?php echo $song['title']; ?>" required>
            <input type="text" name="artist" value="<?php echo $song['artist']; ?>" required>
            <select name="playlist_id" required>
                <?php while ($pl = $playlists->fetch_assoc()): ?>
                    <option value="<?php echo $pl['id']; ?>" <?php if ($pl['id'] == $song['playlist_id']) echo 'selected'; ?>><?php echo $pl['name']; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="file" name="file" accept=".mp3">
            <input type="file" name="thumbnail" accept="image/*">
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="../../public/manage.php" class="btn btn-warning">Quay lại</a>
        </form>
    </div>
</body>
</html>