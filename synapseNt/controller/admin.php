<?php
    require_once 'model/admin.php';
    require_once 'model/users.php';
        
    function admin(){
        $id = $_SESSION['id_admin'];
        $admin = selectadmin($id);
        $fullname = $admin['prenom'] . " " . $admin['nom'];
        require_once 'vue/admin.php';
    }

    function validationsignupadmin($prenom,$nom,$date,$email,$pass){
        if (trim($prenom) == "") {
            $prenom_error = "Tapez votre Prenom.";
            header("Location:index.php?action=admin&prenom_error=" . $prenom_error );
            exit;
        } else {
            unset($prenom_error);
        }
        
        $nomprenomPattern = '/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/';
        if (!preg_match($nomprenomPattern, $prenom)) {
            $prenom_error = "Le prénom ne doit contenir que des lettres.";
            header("Location: index.php?action=admin&prenom_error=" . $prenom_error );
            exit;
        } else {
            unset($prenom_error);
        }

        if (trim($nom) == "") {
            $nom_error = "Tapez votre Nom.";
            header("Location: index.php?action=admin&nom_error=" . $nom_error );
            exit;
        } else {
            unset($nom_error);
        }

        if (!preg_match($nomprenomPattern, $nom)) {
            $nom_error = "Le nom ne doit contenir que des lettres.";
            header("Location: index.php?action=admin&nom_error=" . $nom_error );
            exit;
        } else {
            unset($nom_error);
        }

        if (trim($date) == "") {
            $date_error = "Tapez votre date de naissance.";
            header("Location: index.php?action=admin&date_error=" . $date_error );
            exit;
        } else {
            unset($date_error);
        }

        if (trim($email) == ""){
            $email2_error = "Tapez votre email";
            header("Location: index.php?action=admin&email2_error=" . $email2_error );
            exit;
        } else {
            unset($email2_error);
        }

        $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/';
        if (!preg_match($emailPattern, $email)) {
            $email2_error = "Tapez votre email au format valide";
            header("Location: index.php?action=admin&email2_error=" . $email2_error );
            exit;
        } else {
            unset($email2_error);
        }

        if(trim($pass) == ""){
            $pass2_error = "Tapez votre password";
            header("Location: index.php?action=admin&pass2_error=" . $pass2_error );
            exit;
        } else {
            unset($pass2_error);
        }

        $passwordPattern = '/^.{8,}$/';
        if (!preg_match($passwordPattern, $pass)) {
            $pass2_error = "Le mot de passe doit contenir au moins 8 caractères.";
            header("Location: index.php?action=admin&pass2_error=" . $pass2_error );
            exit;
        } else {
            unset($pass2_error);
        }

        if(check_email($email)){
            $email2_error = "Cet e-mail est déjà associé à un compte.";
            header("Location: index.php?action=admin&email2_error=" . $email2_error );
            exit;
        }else{
            $password = password_hash($pass, PASSWORD_DEFAULT);
            addAdmin($prenom,$nom,$date,$email,$password);
            
            include 'mail.php';
            $subject = "Valide account Synapse";
            $body = "<b>Connection successful</b>";

            sendEmail($email,$subject,$body);
            $_SESSION['conn'] = true;
            header("Location: index.php?action=admin");
            exit;
        }
    }

    function gestionusers(){
        $id = $_SESSION['id_admin'];
        $admin = selectadmin($id);
        $fullname = $admin['prenom'] . " " . $admin['nom'];

        if(isset($_POST['submit_search'])){
            $search = $_POST['search'];
            $search_by = $_POST['search_by'];
            $users = searchusers($search,$search_by);
        }elseif(isset($_POST['submit_all'])){
            $users = selectusers();
        }else{
            $users = selectusers();
        }


        require_once 'vue/gusers.php';
    }

    function delete_user($id){
        deleteuser($id);
        header("Location: index.php?action=gestionusers");
        exit;
    }

    function update_user($id_user){
        $id = $_SESSION['id_admin'];
        $admin = selectadmin($id);
        $fullname = $admin['prenom'] . " " . $admin['nom'];

        $user = selectuser($id_user);
        $email = $user['email'];
        $prenom = $user['prenom'];
        $nom = $user['nom'];
        $date = $user['date_naissance'];
        require_once 'vue/updateuser.php';
    }

    function valide_update_user($prenom,$nom,$date,$email,$id){
        if (trim($prenom) == "") {
            $prenom_error = "Tapez votre Prenom.";
            header("Location:index.php?action=update_user&id=". $id ."&prenom_error=" . $prenom_error );
            exit;
        } else {
            unset($prenom_error);
        }
        
        $nomprenomPattern = '/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/';
        if (!preg_match($nomprenomPattern, $prenom)) {
            $prenom_error = "Le prénom ne doit contenir que des lettres.";
            header("Location: index.php?action=update_user&id=". $id ."&prenom_error=" . $prenom_error );
            exit;
        } else {
            unset($prenom_error);
        }

        if (trim($nom) == "") {
            $nom_error = "Tapez votre Nom.";
            header("Location: index.php?action=update_user&id=". $id ."&nom_error=" . $nom_error );
            exit;
        } else {
            unset($nom_error);
        }

        if (!preg_match($nomprenomPattern, $nom)) {
            $nom_error = "Le nom ne doit contenir que des lettres.";
            header("Location: index.php?action=update_user&id=". $id ."&nom_error=" . $nom_error );
            exit;
        } else {
            unset($nom_error);
        }

        if (trim($date) == "") {
            $date_error = "Tapez votre date de naissance.";
            header("Location: index.php?action=update_user&id=". $id ."&date_error=" . $date_error );
            exit;
        } else {
            unset($date_error);
        }

        if (trim($email) == ""){
            $email2_error = "Tapez votre email";
            header("Location: index.php?action=update_user&id=". $id ."&email2_error=" . $email2_error );
            exit;
        } else {
            unset($email2_error);
        }

        $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$/';
        if (!preg_match($emailPattern, $email)) {
            $email2_error = "Tapez votre email au format valide";
            header("Location: index.php?action=update_user&id=". $id ."&email2_error=" . $email2_error );
            exit;
        } else {
            unset($email2_error);
        }

        if(check_email($email)){
            $user = selectuser($id);
            $mail = $user['email'];
            if($email != $mail){
                $email2_error = "Cet e-mail est déjà associé à un compte.";
                header("Location: index.php?action=update_user&id=". $id ."&email2_error=" . $email2_error );
                exit;
            }else{
                unset($email2_error);
                Updateuser($prenom,$nom,$date,$email,$id);
            
                include 'mail.php';
                $subject = "Account Update Notification";
                $body = "<b>Admin has updated your account successfully.</b>";

                sendEmail($email,$subject,$body);
                header("Location: index.php?action=gestionusers");
                exit;
            }
        }else{
            Updateuser($prenom,$nom,$date,$email,$id);
            
            include 'mail.php';
            $subject = "Account Update Notification";
            $body = "<b>Admin has updated your account successfully.</b>";

            sendEmail($email,$subject,$body);
            header("Location: index.php?action=gestionusers");
            exit;
        }
    }
?>