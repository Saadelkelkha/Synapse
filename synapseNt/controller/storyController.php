<?php
require_once 'model/storyModel.php';

function creerStory() {
    $currentDate = date("Y-m-d H:i:s");
    $expiration = date("Y-m-d H:i:s", strtotime('+1 minute')); // expire dans 1 minute
    $id_user = $_SESSION['id_user'];

    // Traitement de l'image
    $tmpName = $_FILES['image']['tmp_name'];
    $image = $_FILES['image']['name'];
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/Synapse/synapseNt/vue/stories/' . $image;
    $imageUrl = 'vue/stories/' . $image;

    move_uploaded_file($tmpName, $imagePath);

    // Insertion de la story dans la base de données
    insertStory($imageUrl, $currentDate, $expiration, $id_user);

    header("Location: index.php");
}

function afficherStories() {
    supprimerStoriesExpirees();  // Supprime les stories expirées
    $stories = obtenirToutesLesStories();  // Récupère les stories restantes
    require 'vue/home.php';  // Affiche les stories dans la vue
}

function supprimerStory() {
    if (isset($_POST['id_story'])) {
        $id_story = $_POST['id_story'];
        supprimerStoryModel($id_story);  // Supprime une story spécifique
    }
    header("Location: index.php");
}
?>
