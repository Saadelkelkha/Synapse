<?php

require_once 'model/storyModel.php';


function creerStory(){
    // Récupération des données du formulaire
    // $text_content = $_POST['text_content'];
    $currentDate = date("Y-m-d H:i:s");
    $id_user = $_SESSION['id_user']; 

    // Traitement de l'image

    //$_SERVER['DOCUMENT_ROOT'] houwa repertoire racine
    $tmpName = $_FILES['image']['tmp_name'];
    $image = $_FILES['image']['name'];
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/vue/uploads/stories/' . $image;
    $imageUrl = 'vue/uploads/stories/' . $image;
    move_uploaded_file($tmpName, $imagePath);

    insertStory($imageUrl, $currentDate, $id_user);
    //tzad
    header("Location:index.php");
exit();

}

function afficherStories() {
    $stories = obtenirToutesLesStories();
    
    // Passer les stories à la vue
    require_once '../vue/storyView.php';
}

function supprimerStory() {
    if (isset($_POST['id_story'])) {
        $id_story = $_POST['id_story'];
        supprimerStoryModel($id_story);
    }
    header("Location:index.php");
}
?>
