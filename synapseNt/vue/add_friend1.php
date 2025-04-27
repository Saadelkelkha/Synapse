<?php
// Supprimer un ami
if (isset($_POST['remove_friend_id'])) {
    header('Content-Type: application/json');
    
    $friend_id = $_POST['remove_friend_id'];

    try {
        // Supprimer l'amitié dans les deux sens
        $stmt = $pdo->prepare("DELETE FROM friends WHERE (user_id_1 = ? AND user_id_2 = ?) OR (user_id_1 = ? AND user_id_2 = ?)");
        $stmt->execute([$id_user, $friend_id, $friend_id, $id_user]);

        // Supprimer toutes les notifications échangées entre les deux utilisateurs
        $stmt = $pdo->prepare("DELETE FROM notification WHERE (id_user = ? AND id_envoyeur = ?) OR (id_user = ? AND id_envoyeur = ?)");
        $stmt->execute([$id_user, $friend_id, $friend_id, $id_user]);

        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
    exit;
}




?>