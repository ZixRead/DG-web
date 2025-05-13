<?php
require_once(__DIR__ . '/include/Core.php'); 
require_once(__DIR__ . '/include/Config.php');
require_once(__DIR__ . '/include/PDOQuery.php');

// ดึงข้อความแชทจากฐานข้อมูล
$chatMessages = Query('SELECT * FROM chat_messages ORDER BY created_at DESC LIMIT 50');
if ($chatMessages) {
    foreach ($chatMessages as $chat) {
        $profileImage = 'https://minotar.net/helm/' . htmlspecialchars($chat['username']) . '/50'; // รูปโปรไฟล์จาก Minotar
        echo '<div class="d-flex align-items-center mb-3">';
        echo '<img src="' . $profileImage . '" alt="Profile" class="rounded-circle me-3" style="width: 50px; height: 50px;">';
        echo '<div>';
        echo '<p class="mb-0"><strong>' . htmlspecialchars($chat['username']) . ':</strong></p>';
        echo '<p class="mb-0 text-muted">' . htmlspecialchars($chat['message']) . '</p>';
        echo '<small class="text-muted">' . htmlspecialchars($chat['created_at']) . '</small>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p class="text-muted">ไม่มีข้อความในแชท</p>';
}
?>