<?php

    require_once 'db.php';

    function check_email($email) {
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM user WHERE email = ?");
        $sqlstate->execute([$email]);

        $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return true;
        }else{
            $sqlstate = $db->prepare("SELECT * FROM admin WHERE email = ?");
            $sqlstate->execute([$email]);

            $admin = $sqlstate->fetch(PDO::FETCH_ASSOC);
            
            if ($admin) {
                $_SESSION['is_admin'] = true;
                return true;
            }else{
                return false;
            }
        }
    }

    function check_password($email, $pass){
        $db = database_connection();

        if($_SESSION["is_admin"]){
            $sqlstate = $db->prepare("SELECT * FROM admin WHERE EMAIL = ?");
            $sqlstate->execute([$email]);

            $admin = $sqlstate->fetch(PDO::FETCH_ASSOC);

            if ($admin) {
                if (password_verify($pass, $admin['password'])){
                    $_SESSION['id_admin'] = $admin['id_admin'];
                    $_SESSION['conn'] = true;
                    return true;
                }
            }else{
                $_SESSION["is_admin"] = false;
                return false;
            }

        }else{
            $sqlstate = $db->prepare("SELECT * FROM user WHERE EMAIL = ?");
            $sqlstate->execute([$email]);

            $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($pass, $user['password'])){
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['conn'] = true;
                    return true;
                }
            }else{
                return false;
            }
        }
    }

    function addUser($prenom,$nom,$logdate,$email,$password){
        $db = database_connection();
        $query = $db->prepare("INSERT INTO user(id_user,prenom,nom,date_naissance,email,password) values(null,?,?,?,?,?)");
        $query->execute([$prenom,$nom,$logdate,$email,$password]);

        $sqlstate = $db->prepare("SELECT * FROM user WHERE EMAIL = ?");
        $sqlstate->execute([$email]);
        $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['conn'] = true;

        if ($user) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['conn'] = true;
        }
    }

    function UpdatePassword($email,$password,$admin){
        $db = database_connection();
        if($admin){
            $query = $db->prepare("UPDATE admin SET PASSWORD = ? WHERE EMAIL = ?");
        }else{
            $query = $db->prepare("UPDATE user SET PASSWORD = ? WHERE EMAIL = ?");
        }
        $query->execute([$password,$email]);
    }

    function add_token($email,$token,$expiry){
        if($_SESSION["is_admin"]){
            $is_admin = 1;
        }else{
            $is_admin = 0;
        }
        $db = database_connection();
        $query = $db->prepare("INSERT INTO password_resets(email, token, expire_at, is_admin) values(?,?,?,?)");
        $query->execute([$email,$token,$expiry,$is_admin]);
        $_SESSION["is_admin"] = false;
    }

    function check_token($token){
        $db = database_connection();
        $query = $db->prepare("SELECT email FROM password_resets WHERE token = ? AND expire_at > NOW()");
        $query->execute([$token]);
        $email = $query->fetch(PDO::FETCH_ASSOC);
        if ($email){
            return $email['email'];
        }else{
            return false;
        }
    }

    function delete_token($email){
        $db = database_connection();
        $query = $db->prepare("DELETE FROM password_resets WHERE email = ?");
        $query->execute([$email]);
    } 

    function selectuser($id){
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM user WHERE id_user = ?");
        $sqlstate->execute([$id]);
        $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        }else{
            return [];
        }
    }

    

 
?>