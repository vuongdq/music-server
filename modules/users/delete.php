<?php
require '../includes/functions.php'; // Sửa từ '../../includes/functions.php'
checkRole('admin');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $conn->query("DELETE FROM users WHERE id = $id");
    header('Location: ../../public/manage.php');
    exit;
}
?>