<?php
    require_once 'model/users.php';

    function login_signup(){
        require_once 'vue/login.php';
    }
    
    function reintialiser(){
        require_once 'vue/reinitialiser.php';
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
                    header("Location: index.php?action=home");
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
    
    function validationsignup($prenom,$nom,$year,$month,$day,$email,$pass){
        if (trim($prenom) == "") {
            $prenom_error = "Tapez votre Prenom.";
            header("Location:index.php?action=add&prenom_error=" . $prenom_error );//urlencode($prenom_error)
            exit;
        } else {
            unset($prenom_error);
        }
        
        $nomprenomPattern = '/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/';
        if (!preg_match($nomprenomPattern, $prenom)) {
            $prenom_error = "Le prénom ne doit contenir que des lettres.";
            header("Location: index.php?action=add&prenom_error=" . $prenom_error );//urlencode($prenom_error)
            exit;
        } else {
            unset($prenom_error);
        }

        if (trim($nom) == "") {
            $nom_error = "Tapez votre Nom.";
            header("Location: index.php?action=add&nom_error=" . $nom_error );//urlencode($prenom_error)
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

        if (trim($year) == "") {
            $year_error = "Tapez votre année d'anniversaire.";
            header("Location: index.php?action=add&year_error=" . $year_error );
            exit;
        } else {
            unset($year_error);
        }

        if (trim($month) == "") {
            $month_error = "Tapez votre mois d'anniversaire.";
            header("Location: index.php?action=add&month_error=" . $month_error );
            exit;
        } else {
            unset($month_error);
        }

        $isLeapYear = ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);

        if (in_array($month, [1, 3, 5, 7, 8, 10, 12])) {
            if(intval($day) > 31){
                $day_error = "Le jour doit être compris entre 1 et 31 pour ce mois.";
                header("Location: index.php?action=add&day_error=" . $day_error );
            }else {
                unset($day_error);
            }
        } elseif (in_array($month, [4, 6, 9, 11])) {
            if(intval($day) > 30){
                $day_error = "Le jour doit être compris entre 1 et 30 pour ce mois.";
                header("Location: index.php?action=add&day_error=" . $day_error );
            }else {
                unset($day_error);
            }
        } elseif ($month == 2) {
            $max_day = $isLeapYear ? 29 : 28;
            if(intval($day) > $max_day){
                $day_error = $isLeapYear ? "Le jour doit être compris entre 1 et 29 pour le mois de février d'une année bissextile." : "Le jour doit être compris entre 1 et 28 pour le mois de février.";
                header("Location: index.php?action=add&day_error=" . $day_error );
            }else {
                unset($day_error);
            }
        }

        if (trim($day) == "") {
            $day_error = "Tapez votre jour d'anniversaire.";
            header("Location: index.php?action=add&day_error=" . $day_error );
            exit;
        } else {
            unset($day_error);
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
            $logdate = $year . "-" . $month . "-" . $day;
            $password = password_hash($pass, PASSWORD_DEFAULT);
            addUser($prenom,$nom,$logdate,$email,$password);
            header("Location: index.php?action=home");
            exit;
        }
    }

    function home(){
        require_once 'vue/home.php';
    }
?>