<?php
    require_once 'db.php';

    function recherchervosGroup($id){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM groupe where id_admin = ?');
        $sqlstate->execute([$id]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function rechercherjoinGroup($id){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT groupe.* FROM groupe JOIN group_membre ON groupe.id_group = group_membre.id_groupe WHERE group_membre.id_user = ?');
        $sqlstate->execute([$id]);
        $groupes = $sqlstate->fetchAll(PDO::FETCH_OBJ);

        return $groupes;
    }

    function recherchersuggestionGroup($id){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT g.* FROM groupe g LEFT JOIN group_membre gm  ON g.id_group = gm.id_groupe AND gm.id_user = ? WHERE g.id_admin != ? AND gm.id_user IS NULL;');
        $sqlstate->execute([$id,$id]);
        $groupes = $sqlstate->fetchAll(PDO::FETCH_OBJ);

        return $groupes;
    }

    function recherchervosGroupParkeywords($id, $keywords){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM groupe WHERE id_admin = ? AND name_group LIKE ?');
        $sqlstate->execute([$id, '%' . $keywords . '%']);
        $groupes = $sqlstate->fetchAll(PDO::FETCH_OBJ);

        return $groupes;
    }

    function rechercherjoinGroupParkeywords($id, $keywords){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT groupe.* FROM groupe JOIN group_membre ON groupe.id_group = group_membre.id_groupe WHERE group_membre.id_user = ? AND groupe.name_group LIKE ?');
        $sqlstate->execute([$id, '%' . $keywords . '%']);
        $groupes = $sqlstate->fetchAll(PDO::FETCH_OBJ);

        return $groupes;
    }

    function recherchersuggestionGroupParkeywords($id, $keywords){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT g.* FROM groupe g LEFT JOIN group_membre gm ON g.id_group = gm.id_groupe AND gm.id_user = ? WHERE g.id_admin != ? AND gm.id_user IS NULL AND g.name_group LIKE ?');
        $sqlstate->execute([$id, $id, '%' . $keywords . '%']);
        $groupes = $sqlstate->fetchAll(PDO::FETCH_OBJ);

        return $groupes;
    }

    function selectinvitationgroup(){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM groupe_invitation');
        $sqlstate->execute([]);
        $invitations = $sqlstate->fetchAll(PDO::FETCH_OBJ);

       return $invitations;
    }



    function addgroup($name, $description, $id){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO groupe(id_admin,name_group,description_group) VALUES(?,?,?)');
        $sqlstate->execute([$id, $name, $description]);

        
    }

    function join_group($idgroupe,$iduser){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO groupe_invitation(id_groupe,id_user) VALUES(?,?)');
        $sqlstate->execute([$idgroupe,$iduser]);
    }

    function selectGroup($id){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM groupe where id_group = ?');
        $sqlstate->execute([$id]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function countmemberGroup($id){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT COUNT(*) AS count FROM group_membre where id_groupe = ?');
        $sqlstate->execute([$id]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function canceljoin_group($idgroupe,$iduser){
        $db = database_connection();

        $sqlstate = $db->prepare('DELETE FROM groupe_invitation WHERE id_groupe = ? AND id_user = ?');
        $sqlstate->execute([$idgroupe,$iduser]);
    }

    function selectinvitationgroupparid($id_group){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM groupe_invitation JOIN user ON groupe_invitation.id_user = user.id_user WHERE groupe_invitation.id_groupe = ?');
        $sqlstate->execute([$id_group]);
        $invitations = $sqlstate->fetchAll(PDO::FETCH_OBJ);

        return $invitations;
    }

    function selectmembresgroupparid($id_group){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM group_membre JOIN user ON group_membre.id_user = user.id_user WHERE group_membre.id_groupe = ?');
        $sqlstate->execute([$id_group]);
        $membres = $sqlstate->fetchAll(PDO::FETCH_OBJ);

        return $membres;
    }

    function acceptinvitation($id_user,$id_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO GROUP_MEMBRE(id_user,id_groupe) VALUES(?,?)');
        $sqlstate->execute([$id_user,$id_groupe]);
    }

    function rejectinvitation($id_user,$id_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('DELETE FROM groupe_invitation WHERE id_groupe = ? AND id_user = ?');
        $sqlstate->execute([$id_groupe,$id_user]);
    }
?>