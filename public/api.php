<?php
require '../includes/config.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$key = $_GET['key'] ?? '';
if ($key !== API_KEY) {
    echo json_encode(['error' => 'Invalid API key']);
    exit;
}

$action = $_GET['action'] ?? 'songs';
if ($action === 'songs') {
    $result = $conn->query("SELECT s.*, p.name AS playlist_name FROM songs s JOIN playlists p ON s.playlist_id = p.id");
    $songs = [];
    while ($row = $result->fetch_assoc()) {
        $row['thumbnail'] = "http://localhost/music-server/" . $row['thumbnail'];
        $row['url'] = "http://localhost/music-server/" . $row['url'];
        $songs[] = $row;
    }
    echo json_encode($songs);
} elseif ($action === 'playlists') {
    $result = $conn->query("SELECT * FROM playlists");
    $playlists = [];
    while ($row = $result->fetch_assoc()) {
        $row['thumbnail'] = "http://localhost/music-server/" . $row['thumbnail'];
        $playlists[] = $row;
    }
    echo json_encode($playlists);
} else {
    echo json_encode(['error' => 'Invalid action']);
}
?>