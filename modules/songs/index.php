<?php
require '../../includes/functions.php';
$songs = $conn->query("SELECT s.*, p.name AS playlist_name FROM songs s JOIN playlists p ON s.playlist_id = p.id WHERE p.user_id = {$_SESSION['user_id']}");
?>
<h2>Quản lý Songs</h2>
<a href="../songs/add.php" class="btn btn-success">Thêm Song</a>
<table>
    <thead><tr><th>ID</th><th>Thumbnail</th><th>Tiêu đề</th><th>Nghệ sĩ</th><th>Playlist</th><th>File</th><th>Hành động</th></tr></thead>
    <tbody>
        <?php if ($songs->num_rows == 0): ?>
            <tr><td colspan="7">Chưa có bài hát nào.</td></tr>
        <?php else: ?>
            <?php while ($song = $songs->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $song['id']; ?></td>
                    <td><?php if ($song['thumbnail']) echo "<img src='http://localhost/music-server/{$song['thumbnail']}' width='50'>"; ?></td>
                    <td><?php echo $song['title']; ?></td>
                    <td><?php echo $song['artist']; ?></td>
                    <td><?php echo $song['playlist_name']; ?></td>
                    <td><a href="http://localhost/music-server/<?php echo $song['url']; ?>" target="_blank">Nghe</a></td>
                    <td>
                        <a href="../songs/edit.php?id=<?php echo $song['id']; ?>" class="btn btn-warning">Sửa</a>
                        <form method="POST" action="../songs/delete.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $song['id']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa bài hát này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </tbody>
</table>