<?php
    require_once 'db.php';

    function addAdmin($prenom,$nom,$logdate,$email,$password){
        $db = database_connection();
        $query = $db->prepare("INSERT INTO admin values(null,?,?,?,?,?)");
        $query->execute([$prenom,$nom,$logdate,$email,$password]);

        $sqlstate = $db->prepare("SELECT * FROM admin WHERE EMAIL = ?");
        $sqlstate->execute([$email]);
        $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

        $_SESSION['id_admin'] = $user['id_admin'];
        $_SESSION['conn'] = true;
        $_SESSION['isadmin'] = true;

        if ($user) {
            $_SESSION['id_admin'] = $user['id_admin'];
            $_SESSION['conn'] = true;
            $_SESSION['is_admin'] = true;
        }
    }

    function selectadmin($id){
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM admin WHERE id_admin = ?");
        $sqlstate->execute([$id]);
        $admin = $sqlstate->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            return $admin;
        }else{
            return false;
        }
    }

    function selectusers(){
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM user");
        $sqlstate->execute();
        $users = $sqlstate->fetchAll(PDO::FETCH_ASSOC);

        if ($users) {
            return $users;
        } else {
            return [];
        }
    }

    function searchusers($search,$search_by){
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM user WHERE $search_by LIKE ?");
        $sqlstate->execute(["%$search%"]);
        $users = $sqlstate->fetchAll(PDO::FETCH_ASSOC);

        if ($users) {
            return $users;
        } else {
            return [];
        }
    }

    function deleteuser($id){
        $db = database_connection();

        $sqlstate = $db->prepare("DELETE FROM user WHERE id_user = ?");
        $sqlstate->execute([$id]);
    }

    function Updateuser($prenom,$nom,$date,$email,$id){
        $db = database_connection();

        $sqlstate = $db->prepare("UPDATE user SET prenom = ?, nom = ?, date_naissance = ?, email = ? WHERE id_user = ?");
        $sqlstate->execute([$prenom,$nom,$date,$email,$id]);
    }

?>