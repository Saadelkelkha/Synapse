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

    function searchgroups($search,$search_by){
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM groupe WHERE $search_by LIKE ?");
        $sqlstate->execute(["%$search%"]);
        $users = $sqlstate->fetchAll(PDO::FETCH_ASSOC);

        if ($users) {
            return $users;
        } else {
            return [];
        }
    }

    function selectgroups(){
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM groupe");
        $sqlstate->execute();
        $users = $sqlstate->fetchAll(PDO::FETCH_ASSOC);

        if ($users) {
            return $users;
        } else {
            return [];
        }
    }

    function deletegroupee($id){
        $db = database_connection();

        $sqlstate = $db->prepare("DELETE FROM groupe WHERE id_group = ?");
        $sqlstate->execute([$id]);
    }

    function selectgroupe($id){
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM groupe where id_group = ?");
        $sqlstate->execute([$id]);
        $users = $sqlstate->fetch(PDO::FETCH_ASSOC);

        if ($users) {
            return $users;
        } else {
            return [];
        }
    }

    function Updategroupe($name_group,$description_group,$id){
        $db = database_connection();

        $sqlstate = $db->prepare("UPDATE groupe SET name_group = ?, description_group = ? WHERE id_group = ?");
        $sqlstate->execute([$name_group,$description_group,$id]);
    }

    function remove_banner_groupe($id){
        $db = database_connection();

        $sqlstate = $db->prepare("UPDATE groupe SET group_banner = 'img/groupes/groupe.jpg'	WHERE id_group = ?");
        $sqlstate->execute([$id]);
    }
?>