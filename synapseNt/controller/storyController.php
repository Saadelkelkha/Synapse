<?php

require_once 'model/storyModel.php';


function creerStory(){

    // Récupération des données du formulaire
 
    $currentDate = date("Y-m-d H:i:s");

    // Récupérer l'ID de l'utilisateur connecté
    $id_user = $_SESSION['id_user']; 

    // Traitement de l'image

    //$_SERVER['DOCUMENT_ROOT'] houwa repertoire racine
    $tmpName = $_FILES['image']['tmp_name'];
   
    $image = $_FILES['image']['name'];
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/Synapse2/Synapse/synapseNt/vue/stories/' . $image;

    //kat7t f database
    $imageUrl = 'vue/stories/' . $image;
    


    // Déplacer l'image dans le répertoire "uploads"
    move_uploaded_file($tmpName, $imagePath);

    insertStory($imageUrl, $currentDate, $id_user);
    //tzad
    header("Location: index.php");
    // echo $tmpName, $imagePath;
}




function afficherStories() {
    $stories = obtenirToutesLesStories();
    require 'vue/home.php';
}

function supprimerStory() {
    if (isset($_POST['id_story'])) {
        $id_story = $_POST['id_story'];
        supprimerStoryModel($id_story);
    }
    header("Location:index.php");
}
?>
