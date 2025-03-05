<?php
    session_start();
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        
        switch ($action) {
            case 'add':
                if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                    header('Location: index.php?action=home');
                }else{
                    require_once 'controller/user.php';
                    login_signup();
                }
                break;
            case 'reintialiser':
                if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                    header('Location: index.php?action=home');
                }else{
                    require_once 'controller/user.php';
                    reintialiser();
                }
                break;
            case 'send_code':
                if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                    header('Location: index.php?action=home');
                }else{
                    require_once 'controller/user.php';
                    if(isset($_POST['mail'])){
                        $mail = $_POST['mail'];
                        send_code($mail);
                    }else{
                        header('Location: index.php?action=reintialiser');
                    }
                }
                break;
            
            case 'reset-password':
                if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                    header('Location: index.php?action=home');
                    break;
                }else{
                    require_once 'controller/user.php';
                    reset_password();
                    break;
                }
                
            case 'change_password':
                require_once 'controller/user.php';
                if(isset($_POST['pass']) && isset($_POST['token'])){
                    $pass = $_POST['pass'];
                    $token = $_POST['token'];
                    if(isset($_POST['admin'])){
                        $admin = $_POST['admin'];
                        change_password($pass,$token,$admin);
                    }else{
                        $admin = false;
                        change_password($pass,$token,$admin);
                    }
                }else{
                    header('Location: index.php?action=home');
                }
                break;
            case 'home':
                require_once 'controller/user.php';
                if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true){
                        header('Location: index.php?action=admin');
                    }else{
                        home();
                    }
                }else{
                    header('Location: index.php');
                }
                break;
            case 'validationlogin':
                require_once 'controller/user.php';
                if(isset($_POST['logemail']) && isset($_POST['logpass'])){
                    $email = $_POST['logemail'];
                    $pass = $_POST['logpass'];
                    validationlogin($email,$pass);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'validationsignup':
                require_once 'controller/user.php';
                if(isset($_POST['logprenom'], $_POST['lognom'], $_POST['logdate'], $_POST['logemail'], $_POST['logpass'])){
                    $prenom = $_POST['logprenom'];
                    $nom = $_POST['lognom'];
                    $date = $_POST['logdate'];
                    $email = $_POST['logemail'];
                    $pass = $_POST['logpass'];

                    validationsignup($prenom,$nom,$date,$email,$pass);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'search':
                require_once 'controller/user.php';
                if(isset($_POST['rechercher'])){
                    $keywords = $_POST['keywords'];
                    search($keywords);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'searchaffichage':
                require_once 'controller/user.php';
                if(isset($_GET['users']) && isset($_GET['groupes'])){
                    // Assuming you are receiving the data via GET parameters
                    $users = json_decode(urldecode($_GET['users']), true);
                    $groupes = json_decode(urldecode($_GET['groupes']), true);
                    $afficher = json_decode(urldecode($_GET['afficher']), true);
                    $keywords = json_decode(urldecode($_GET['keywords']), true);
                                    
                    // Now $users, $groupes, $afficher, and $keywords are arrays or objects again
                    searchaffichage($users,$groupes,$keywords,$afficher);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'admin':
                require_once 'controller/admin.php';
                if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true){
                        admin();
                    }else{
                        header('Location: index.php');
                    }
                }else{
                    header('Location: index.php');
                }
                break;
            case 'validationsignupadmin':
                require_once 'controller/admin.php';
                if(isset($_POST['logprenom'], $_POST['lognom'], $_POST['logdate'], $_POST['logemail'], $_POST['logpass'])){
                    $prenom = $_POST['logprenom'];
                    $nom = $_POST['lognom'];
                    $date = $_POST['logdate'];
                    $email = $_POST['logemail'];
                    $pass = $_POST['logpass'];

                    validationsignupadmin($prenom,$nom,$date,$email,$pass);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'gestionusers':
                require_once 'controller/admin.php';
                if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true){
                        gestionusers();
                    }else{
                        header('Location: index.php');
                    }
                }else{
                    header('Location: index.php');
                }
                break;
            case 'delete_user':
                require_once 'controller/admin.php';
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    delete_user($id);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'update_user':
                require_once 'controller/admin.php';
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    update_user($id);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'valide_update_user':
                require_once 'controller/admin.php';
                if(isset($_POST['logprenom'], $_POST['lognom'], $_POST['logdate'], $_POST['logemail'], $_POST['id'])){
                    $prenom = $_POST['logprenom'];
                    $nom = $_POST['lognom'];
                    $date = $_POST['logdate'];
                    $email = $_POST['logemail'];
                    $id = $_POST['id'];

                    valide_update_user($prenom,$nom,$date,$email,$id);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'groups':
                require_once 'controller/group.php';
                if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                    groups();
                }else{
                    header('Location: index.php');
                }
                break;
            case 'addgroupe':
                require_once 'controller/group.php';
                if(isset($_POST['group_name'], $_POST['group_description'])){
                    $name = $_POST['group_name'];
                    $description = $_POST['group_description'];
                    $id = $_SESSION['id_user'];
                    addgroupe($name,$description,$id);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'join_group':
                if(isset($_POST['id_groupe'])){
                    require_once 'controller/group.php';
                    $idgroupe = $_POST['id_groupe'];
                    joingroup($idgroupe);
                    break;
                }
            case 'cancel_join_group':
                if(isset($_POST['id_groupe'])){
                    require_once 'controller/group.php';
                    $idgroupe = $_POST['id_groupe'];
                    canceljoingroup($idgroupe);
                    break;
                }
            case 'exploregroup':
                if(isset($_POST['id_group'])){
                    require_once 'controller/group.php';
                    $id_group = $_POST['id_group'];
                    exploregroupe($id_group);
                    break;
                }
            case 'invitationgroup':
                if(isset($_POST['id_group'])){
                    require_once 'controller/group.php';
                    $id_group = $_POST['id_group'];
                    invitationgroup($id_group);
                    break;
                }
            case 'membresgroup':
                if(isset($_POST['id_group'])){
                    require_once 'controller/group.php';
                    $id_group = $_POST['id_group'];
                    membresgroup($id_group);
                    break;
                }
            case 'select_invitation_group':
                if(isset($_POST['id_groupe'])){
                    require_once 'controller/group.php';
                    $id_groupe = $_POST['id_groupe'];
                    select_invitation_group($id_groupe);
                    break;
                }
            case 'select_membres_group':
                if(isset($_POST['id_groupe'])){
                    require_once 'controller/group.php';
                    $id_groupe = $_POST['id_groupe'];
                    select_membres_group($id_groupe);
                    break;
                }
            case 'acceptinvit':
                if(isset($_POST['id_user']) && isset($_POST['id_groupe'])){
                    require_once 'controller/group.php';
                    $id_user = $_POST['id_user'];
                    $id_groupe = $_POST['id_groupe'];
                    acceptinvit($id_user,$id_groupe);
                    break;
                }
            case 'rejectinvit':
                if(isset($_POST['id_user']) && isset($_POST['id_groupe'])){
                    require_once 'controller/group.php';
                    $id_user = $_POST['id_user'];
                    $id_groupe = $_POST['id_groupe'];
                    rejectinvit($id_user,$id_groupe);
                    break;
                }
            case 'kickmember':
                if (isset($_POST['id_groupe_member'])) {
                    require_once 'controller/group.php';

                    $id_groupe_member = $_POST['id_groupe_member'];

                    kickmember($id_groupe_member);
                    break;
                }
            case 'invitasadmin':
                if (isset($_POST['id_groupe_member']) && isset($_POST['id_groupe'])) {
                    require_once 'controller/group.php';

                    $id_groupe_member = $_POST['id_groupe_member'];
                    $id_groupe = $_POST['id_groupe'];

                    invitasadmin($id_groupe_member,$id_groupe);
                    break;
                }
            case 'select_amie':
                if (isset($_POST['id_user'])){
                    require_once 'controller/group.php';

                    $id_user = $_POST['id_user'];

                    select_amie($id_user);
                    break;
                }
            case 'invit_amie_group':
                if (isset($_POST['id_user']) && isset($_POST['id_groupe'])){
                    require_once 'controller/group.php';

                    $id_user = $_POST['id_user'];
                    $id_groupe = $_POST['id_groupe'];

                    invit_amie_group($id_user,$id_groupe);
                    break;
                }
            case 'cancel_invit_group':
                if (isset($_POST['id_user']) && $_POST['id_groupe']){
                    require_once 'controller/group.php';

                    $id_user = $_POST['id_user'];
                    $id_groupe = $_POST['id_groupe'];

                    cancel_invit_group($id_user,$id_groupe);
                    break;
                }
            case 'grouppost':
                if (isset($_SESSION['id_user']) && $_POST['id_groupe']) {
                    require_once 'controller/group.php';

                    $id_user = $_SESSION['id_user'];
                    $id_groupe = $_POST['id_groupe'];
                    
                    creergroupPosts($id_user,$id_groupe);
                    break;
                }
            case 'selectpostgroupinfo':
                if(isset($_POST['id_post'])){
                    require_once 'controller/group.php';
                    $id_post = $_POST['id_post'];
                    
                    selectpostgroupinfo($id_post);
                    break;
                }
            case 'modifierpostgroup':
                if(isset($_POST['post_groupe_id'])){
                    require_once 'controller/group.php';
                    $id_post_groupe = $_POST['post_groupe_id'];
                    $text_content = $_POST['text_content'];

                    modifierpostgroup($id_post_groupe,$text_content);
                    break;
                }
            case 'supprimerPostgroup':
                if(isset($_POST['id_groupe_post'])){
                    require_once 'controller/group.php';
                    $id_post_groupe = $_POST['id_groupe_post'];

                    supprimerPostgroup($id_post_groupe);
                    break;
                }
            case 'post':
                if (isset($_SESSION['id_user']) && isset($_POST['post'])) {
                    require_once 'controller/user.php';
                    creerPosts();
                    break;
                }

            case 'enregistrerPost':
                    require_once 'controller/user.php';
                    enregistrerPosts();
                    afficherPosts();
                    break;
            case "gestionposts":
                require_once 'controller/user.php';
                if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true){
                        afficherPostsadmin();
                    }else{
                        header('Location: index.php');
                    }
                }else{
                    header('Location: index.php');
                }
                break;
            
            case "enregistrerposts":
              require_once 'controller/user.php';
              afficherEnregistrerPostController();
              break;
              
            case 'afficherModifierPost':
                require_once 'controller/user.php';
                afficherModifierPost($_GET['id_post']);
                break;
            
                case 'afficherModifierPostAdmin':
                    require_once 'controller/user.php';
                    afficherModifierPostAdmin($_GET['id_post']);
                    break;

            case 'supprimerPost':
                    if(isset($_POST['supprimer'])){
                        require_once 'controller/user.php';
                        supprimerPost();
                        break;
                    }
            case "modifierPost":
              
                    require_once 'controller/user.php';
                    modifierPostControler();
                    break;
                
                    case "modifierPostAdmin":
              
                        require_once 'controller/user.php';
                        modifierPostControler();
                        break;
            case "afficherProfil":
                require_once 'controller/user.php';
                AfficherInfoUserSurProfilControler();
                break;
            case 'ajouterStory':
                require_once 'controller/storyController.php';
                creerStory(); // Appel à la fonction modifierStoryController dans storyController
                break;
        }
    }else{
        require_once 'controller/user.php';
        if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
            header('Location: index.php?action=home');
        }else{
            $_SESSION['conn'] = false;
            $_SESSION['is_admin'] = false;
            header('Location: index.php?action=add');
        }
    }

?>