<?php
require '../includes/functions.php'; // Sửa từ '../../includes/functions.php'
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $song = $conn->query("SELECT url, thumbnail FROM songs WHERE id = $id")->fetch_assoc();
    deleteFile($song['url']);
    deleteFile($song['thumbnail']);
    $conn->query("DELETE FROM songs WHERE id = $id");
    header('Location: ../../public/manage.php');
    exit;
}
?>