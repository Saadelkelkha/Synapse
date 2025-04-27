<?php
$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
session_start();
$id_user = $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_friend_id'])) {
    $receiver_id = $_POST['add_friend_id'];

    $checkStmt = $pdo->prepare("SELECT * FROM friend_requests 
        WHERE (sender_id = :sender AND receiver_id = :receiver)
        OR (sender_id = :receiver AND receiver_id = :sender)");
    $checkStmt->execute([
        'sender' => $id_user,
        'receiver' => $receiver_id
    ]);

    if ($checkStmt->rowCount() === 0) {
        $insertStmt = $pdo->prepare("INSERT INTO friend_requests (sender_id, receiver_id, status, sent_at) 
            VALUES (:sender, :receiver, 'pending', NOW())");
        $insertStmt->execute([
            'sender' => $id_user,
            'receiver' => $receiver_id
        ]);
    }

    echo 'success';
    exit;
}
?>
