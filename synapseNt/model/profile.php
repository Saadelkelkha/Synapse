<?php
require_once "db.php";

function afficherPostProfil(){
    $pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
    $id = $_SESSION['id_user'];
    $sqlState = $pdo->query('SELECT image_path FROM post'); 
    
    $posts = $sqlState->fetchAll(PDO::FETCH_OBJ);
}
function afficherusersPhotosProfil(){
    $pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
    $id = $_SESSION['id_user'];
    $sqlState = $db->prepare("SELECT * FROM user WHERE id_user = ?");
    $sqlState->execute([$id_user]);
    $user = $sqlState->fetch(PDO::FETCH_OBJ); // Un seul objet
        
    return $user ? [$user] : []; 
}
function afficherAmies(){
    $pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
    $id = $_SESSION['id_user'];
    $sqlState = $pdo->query('SELECT image_path FROM post'); 
    
    $posts = $sqlState->fetchAll(PDO::FETCH_OBJ);
}

    
    
    function getUserById($id_user) {
        $pdo = database_connection();
        $query = $pdo->prepare("SELECT * FROM user WHERE id_user = ?");
        $query->execute([$id_user]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
    function ModifierProfile($id_user, $prenom, $nom, $email, $bio, $date_naissance, $photo_profil, $banner) {
        $pdo = database_connection();
        $update = $pdo->prepare("
            UPDATE user 
            SET prenom = ?, nom = ?, email = ?, bio = ?, date_naissance = ?, photo_profil = ?, banner = ? 
            WHERE id_user = ?
        ");
        return $update->execute([$prenom, $nom, $email, $bio, $date_naissance, $photo_profil, $banner, $id_user]);
    }

    function obtenirTousLesUtlisateurs() {
        $db = database_connection();
        $sqlState = $db->query('SELECT * FROM user');
        return $sqlState->fetchAll(PDO::FETCH_OBJ);
    }

    function obtenirUtilisateurParId($id_user) {
        $db = database_connection();
        $stmt = $db->prepare("SELECT * FROM user WHERE id_user = ?");
        $stmt->execute([$id_user]);
        $user = $stmt->fetch(PDO::FETCH_OBJ); // Un seul objet
    
        return $user ? [$user] : []; // Retourne un tableau contenant l'objet
    }
    
    function supprimeramiModel($id_ami,$id){
        $pdo = database_connection();
        $stmt = $pdo->prepare("DELETE FROM friends WHERE (user_id_1 = ? AND user_id_2 = ?) OR (user_id_1 = ? AND user_id_2 = ?)");
        return $stmt->execute([$id_ami,$id,$id,$id_ami]);
    }
?>