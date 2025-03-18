<?php
require_once 'db.php';;

function insertStory($imageUrl, $currentDate, $id_user) {
    $db = database_connection();
    $sqlState = $db->prepare('INSERT INTO story (image_path, date_story, id_user) VALUES (?, ?, ?)');
    return $sqlState->execute([$imageUrl, $currentDate, $id_user]);
}



function obtenirToutesLesStories() {
    $db = database_connection();
    $sqlState = $db->query('SELECT * FROM story ORDER BY date_story DESC');
    return $sqlState->fetchAll(PDO::FETCH_OBJ);
}

function supprimerStoryModel($id_story) {
    $db = database_connection();
    $sqlState = $db->prepare('DELETE FROM story WHERE id_story = ?');
    return $sqlState->execute([$id_story]);
}
?>