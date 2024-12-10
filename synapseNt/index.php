<?php
    session_start();
    $_SESSION['conn'] = false;
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        
        switch ($action) {
            case 'add':
                require_once 'controller/user.php';
                login_signup();
                break;
            case 'reintialiser':
                require_once 'controller/user.php';
                reintialiser();
                break;
            case 'home':
                require_once 'controller/user.php';
                home();
                break;
            case 'validationlogin':
                require_once 'controller/user.php';
                if(isset($_POST['logemail']) && isset($_POST['logpass'])){
                    $email = $_POST['logemail'];
                    $pass = $_POST['logpass'];
                    validationlogin($email,$pass);
                }
                break;
            case 'validationsignup':
                require_once 'controller/user.php';
                if(isset($_POST['logprenom'], $_POST['lognom'], $_POST['logyear'], $_POST['logmonth'], $_POST['logday'], $_POST['logemail'], $_POST['logpass'])){
                    $prenom = $_POST['logprenom'];
                    $nom = $_POST['lognom'];
                    $year = $_POST['logyear'];
                    $month = $_POST['logmonth'];
                    $day = $_POST['logday'];
                    $email = $_POST['logemail'];
                    $pass = $_POST['logpass'];

                    validationsignup($prenom,$nom,$year,$month,$day,$email,$pass);
                }
                break;
        }
    }else{
        require_once 'controller/user.php';
        login_signup();
    }

?>