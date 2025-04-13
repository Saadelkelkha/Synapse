<?php
require_once 'db.php';

function insertStory($imageUrl, $currentDate, $expiration, $id_user) {
    $db = database_connection();
    $sqlState = $db->prepare('INSERT INTO story (image_path, date_story, expiration, id_user) VALUES (?, ?, ?, ?)');
    return $sqlState->execute([$imageUrl, $currentDate, $expiration, $id_user]);
}

function obtenirToutesLesStories() {
    $db = database_connection();
    $now = date("Y-m-d H:i:s");

    $sql = 'SELECT * FROM story WHERE expiration > ? ORDER BY date_story DESC';
    $sqlState = $db->prepare($sql);
    $sqlState->execute([$now]);

    return $sqlState->fetchAll(PDO::FETCH_OBJ);
}

function supprimerStoriesExpirees() {
    $db = database_connection();
    $now = date("Y-m-d H:i:s");
    $sql = 'DELETE FROM story WHERE expiration <= ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$now]);
    
    // Débogage : Afficher combien de stories ont été supprimées
    echo $stmt->rowCount() . " stories expirées supprimées.<br>";
}

function supprimerStoryModel($id_story) {
    $db = database_connection();
    $sqlState = $db->prepare('DELETE FROM story WHERE id_story = ?');
    return $sqlState->execute([$id_story]);
}
?>
