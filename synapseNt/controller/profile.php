<?php
require_once 'model/profile.php';

function afficherPostProfileController(){
   
    $posts = afficherPostProfil();
    require_once 'vue/profile-photos.php';
   
   
}
function afficherPhotosProfileController(){
   
    $posts = afficherusersPhotosProfil();
    require_once 'vue/profile-photos.php';
   
   
}

// function afficherPostProfileController(){
   
//     $posts = afficherPostProfil();
//     require_once 'vue/profile-amies.php';
   
   
// }

function obtenirTousLesUtlisateursController() {
    $users = obtenirTousLesUtlisateurs();
    require 'vue/afficher-profile-amie.php';
}

function obtenirTousLesUtlisateursControllerParId($id_user) {
    $users = obtenirUtilisateurParId($id_user);
    if ($users) {
        require 'vue/afficher-profile-amie.php';
    } else {
        echo "Erreur : Aucun post trouvé avec cet ID.";
    }
}

?>