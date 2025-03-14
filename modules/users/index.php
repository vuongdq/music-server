<?php
require '../includes/functions.php'; // Sửa từ '../../includes/functions.php'
checkRole('admin');
$users = $conn->query("SELECT * FROM users");
?>
<h2>Quản lý Users</h2>
<a href="../users/add.php" class="btn btn-success">Thêm User</a>
<table>
    <thead><tr><th>ID</th><th>Username</th><th>Role</th><th>Hành động</th></tr></thead>
    <tbody>
        <?php if ($users->num_rows == 0): ?>
            <tr><td colspan="4">Chưa có user nào.</td></tr>
        <?php else: ?>
            <?php while ($user = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <a href="../users/edit.php?id=<?php echo $user['id']; ?>" class="btn btn-warning">Sửa</a>
                        <form method="POST" action="../users/delete.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa user này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </tbody>
</table>