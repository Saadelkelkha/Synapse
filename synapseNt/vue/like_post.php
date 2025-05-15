<?php

$pdo = new PDO('mysql:host=localhost;dbname=synapse', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupération des données envoyées via POST
if (isset($_POST['post_id'])) {
    $postId = intval($_POST['post_id']);
    $userId = intval($_POST['user_id']); 
    try {
        // Vérifiez si l'utilisateur a déjà liké le post
        $stmt = $pdo->prepare("SELECT id FROM likes WHERE id_post = :id_post AND id_user = :id_user");
        $stmt->execute(['id_post' => $postId, 'id_user' => $userId]);

        if ($stmt->rowCount() > 0) {
            // Supprimez le like
            $stmt = $pdo->prepare("DELETE FROM likes WHERE id_post = :id_post AND id_user = :id_user");
            $stmt->execute(['id_post' => $postId, 'id_user' => $userId]);

            $stmt = $pdo->prepare("SELECT COUNT(*) AS like_count FROM likes WHERE id_post = :id_post");
            $stmt->execute(['id_post' => $postId]);
            $likeCount = $stmt->fetch(PDO::FETCH_ASSOC)['like_count'];

            echo json_encode(['success' => true, 'like_count' => $likeCount, 'liked' => false]);
        } else {
            // Ajoutez un like
            $stmt = $pdo->prepare("INSERT INTO likes (id_post, id_user) VALUES (:id_post, :id_user)");
            $stmt->execute(['id_post' => $postId, 'id_user' => $userId]);

            $stmt = $pdo->prepare("SELECT COUNT(*) AS like_count FROM likes WHERE id_post = :id_post");
            $stmt->execute(['id_post' => $postId]);
            $likeCount = $stmt->fetch(PDO::FETCH_ASSOC)['like_count'];

            echo json_encode(['success' => true, 'like_count' => $likeCount, 'liked' => true]);
        }
        
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Aucun post ID reçu.']);
}