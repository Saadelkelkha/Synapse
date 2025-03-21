<?php
    require_once 'model/users.php';
    require_once 'model/home.php';
    require_once 'model/admin.php';

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
        require_once 'vue/home.php';
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
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/Synapse2/Synapse/synapseNt/vue/uploads/' . $image;

        //kat7t f database
        $imageUrl = 'vue/uploads/' . $image;


        // Déplacer l'image dans le répertoire "uploads"
        move_uploaded_file($tmpName, $imagePath);

        insertPost($text_content, $imageUrl, $currentDate, $id_user);
        //tzad
        // header("Location: index.php");
        echo $tmpName, $imagePath;
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
        }
    }

  

    function AfficherInfoUserSurProfilControler() {
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];
        require_once "vue/profil.php";
    }

    function afficherEnregistrerPostController(){
        $posts = afficherEnregistrerPost();
        require 'vue/enregistrer_post.php';

    }

    function afficherPostsadmin() {
        $id = $_SESSION['id_admin'];
        $admin = selectadmin($id);
        $fullname = $admin['prenom'] . " " . $admin['nom'];;

        $posts = obtenirTousLesPosts();
        require_once 'vue/gpost.php';
    }

    function afficherModifierPostAdmin($id_post) {
        $post = obtenirPostParId($id_post);
        if ($post) {
            require 'vue/modifierPostAdmin.php';
        } else {
            echo "Erreur : Aucun post trouvé avec cet ID.";
        }
    }


?>