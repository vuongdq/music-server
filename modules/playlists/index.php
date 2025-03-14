<?php
require '../../includes/functions.php';
$playlists = $conn->query("SELECT * FROM playlists WHERE user_id = {$_SESSION['user_id']}");
?>
<h2>Quản lý Playlists</h2>
<a href="../playlists/add.php" class="btn btn-success">Thêm Playlist</a>
<table>
    <thead><tr><th>ID</th><th>Thumbnail</th><th>Tên</th><th>Hành động</th></tr></thead>
    <tbody>
        <?php if ($playlists->num_rows == 0): ?>
            <tr><td colspan="4">Chưa có playlist nào.</td></tr>
        <?php else: ?>
            <?php while ($playlist = $playlists->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $playlist['id']; ?></td>
                    <td><?php if ($playlist['thumbnail']) echo "<img src='http://localhost/music-server/{$playlist['thumbnail']}' width='50'>"; ?></td>
                    <td><?php echo $playlist['name']; ?></td>
                    <td>
                        <a href="../playlists/edit.php?id=<?php echo $playlist['id']; ?>" class="btn btn-warning">Sửa</a>
                        <form method="POST" action="../playlists/delete.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $playlist['id']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa playlist này sẽ xóa tất cả bài hát trong đó. Tiếp tục?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </tbody>
</table>