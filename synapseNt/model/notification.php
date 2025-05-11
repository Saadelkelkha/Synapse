<?php
 require_once 'db.php';

function getUserNotifications($conn, $id_user)
{
    $sql = "SELECT * FROM notification WHERE id_user = ? ORDER BY date_notification DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_user]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function markNotificationAsRead($conn, $id_notification)
{
    $sql = "UPDATE notification SET est_lu = 1 WHERE id_notification = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id_notification]);
}
?>
