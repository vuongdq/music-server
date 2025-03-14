<?php
require '../../includes/functions.php';
$playlists = $conn->query("SELECT * FROM playlists WHERE user_id = {$_SESSION['user_id']}");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $artist = $conn->real_escape_string($_POST['artist']);
    $playlist_id = (int)$_POST['playlist_id'];
    $thumbnail = uploadFile($_FILES['thumbnail'], '../../assets/images/', ['jpg', 'png']);
    $url = uploadFile($_FILES['file'], '../../assets/audio/', ['mp3']);
    $conn->query("INSERT INTO songs (title, artist, url, thumbnail, playlist_id) VALUES ('$title', '$artist', '$url', '$thumbnail', $playlist_id)");
    header('Location: ../../public/manage.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm Song</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <div class="container">
        <h2>Thêm Song</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Tiêu đề" required>
            <input type="text" name="artist" placeholder="Nghệ sĩ" required>
            <select name="playlist_id" required>
                <option value="">Chọn playlist</option>
                <?php while ($pl = $playlists->fetch_assoc()): ?>
                    <option value="<?php echo $pl['id']; ?>"><?php echo $pl['name']; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="file" name="file" accept=".mp3" required>
            <input type="file" name="thumbnail" accept="image/*">
            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="../../public/manage.php" class="btn btn-warning">Quay lại</a>
        </form>
    </div>
</body>
</html>