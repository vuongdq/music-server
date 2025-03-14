<?php
require '../includes/functions.php'; // Sửa từ '../../includes/functions.php'
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $songs = $conn->query("SELECT url, thumbnail FROM songs WHERE playlist_id = $id");
    while ($song = $songs->fetch_assoc()) {
        deleteFile($song['url']);
        deleteFile($song['thumbnail']);
    }
    $playlist = $conn->query("SELECT thumbnail FROM playlists WHERE id = $id")->fetch_assoc();
    deleteFile($playlist['thumbnail']);
    $conn->query("DELETE FROM playlists WHERE id = $id");
    header('Location: ../../public/manage.php');
    exit;
}
?>