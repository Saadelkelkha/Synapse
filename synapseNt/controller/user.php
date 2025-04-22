<?php
    require_once 'model/users.php';
    require_once 'model/home.php';
    require_once 'model/admin.php';
    require_once 'model/profile.php';
    require_once 'model/group.php';

    function login_signup(){
        require_once 'vue/login.php';
    }
    
    function reintialiser(){
        require_once 'vue/reinitialiser.php';
    }

    function send_code($mail){
        if(check_email($mail)){
            $token = bin2hex(random_bytes(16));
            $expiry = date('Y-m-d H:i:s', strtotime('+30 minutes'));
            if($_SESSION["is_admin"]){
                $resetlink = "http://localhost/Synapse/synapseNt/index.php?action=reset-password&token=" . $token . "&admin=true";
            }else{
                $resetlink = "http://localhost/Synapse/synapseNt/index.php?action=reset-password&token=" . $token;
            }
            add_token($mail,$token,$expiry);
            

            include 'mail.php';
            $subject = "Reset password request";
            $body = "<p>Bonjour,</p>
                    <p>Veuillez cliquer sur le lien suivant pour valider votre compte :</p>
                    <p><a href='$resetlink' style='color: #2e6c80;'>Valider mon compte</a></p>
                    <p>Si vous n'avez pas demandé ce code, veuillez ignorer cet e-mail.</p>
                    <p>Cordialement,<br>L'équipe Synapse</p>";

            sendEmail($mail, $subject, $body);
            unset($email_error);
            header("Location: index.php");
            exit;
        }else{
            $email_error = "Cet e-mail n'est pas associé à un compte.";
            header("Location: index.php?action=reintialiser&email_error=" . $email_error );
            exit;
        }
    }

    function reset_password(){
        require_once 'vue/reset-password.php';
    }

    function change_password($pass,$token,$admin){
        if(check_token($token) == false){
            $token_error = "Le lien de réinitialisation du mot de passe est invalide ou a expiré.";
            header("Location: index.php?action=reset-password&token=" . $token . "&token_error=" . $token_error );
            exit;
        }else{
            unset($token_error);
        }

        if(trim($pass) == ""){
            $pass3_error = "Tapez votre password.";  
            header("Location: index.php?action=reset-password&token=" . $token . "&token_error=" . $token_error . "&pass3_error=" . $pass3_error );
            exit;
        } else {
            unset($pass3_error);
        }

        $passwordPattern = '/^.{8,}$/';
        if (!preg_match($passwordPattern, $pass)) {
            $pass3_error = "Le mot de passe doit contenir au moins 8 caractères.";
            header("Location: index.php?action=reset-password&token=" . $token . "&token_error=" . $token_error . "&pass3_error=" . $pass3_error );
            exit;
        } else {
            unset($pass2_error);
        }

        $password = password_hash($pass, PASSWORD_DEFAULT);
        $email = check_token($token);
        UpdatePassword($email,$password,$admin);
        delete_token($email);
        include 'mail.php';

        $subject = "Confirmation de modification de mot de passe Synapse";
        $body = "<p>Bonjour,</p>
                 <p>Votre mot de passe a été modifié avec succès.</p>
                 <p>Cordialement,<br>L'équipe Synapse</p>";

        sendEmail($email, $subject, $body);
        header("Location: index.php");
        exit;
    }

    function validationlogin($email,$pass){ 
            if (trim($email) == ""){
                $email_error = "Tapez votre email";
                header("Location: index.php?action=add&email_error=" . $email_error );
                exit;
            } else {
                unset($email_error);
            }
    
            // Regular expression for email validation
            $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/';
            if (!preg_match($emailPattern, $email)) {
                $email_error = "Tapez votre email au format valide";
                header("Location: index.php?action=add&email_error=" . $email_error );
                exit;
            } else {
                unset($email_error);
            }

            if(trim($pass) == ""){
                $pass_error = "Tapez votre password";
                header("Location: index.php?action=add&pass_error=" . $pass_error );
                exit;
            } else {
                unset($pass_error);
            }

            if(check_email($email)){
                if(check_password($email,$pass)){
                    $_SESSION['conn'] = true;
                    if(isset($_POST['id_groupe_post_partager'])){
                        header("Location: index.php?action=exploregroup&id=" . $_POST['id_groupe_post_partager']);
                    }elseif(isset($_POST['id_post_partager'])){
                        header("Location: index.php?action=home&id=" . $_POST['id_post_partager']);
                    }else{                
                        header("Location: index.php?action=home");
                    }
                    exit;
                }else{
                    $pass_error = "Mot de passe incorrect";
                    header("Location: index.php?action=add&pass_error=" . $pass_error );
                    exit;
                }
            }else{
                $email_error = "Cet e-mail n'est pas associé à un compte.";
                header("Location: index.php?action=add&email_error=" . $email_error );
                exit;
            }
    }
    
    function validationsignup($prenom,$nom,$date,$email,$pass){
        if (trim($prenom) == "") {
            $prenom_error = "Tapez votre Prenom.";
            header("Location:index.php?action=add&prenom_error=" . $prenom_error );
            exit;
        } else {
            unset($prenom_error);
        }
        
        $nomprenomPattern = '/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/';
        if (!preg_match($nomprenomPattern, $prenom)) {
            $prenom_error = "Le prénom ne doit contenir que des lettres.";
            header("Location: index.php?action=add&prenom_error=" . $prenom_error );
            exit;
        } else {
            unset($prenom_error);
        }

        if (trim($nom) == "") {
            $nom_error = "Tapez votre Nom.";
            header("Location: index.php?action=add&nom_error=" . $nom_error );
            exit;
        } else {
            unset($nom_error);
        }

        if (!preg_match($nomprenomPattern, $nom)) {
            $nom_error = "Le nom ne doit contenir que des lettres.";
            header("Location: index.php?action=add&nom_error=" . $nom_error );
            exit;
        } else {
            unset($nom_error);
        }

        if (trim($date) == "") {
            $date_error = "Tapez votre date de naissance.";
            header("Location: index.php?action=add&date_error=" . $date_error );
            exit;
        } else {
            unset($date_error);
        }

        if (trim($email) == ""){
            $email2_error = "Tapez votre email";
            header("Location: index.php?action=add&email2_error=" . $email2_error );
            exit;
        } else {
            unset($email2_error);
        }

        // Regular expression for email validation
        $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/';
        if (!preg_match($emailPattern, $email)) {
            $email2_error = "Tapez votre email au format valide";
            header("Location: index.php?action=add&email2_error=" . $email2_error );
            exit;
        } else {
            unset($email2_error);
        }

        if(trim($pass) == ""){
            $pass2_error = "Tapez votre password";
            header("Location: index.php?action=add&pass2_error=" . $pass2_error );
            exit;
        } else {
            unset($pass2_error);
        }

        $passwordPattern = '/^.{8,}$/';
        if (!preg_match($passwordPattern, $pass)) {
            $pass2_error = "Le mot de passe doit contenir au moins 8 caractères.";
            header("Location: index.php?action=add&pass2_error=" . $pass2_error );
            exit;
        } else {
            unset($pass2_error);
        }

        if(check_email($email)){
            $email2_error = "Cet e-mail est déjà associé à un compte.";
            header("Location: index.php?action=add&email2_error=" . $email2_error );
            exit;
        }else{
            $password = password_hash($pass, PASSWORD_DEFAULT);
            addUser($prenom,$nom,$date,$email,$password);
            
            include 'mail.php';
            $subject = "Valide account Synapse";
            $body = "<b>Connection successful</b>";

            sendEmail($email,$subject,$body);
            $_SESSION['conn'] = true;
            header("Location: index.php?action=home");
            exit;
        }
    }

    function home(){
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];

        $countcomment = countcomments();

        $likesamie = likesamie($id);

        require_once 'vue/home.php';
    }

    function affichepostpartage($id_post){
        if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
            $id = $_SESSION['id_user'];
            $user = selectuser($id);
            $fullname = $user['prenom'] . " " . $user['nom'];

            $countcomment = countcomments();

            $likesamie = likesamie($id);

            require_once 'vue/affichepost.php';
        }else{
            require_once 'vue/partagepostloginhome.php';
        }
    }

    function search($keywords){
        if(!empty(trim($keywords))){
            $users = rechercherNomPrenom($keywords);
            $groupes = rechercherNomGroup($keywords);
            $afficher = true;
        }else{
            $afficher = false;
        }
        // Assuming $users, $groupes, $afficher, and $keywords are arrays or objects
        $users = json_encode($users);
        $groupes = json_encode($groupes);
        $afficher = json_encode($afficher);
        $keywords = json_encode($keywords);
        // URL encode the JSON strings
        $users = urlencode($users);
        $groupes = urlencode($groupes);
        $afficher = urlencode($afficher);
        $keywords = urlencode($keywords);
        // Redirect with the serialized data in the URL
        header("Location: index.php?action=searchaffichage&users=" . $users . "&groupes=" . $groupes . "&afficher=" . $afficher . "&keywords=" . $keywords);
        exit();
    }

    function searchaffichage($users,$groupes,$keywords,$afficher){
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];

        $invitations = selectinvitationgroup();
        $joingroupes = rechercherjoinGroup($id);

        require_once 'vue/rechercheResultat.php';
    }

    function creerPosts(){
        // Récupération des données du formulaire
        $text_content = $_POST['text_content'];
        $currentDate = date("Y-m-d H:i:s");

        // Récupérer l'ID de l'utilisateur connecté
        $id_user = $_SESSION['id_user']; 

        // Traitement de l'image

        //$_SERVER['DOCUMENT_ROOT'] houwa repertoire racine
        $tmpName = $_FILES['image']['tmp_name'];
        $image = $_FILES['image']['name'];
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/Synapse/synapseNt/vue/uploads/' . $image;

        //kat7t f database
        $imageUrl = 'vue/uploads/' . $image;


        // Déplacer l'image dans le répertoire "uploads"
        move_uploaded_file($tmpName, $imagePath);

        insertPost($text_content, $imageUrl, $currentDate, $id_user);
        //tzad
        header("Location: index.php");
    }

    function afficherPosts() {
        $posts = obtenirTousLesPosts();
        require_once 'vue/home.php';
    }

    function enregistrerPosts() {
        if (isset($_POST['id_post']) && isset($_SESSION['id_user'])) {
            $id_post = $_POST['id_post'];
            $id_user = $_SESSION['id_user'];
            $saved_at = date("Y-m-d H:i:s");
    
            enregistrerPostModel($id_user, $id_post, $saved_at);
            
        }
    }


    function supprimerPost(){
        $id_post = $_POST['id_post'];
        supprimerPosteModel($id_post);
        header("Location: index.php");
    }

    function afficherTousLesPosts() {
        $posts = obtenirTousLesPosts();
        require 'vue/home.php';
    }

    function afficherModifierPost($id_post) {
        $post = obtenirPostParId($id_post);
        if ($post) {
            require 'vue/modifierPost.php';
        } else {
            echo "Erreur : Aucun post trouvé avec cet ID.";
        }
    }
    

    function modifierPostControler() {
        if (isset($_POST['modifier'])) {
            $id_post = $_POST['id_post'];
            $text_content = $_POST['text_content'];
            $oldimage = $_POST['oldimagepath'];
    
            // Connexion à la base de données
            $db = database_connection();
    
            // Vérification et traitement de l'image
            $tmpName = $_FILES['image']['tmp_name'];
            $image = $_FILES['image']['name'];
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/Synapse4/synapseNt/vue/uploads/' . $image;
    
            // Définir la variable de l'image à utiliser
            $variablekatsawivariable = $image;
    
            // Si l'image est vide et oldimagepathTrue est "false", supprimer l'ancienne image
            if ($_POST['oldimagepathTrue'] == "false" && $variablekatsawivariable == "") {
                if (file_exists($oldimage)) {
                    unlink($oldimage); // Supprimer l'ancienne image si elle existe
                    echo "Ancienne image supprimée.";
                }
            } elseif ($variablekatsawivariable != "") {
                // Si une nouvelle image est téléchargée, supprimer l'ancienne image et traiter la nouvelle
                if (file_exists($oldimage)) {
                    unlink($oldimage); // Supprimer l'ancienne image si elle existe
                    echo "Ancienne image supprimée, nouvelle image téléchargée.";
                }
            }
    
            // Affichage de la variable d'image pour débogage
            echo $variablekatsawivariable;
    
            // Si une nouvelle image a été téléchargée, déplacer l'image dans le répertoire "uploads"
            if ($variablekatsawivariable != "") {
                move_uploaded_file($tmpName, $imagePath);
                $imageUrl = 'vue/uploads/' . $variablekatsawivariable; // URL de l'image dans la base de données
            } else {
                // Si aucune nouvelle image, utiliser l'ancienne image
                $imageUrl = $oldimage;
            }
    
            // Appel à la fonction pour modifier le post avec le texte et l'image
            modifierPost($text_content, $imageUrl, $id_post);

            header("Location: index.php");
        }
    }

  

    function AfficherInfoUserSurProfilControler() {
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];
        require_once "vue/profil.php";
    }
    function AfficherInfoUserSurProfilControlerAmis() {
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];
        require_once "vue/profile-ami.php";
    }

    function afficherModifierProfile() {
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];
        require_once "vue/seetingsProfile.php";
    }

    function afficherEnregistrerPostController(){
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];

        $posts = afficherEnregistrerPost($id);
        require 'vue/enregistrer_post.php';

    }

    function afficherPostsadmin() {
        $id = $_SESSION['id_admin'];
        $admin = selectadmin($id);
        $fullname = $admin['prenom'] . " " . $admin['nom'];;

        $posts = obtenirTousLesPosts();
        require_once 'vue/gpost.php';
    }
    function afficherStoriesAdmin() {
        $id = $_SESSION['id_admin'];
        $admin = selectadmin($id);
        $fullname = $admin['prenom'] . " " . $admin['nom'];;

        $posts = obtenirTousLesPosts();
        require_once 'vue/gstories.php';
    }

    function afficherModifierPostAdmin($id_post) {
        $post = obtenirPostParId($id_post);
        if ($post) {
            require 'vue/modifierPostAdmin.php';
        } else {
            echo "Erreur : Aucun post trouvé avec cet ID.";
        }
    }

    function allcommentshome($id_post_groupe){
        $comments = selectcomments($id_post_groupe);
        $likesofcomment = getlikescomment_home($id_post_groupe);

        $id = $_SESSION['id_user'];
        

        header('Content-Type: application/json');
        echo json_encode([
            'comments' => $comments,
            'likesofcomment' => $likesofcomment,
            'id_user' => $id
        ]);
    }

    function getresponsehome($id_comment){
        $response = selectresponsehome($id_comment);
        $id = $_SESSION['id_user'];
        $replylikes = getlikesreplycomment_home($id_comment);

        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success',
            'response' => $response,
            'id_user' => $id,
            'id_member' => $id,
            'replylikes' => $replylikes
        ]);
    }

    function commentlike_home($id_comment){
        $id = $_SESSION['id_user'];

        submitcommentlike_home($id_comment,$id);
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success'
        ]);
    }

    function replylike_home($id_reply){
        $id = $_SESSION['id_user'];

        submitreplylike_home($id_reply,$id);
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success'
        ]);
    }

    function removereplylike_home($id_reply){
        $id = $_SESSION['id_user'];

        removeereplylike_home($id_reply,$id);
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success'
        ]);
    }

    function removecommentlike_home($id_comment){
        $id = $_SESSION['id_user'];

        removeecommentlike_home($id_comment,$id);
        
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'success'
        ]);
    }

    function submitreply($groupe_comment,$reply_to){
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];

        submit_reply($id,$groupe_comment,$reply_to);
        $reply = selectreply($id);

        header('Content-Type: application/json');

        echo json_encode([
            'status' => 'success',
            'fullname' => $fullname,
            'photo_profile' => $reply->photo_profil,
            'date_reply' => $reply->reply_grp_at,
            'reply' => $groupe_comment
        ]);
    }

    function submitcomment($id_groupe_post,$groupe_comment){
        $id = $_SESSION['id_user'];
        submit_comment($id,$id_groupe_post,$groupe_comment);

        header('Content-Type: application/json');

        echo json_encode([
            'status' => 'success'
        ]);
    }
function modifierProfilController() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifierProfil'])) {
        $id_user = $_SESSION['id_user'];
        $user = getUserById($id_user);

        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        $date_naissance = $_POST['date_naissance'];

        // Gestion de l'upload des images
        $photo_profil = $user['photo_profil']; // Garder l'ancienne photo si non modifiée
        $banner = $user['banner']; // Garder l'ancien banner si non modifié

        if (!empty($_FILES['photo_profil']['name'])) {
            $photo_profil = "vue/profil_photos/" . basename($_FILES['photo_profil']['name']);
            move_uploaded_file($_FILES['photo_profil']['tmp_name'], $photo_profil);
        }

        if (!empty($_FILES['banner']['name'])) {
            $banner = "vue/profil_photos/" . basename($_FILES['banner']['name']);
            move_uploaded_file($_FILES['banner']['tmp_name'], $banner);
        }

        // Mettre à jour les informations dans la base de données
        $success = ModifierProfile($id_user, $prenom, $nom, $email, $bio, $date_naissance, $photo_profil, $banner);

        if ($success) {
            $_SESSION['success_message'] = "Profil mis à jour avec succès !";
        } else {
            $_SESSION['error_message'] = "Une erreur est survenue lors de la mise à jour.";
        }

        header("Location: index.php");
        exit();
    }
}

function afficherAmiesController(){
    $amies = afficherAmiesM();
    require 'vue/amies.php';
}

function logout(){
    session_destroy();
    header("Location: index.php");
    exit;
}

function selectpostinfo($id_post){
    $infos = selectpostinfoo($id_post);

    header('Content-Type: application/json');
    echo json_encode($infos);
}

function modifierpostt($id_post_groupe,$text_content){

    $infos = selectpostinfoo($id_post_groupe);
    $id_groupe = $infos->id_user;
    $oldimage = $infos->image_path;

    if ($_FILES['image']['name']) {            
        // Traitement de l'image
        // Define the directory where the images are stored
        $imageDirectory = $_SERVER['DOCUMENT_ROOT'] . '/Synapse/synapseNt/img/posts/' . $id_groupe . '/';
        $Dir = $imageDirectory = $_SERVER['DOCUMENT_ROOT'] . '/Synapse/synapseNt/img/posts/' . $id_groupe;
        
        if (!is_dir($Dir)) {
            mkdir($Dir, 0777, true);
        }
                
        // Get all image files in the directory (you can adjust the extensions as needed)
        $imageFiles = glob($imageDirectory . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
                
        // Initialize the highest number to 0
        $highestNumber = 0;
                
        // Loop through the files to find the highest numbered image
        foreach ($imageFiles as $imageFile) {
            // Extract the number from the filename (assuming filenames are like 1.jpg, 2.jpg, 3.jpg, etc.)
            if (preg_match('/(\d+)\.(jpg|jpeg|png|gif|webp)$/i', basename($imageFile), $matches)) {
                $imageNumber = (int)$matches[1];
                if ($imageNumber > $highestNumber) {
                    $highestNumber = $imageNumber;
                }
            }
        }
        
        // Increment the highest number by 1 to create the next image name
        $newImageNumber = $highestNumber + 1;

        // Delete the old image
        if($oldimage !== ""){
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/Synapse/synapseNt/' . $oldimage)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/Synapse/synapseNt/' . $oldimage);
            }
        }


        //$_SERVER['DOCUMENT_ROOT'] houwa repertoire racine
        
        $tmpName = $_FILES['image']['tmp_name'];
        $imageExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image = $newImageNumber . '.' . $imageExtension;
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/Synapse/synapseNt/img/posts/' . $id_groupe . '/'. $image;
        
        //kat7t f database
        $imageUrl = 'img/posts/' . $id_groupe . '/'. $image;
        
        
        // Déplacer l'image dans le répertoire "uploads"
        move_uploaded_file($tmpName, $imagePath);
    } else {
        if($_POST['imagehere'] === "true"){
            $imageUrl = $oldimage;
        }else{
            if($oldimage !== ""){
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/Synapse/synapseNt/' . $oldimage)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/Synapse/synapseNt/' . $oldimage);
                }
            }
            $imageUrl = "";
        }
    }

    modifierPost($text_content, $imageUrl, $id_post_groupe);

    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'text_content' => $text_content,
        'image_url' => $imageUrl,
        'id_post_groupe' => $id_post_groupe
    ]);
}

?>