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

        $sqlstate = $db->prepare('SELECT id_group FROM groupe ORDER BY id_group DESC LIMIT 1');
        $sqlstate->execute([]);
        $id_group = $sqlstate->fetch(PDO::FETCH_OBJ)->id_group;

        $sqlstate = $db->prepare('INSERT INTO group_membre(id_groupe,id_user) VALUES(?,?)');
        $sqlstate->execute([$id_group,$id]);
        
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

    function kickmembergroup($id_groupe_member){
        $db = database_connection();

        $sqlstate = $db->prepare('DELETE FROM group_membre WHERE id_groupe_member = ?');
        $sqlstate->execute([$id_groupe_member]);
    }

    function invitasadmingroup($id_groupe_member,$id_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO groupe_invit_admin(id_groupe,id_user) VALUES(?,?)');
        $sqlstate->execute([$id_groupe,$id_groupe_member]);
    }

    function select_amie_group($id_user){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT user.prenom, user.nom, user.id_user FROM user JOIN followers on user.id_user = followers.id_amie where followers.id_user = ?');
        $sqlstate->execute([$id_user]); 
        $amis = $sqlstate->fetchAll(PDO::FETCH_OBJ);

        return $amis;
    }

    function invit_amie_groupe($id_user,$id_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO invit_par_groupe(id_groupe,id_user) VALUES(?,?)');
        $sqlstate->execute([$id_groupe,$id_user]);
    }

    function cancel_invit_groupe($id_user,$id_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('DELETE FROM invit_par_groupe WHERE id_groupe = ? AND id_user = ?');
        $sqlstate->execute([$id_groupe,$id_user]);
    }

    function countpostgroupe($id_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT COUNT(*) AS count FROM groupe_post WHERE id_groupe = ?');
        $sqlstate->execute([$id_groupe]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }

    function insertgroupPost($text_content, $imageUrl, $currentDate, $id_user, $id_groupe){
        $db = database_connection();
        $sqlState = $db->prepare('INSERT INTO groupe_post (text_content_groupe, image_path_groupe, date_post_groupe, id_user, id_groupe) VALUES (?, ?, ?, ?, ?)');
        $sqlState->execute([$text_content,$imageUrl,$currentDate, $id_user, $id_groupe]);
    }

    function selectgroupeposts($id_groupe){
        $db = database_connection();
        $sqlstate = $db->prepare('SELECT * FROM groupe_post JOIN user ON user.id_user = groupe_post.id_user  WHERE id_groupe = ? ORDER BY id_groupe_post DESC');
        $sqlstate->execute([$id_groupe]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function selectpostgroupeinfo($id_post){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM groupe_post WHERE id_groupe_post = ?');
        $sqlstate->execute([$id_post]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }

    function modifiergroupePost($text_content, $imageUrl, $id_post_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('UPDATE groupe_post SET text_content_groupe = ?, image_path_groupe = ? WHERE id_groupe_post = ?');
        $sqlstate->execute([$text_content, $imageUrl, $id_post_groupe]);
    }

    function supprimerPostgroupe($id_post_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('DELETE FROM groupe_post WHERE id_groupe_post = ?');
        $sqlstate->execute([$id_post_groupe]);
    }

    function likePostgroupe($id_post_groupe,$id_user){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO groupe_post_like(id_post,id_liker) VALUES(?,?)');
        $sqlstate->execute([$id_post_groupe,$id_user]);
    }

    function unlikePostgroupe($id_post_groupe,$id_user){
        $db = database_connection();

        $sqlstate = $db->prepare('DELETE FROM groupe_post_like WHERE id_post = ? AND id_liker = ?');
        $sqlstate->execute([$id_post_groupe,$id_user]);
    }

    function selectgroupepostslikes($id_user){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM groupe_post_like where id_liker = ?');
        $sqlstate->execute([$id_user]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function countlikesgroupe(){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT id_post, COUNT(*) as countlike FROM groupe_post_like GROUP BY id_post;');
        $sqlstate->execute([]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function countlikespost($id_post_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT COUNT(*) as countlike FROM groupe_post_like where id_post = ?');
        $sqlstate->execute([$id_post_groupe]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }

    function selectenregistrementgroupepost($id_user,$id_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM enregistrer_posts LEFT JOIN groupe_post ON enregistrer_posts.id_post_groupe = groupe_post.id_groupe_post WHERE enregistrer_posts.id_user = ? AND groupe_post.id_groupe = ?');
        $sqlstate->execute([$id_user,$id_groupe]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function savePostgroupe($id_post_groupe,$id_user){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO enregistrer_posts(id_post_groupe,id_user) VALUES(?,?)');
        $sqlstate->execute([$id_post_groupe,$id_user]);
    }

    function unsavePostgroupe($id_post_groupe,$id_user){
        $db = database_connection();

        $sqlstate = $db->prepare('DELETE FROM enregistrer_posts WHERE id_post_groupe = ? AND id_user = ?');
        $sqlstate->execute([$id_post_groupe,$id_user]);
    }

    function selectpostgroupe($id_post_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM groupe_post JOIN user ON user.id_user = groupe_post.id_user WHERE id_groupe_post = ?');
        $sqlstate->execute([$id_post_groupe]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }   

    function selectenregistrementgroupepostpartage($id_user,$id_post_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM enregistrer_posts  WHERE id_user = ? AND id_post_groupe = ?');
        $sqlstate->execute([$id_user,$id_post_groupe]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }

    function selectid_groupe($id_post_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT id_groupe FROM groupe_post WHERE id_groupe_post = ?');
        $sqlstate->execute([$id_post_groupe]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }

    function isingroup($id,$id_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM group_membre WHERE id_user = ? AND id_groupe = ?');
        $sqlstate->execute([$id,$id_groupe]);
        return empty($sqlstate->fetchAll(PDO::FETCH_OBJ));
    }

    function countcommentsgroupe($id_group){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT groupe_post.id_groupe_post, COUNT(groupe_comment.id_post_groupe) AS comment_count FROM groupe_post LEFT JOIN groupe_comment ON groupe_comment.id_post_groupe = groupe_post.id_groupe_post WHERE groupe_post.id_groupe = ? GROUP BY groupe_post.id_groupe_post');
        $sqlstate->execute([$id_group]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }
    function selectcommentsgroupe($id_post_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM groupe_comment JOIN group_membre ON group_membre.id_groupe_member = groupe_comment.id_user JOIN user ON user.id_user = group_membre.id_user WHERE id_post_groupe = ?');
        $sqlstate->execute([$id_post_groupe]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }
?>