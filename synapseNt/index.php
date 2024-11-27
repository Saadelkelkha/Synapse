<?php
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            case 'add':
                require_once 'controller/user.php';
                login_signout();
                break;
            case 'reintialiser':
                require_once 'controller/user.php';
                reintialiser();
                break;
        }
    }else{
        require_once 'controller/user.php';
        login_signout();
    }

?>