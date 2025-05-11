<?php
    session_start();
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        
        switch ($action) {
            case 'deconnexion':
                require_once 'controller/user.php';
                logout();
                break;
                
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
                        if(isset($_GET['id'])){
                            require_once 'controller/user.php';
                            $id_post = $_GET['id'];
                            affichepostpartage($id_post);
                            break;
                        }else{
                            home();
                        }
                    }
                }else{
                    if(isset($_GET['id'])){
                        require_once 'controller/user.php';
                        $id_post = $_GET['id'];
                        affichepostpartage($id_post);
                        break;
                    }else{
                        header('Location: index.php');
                    }
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
                if(isset($_POST['id'])){
                    $id = $_POST['id'];
                    delete_user($id);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'update_user':
                require_once 'controller/admin.php';
                if(isset($_POST['id'])){
                    $id = $_POST['id'];
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
            case 'gestiongroups':
                require_once 'controller/admin.php';
                if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true){
                        gestiongroups();
                    }else{
                        header('Location: index.php');
                    }
                }else{
                    header('Location: index.php');
                }
                break;
            case 'delete_groupe':
                require_once 'controller/admin.php';
                if(isset($_POST['id'])){
                    $id = $_POST['id'];
                    delete_groupe($id);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'update_groupe':
                require_once 'controller/admin.php';
                if(isset($_POST['id'])){
                    $id = $_POST['id'];
                    update_groupe($id);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'valide_update_groupe':
                require_once 'controller/admin.php';
                if(isset($_POST['logprenom'], $_POST['lognom'], $_POST['id'])){
                    $name_group = $_POST['logprenom'];
                    $description_group = $_POST['lognom'];
                    $id = $_POST['id'];

                    valide_update_groupe($name_group,$description_group,$id);
                }else{
                    header('Location: index.php');
                }
                break;
            case 'delete_banner_grp':
                require_once 'controller/admin.php';
                if(isset($_POST['id'])){
                    $id = $_POST['id'];
                    remove_banner_grp($id);
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
            case 'inv_amie':
                if(isset($_POST['id_groupe'])){
                    require_once 'controller/user.php';
                    $idgroupe = $_POST['id_groupe'];
                    inv_amie($idgroupe);
                    break;
                }
            case 'cancel_join_group':
                if(isset($_POST['id_groupe'])){
                    require_once 'controller/group.php';
                    $idgroupe = $_POST['id_groupe'];
                    canceljoingroup($idgroupe);
                    break;
                }
            case 'cancel_inv_amie':
                if(isset($_POST['id_groupe'])){
                    require_once 'controller/user.php';
                    $idgroupe = $_POST['id_groupe'];
                    cancel_inv_amie($idgroupe);
                    break;
                }
            case 'accept_inv_amie':
                if(isset($_POST['id_groupe'])){
                    require_once 'controller/user.php';
                    $idgroupe = $_POST['id_groupe'];
                    accept_inv_amie($idgroupe);
                    break;
                }
            case 'exploregroup':
                if(isset($_POST['id_group'])){
                    require_once 'controller/group.php';
                    $id_group = $_POST['id_group'];
                    exploregroupe($id_group);
                    break;
                }elseif(isset($_GET['id'])){
                    require_once 'controller/group.php';
                    $id_post_groupe = $_GET['id'];
                    affichepostgroupe($id_post_groupe);
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
            case 'selectpostinfo':
                if(isset($_POST['id_post'])){
                    require_once 'controller/user.php';
                    $id_post = $_POST['id_post'];
                    
                    selectpostinfo($id_post);
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
            case 'likePostgroup':
                if(isset($_POST['id_groupe_post'])){
                    require_once 'controller/group.php';
                    $id_post_groupe = $_POST['id_groupe_post'];

                    likePostgroup($id_post_groupe);
                    break;
                }
            case 'unlikePostgroup':
                if(isset($_POST['id_groupe_post'])){
                    require_once 'controller/group.php';
                    $id_post_groupe = $_POST['id_groupe_post'];

                    unlikePostgroup($id_post_groupe);
                    break;
                }
            case 'savePostgroup':
                if(isset($_POST['id_groupe_post'])){
                    require_once 'controller/group.php';
                    $id_post_groupe = $_POST['id_groupe_post'];

                    savePostgroup($id_post_groupe);
                    break;
                }
            case 'unsavePostgroup':
                if(isset($_POST['id_groupe_post'])){
                    require_once 'controller/group.php';
                    $id_post_groupe = $_POST['id_groupe_post'];

                    unsavePostgroup($id_post_groupe);
                    break;
                }
            case 'supprimerPostgroup':
                if(isset($_POST['id_groupe_post'])){
                    require_once 'controller/group.php';
                    $id_post_groupe = $_POST['id_groupe_post'];

                    supprimerPostgroup($id_post_groupe);
                    break;
                }
            case 'allcomments':
                if(isset($_POST['id_groupe_post'])){
                    require_once 'controller/group.php';
                    $id_post_groupe = $_POST['id_groupe_post'];

                    allcomments($id_post_groupe);
                    break;
                }
            case 'allcommentshome':
                if(isset($_POST['id_groupe_post'])){
                    require_once 'controller/user.php';
                    $id_post_groupe = $_POST['id_groupe_post'];

                    allcommentshome($id_post_groupe);
                    break;
                }
            case 'submitcommentgroup':
                if(isset($_POST['id_groupe_post']) && isset($_POST['groupe_comment'])){
                    require_once 'controller/group.php';
                    $id_groupe_post = $_POST['id_groupe_post'];
                    $groupe_comment = $_POST['groupe_comment'];

                    submitcommentgroupe($id_groupe_post,$groupe_comment);
                    break;
                }

            case 'submitcomment':
                if(isset($_POST['id_groupe_post']) && isset($_POST['groupe_comment'])){
                    require_once 'controller/user.php';
                    $id_groupe_post = $_POST['id_groupe_post'];
                    $groupe_comment = $_POST['groupe_comment'];

                    submitcomment($id_groupe_post,$groupe_comment);
                    break;
                }

            case 'submitreplygroup':
                if(isset($_POST['groupe_comment']) && isset($_POST['reply_to'])){
                    require_once 'controller/group.php';
                    $groupe_comment = $_POST['groupe_comment'];
                    $reply_to = $_POST['reply_to'];

                    submitreplygroupe($groupe_comment,$reply_to);
                    break;
                }
            case 'submitreply':
                if(isset($_POST['groupe_comment']) && isset($_POST['reply_to'])){
                    require_once 'controller/user.php';
                    $groupe_comment = $_POST['groupe_comment'];
                    $reply_to = $_POST['reply_to'];

                    submitreply($groupe_comment,$reply_to);
                    break;
                }
            case 'getresponses':
                if(isset($_POST['id_comment'])){
                    require_once 'controller/group.php';
                    $id_comment = $_POST['id_comment'];

                    getresponsegroup($id_comment);
                    break;
                }
            case 'getresponses_home':
                if(isset($_POST['id_comment'])){
                    require_once 'controller/user.php';
                    $id_comment = $_POST['id_comment'];

                    getresponsehome($id_comment);
                    break;
                }
            case 'commentlike':
                if(isset($_POST['id_comment'])){
                    require_once 'controller/group.php';
                    $id_comment = $_POST['id_comment'];

                    commentlike($id_comment);
                    break;
                }
            case 'commentlike_home':
                if(isset($_POST['id_comment'])){
                    require_once 'controller/user.php';
                    $id_comment = $_POST['id_comment'];

                    commentlike_home($id_comment);
                    break;
                }
            case 'removecommentlike':
                if(isset($_POST['id_comment'])){
                    require_once 'controller/group.php';
                    $id_comment = $_POST['id_comment'];

                    removecommentlike($id_comment);
                    break;
                }
            case 'removecommentlike_home':
                if(isset($_POST['id_comment'])){
                    require_once 'controller/user.php';
                    $id_comment = $_POST['id_comment'];

                    removecommentlike_home($id_comment);
                    break;
                }
            case 'replylike':
                if(isset($_POST['id_reply'])){
                    require_once 'controller/group.php';
                    $id_reply = $_POST['id_reply'];

                    replylike($id_reply);
                    break;
                }
            case 'replylike_home':
                if(isset($_POST['id_reply'])){
                    require_once 'controller/user.php';
                    $id_reply = $_POST['id_reply'];

                    replylike_home($id_reply);
                    break;
                }
            case 'removereplylike':
                if(isset($_POST['id_reply'])){
                    require_once 'controller/group.php';
                    $id_reply = $_POST['id_reply'];

                    removereplylike($id_reply);
                    break;
                }
            case 'removereplylike_home':
                if(isset($_POST['id_reply'])){
                    require_once 'controller/user.php';
                    $id_reply = $_POST['id_reply'];

                    removereplylike_home($id_reply);
                    break;
                }
            case 'delete_group':
                if(isset($_POST['id_group'])){
                    require_once 'controller/group.php';
                    $id_group = $_POST['id_group'];
                    deletegroup($id_group);
                    break;
                }
            case 'leave_group':
                if(isset($_POST['id_group']) && isset($_POST['id_user'])){
                    require_once 'controller/group.php';
                    $id_group = $_POST['id_group'];
                    $id_user = $_POST['id_user'];
                    leavegroup($id_group, $id_user);
                    break;
                }
            case 'change_group_banner':
                if(isset($_POST['id_group'])){
                    require_once 'controller/group.php';
                    $id_group = $_POST['id_group'];
                    change_group_banner($id_group);
                    break;
                }
            case 'multimedia_groupe':
                if(isset($_POST['id_group'])){
                    require_once 'controller/group.php';
                    $id_group = $_POST['id_group'];
                    multimedia_groupe($id_group);
                    break;
                }
            case 'selectmessages':
                if(isset($_POST['id_user'])){
                    require_once 'controller/messages.php';
                    $id_user = $_POST['id_user'];
                    selectmessages($id_user);
                    break;
                }
            case 'selectmessagesamie':
                if(isset($_POST['id_amie']) && isset($_POST['id_user'])){
                    require_once 'controller/messages.php';
                    $id_amie = $_POST['id_amie'];
                    $id_user = $_POST['id_user'];
                    selectmessagesamie($id_amie,$id_user);
                    break;
                }
            case 'sendMessage':
                if(isset($_POST['id_destinataire']) && isset($_POST['message'])){
                    require_once 'controller/messages.php';
                    $id_amie = $_POST['id_destinataire'];
                    $message = $_POST['message'];
                    sendMessage($id_amie,$message);
                    break;
                }
            case 'sendAudio':
                if(isset($_POST['id_destinataire']) && isset($_POST['finalTime'])){
                    require_once 'controller/messages.php';
                    $finalTime = $_POST['finalTime'];
                    $id_amie = $_POST['id_destinataire'];
                    sendAudio($id_amie,$finalTime);
                    break;
                }
            case 'vue':
                if(isset($_POST['id_message'])){
                    require_once 'controller/messages.php';
                    $id_message = $_POST['id_message'];
                    vue($id_message);
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
                    
                    afficherPosts();
                    break;
                
            case 'enregistrerPost2':
                require_once 'controller/user.php';
                enregistrerPosts();         
                break;

            case 'enregistrerPost3':
                require_once 'controller/user.php';
                enregistrerPostsSupprimer();              
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
            
                case "gestionstories":
                    require_once 'controller/user.php';
                    if(isset($_SESSION['conn']) && $_SESSION['conn'] == true){
                        if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true){
                            afficherStoriesAdmin();
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
            case "modifierpost":
                if(isset($_POST['post_groupe_id'])){
                    require_once 'controller/user.php';
                    $id_post_groupe = $_POST['post_groupe_id'];
                    $text_content = $_POST['text_content'];

                    modifierpostt($id_post_groupe,$text_content);
                    break;
                }
                
            case "modifierPostAdmin":
        
                require_once 'controller/user.php';
                modifierPostControler();
                break;
            case "afficherProfil":
                require_once 'controller/user.php';
                AfficherInfoUserSurProfilControler();
                break;
            case "modifierProfile":
                require_once 'controller/user.php';
                afficherModifierProfile();
                break;
            
            // case "afficherA"
                

            case 'ajouterStory':
                require_once 'controller/storyController.php';
                creerStory();
                break;
    
            case 'supprimerStory':
                require_once 'controller/storyController.php';
                supprimerStory();
                break;
    
            case 'afficherStories':  // Affichage des stories
                require_once 'controller/storyController.php';
                afficherStories();
                break;
            case 'ajouterAmie':  // Affichage des stories
                    require_once 'controller/user.php';
                    afficherAmiesController();
                    break;           
            case 'afficherModifierPostAdmin':
                    require_once 'controller/profile.php';
                    afficherPostProfileController($_SESSION['id_user']);
                    break;
                    
            case 'afficherPhotos':
                        require_once 'controller/profile.php';
                        afficherPostProfileController($_SESSION['id_user']);
                        break;
            case 'afficherPhotos':
                require_once 'controller/user.php';
                AfficherInfoUserSurProfilControlerPhotos();
                break;
            case "modifierProfile1":
                        require_once 'controller/user.php';
                        modifierProfilController();
                        break;
            case 'afficherAmies':
                    require_once 'controller/user.php';
                    AfficherInfoUserSurProfilControlerAmis();
                    
                    break;
            case 'listeUtilisateur':
                require_once 'vue/liste-utilisateur.php';
                    break;
                
            case 'utilisateurs':
                    require_once 'controller/profile.php';
                    obtenirTousLesUtlisateursControllerParId($_POST['id_user']);
                    break;

            case "notifications":
                require_once 'vue/notifications.php';
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