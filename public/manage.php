<?php
require '../includes/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Music Server</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Music Server</h1>
            <div class="user-info">
                Xin chào, <?php echo $_SESSION['role']; ?> | <a href="logout.php">Đăng xuất</a>
            </div>
        </header>
        <nav>
            <a href="#songs" class="tab active" onclick="showTab('songs')">Songs</a>
            <a href="#playlists" class="tab" onclick="showTab('playlists')">Playlists</a>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="#users" class="tab" onclick="showTab('users')">Users</a>
            <?php endif; ?>
        </nav>
        <main>
            <section id="songs" class="tab-content active">
                <?php include '../modules/songs/index.php'; ?>
            </section>
            <section id="playlists" class="tab-content">
                <?php include '../modules/playlists/index.php'; ?>
            </section>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <section id="users" class="tab-content">
                    <?php include '../modules/users/index.php'; ?>
                </section>
            <?php endif; ?>
        </main>
    </div>
    <script>
        function showTab(tab) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab').forEach(el => el.classList.remove('active'));
            document.getElementById(tab).classList.add('active');
            document.querySelector(`a[href="#${tab}"]`).classList.add('active');
        }
    </script>
</body>
</html>