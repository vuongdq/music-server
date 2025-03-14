<?php
require_once 'config.php';

function checkRole($role) {
    if ($_SESSION['role'] !== $role) {
        die("Bạn không có quyền truy cập!");
    }
}

function uploadFile($file, $targetDir, $allowedTypes = ['mp3', 'jpg', 'png']) {
    if ($file['error'] !== 0) return '';
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedTypes)) die("Loại file không hợp lệ!");
    $target = $targetDir . uniqid() . '.' . $ext; // Đổi tên file để tránh trùng
    move_uploaded_file($file['tmp_name'], $target);
    return $target;
}

function deleteFile($path) {
    if ($path && file_exists($path)) unlink($path);
}
?>
