<?php
require_once 'model/profile.php';
require_once 'model/admin.php';
    require_once 'model/users.php';
    require_once 'model/group.php';
    require_once 'model/home.php';
    require_once 'controller/user.php';

function afficherPostProfileController(){
    $id = $_SESSION['id_user'];
    $user = selectuser($id);
    $fullname = $user['prenom'] . " " . $user['nom'];
   
    $posts = afficherPostProfil();
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
    $id = $_SESSION['id_user'];
    $user = selectuser($id);
    $fullname = $user['prenom'] . " " . $user['nom'];

    if ($id_user == $id) {
        AfficherInfoUserSurProfilControler() ;
    } else {
        $countcomment = countcomments();
        $likesamie = likesamie($id);

        $users = obtenirUtilisateurParId($id_user);
        if ($users) {
            require 'vue/afficher-profile-amie.php';
        } else {
            echo "Erreur : Aucun post trouvé avec cet ID.";
        }
    }
    
}

function supprimerami($id_ami){
    $id = $_SESSION['id_user'];
    $user = selectuser($id);
    $fullname = $user['prenom'] . " " . $user['nom'];

    supprimeramiModel($id_ami,$id);

    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success'
    ]); 

}

?>