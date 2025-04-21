<?php
    require_once 'db.php';


    function rechercherNomPrenom($keywords){
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT nom , prenom FROM user WHERE concat(nom ,' ' ,prenom) LIKE :keywords OR  concat(prenom ,' ' ,nom) LIKE :keywords");
        $sqlstate->execute([':keywords' => '%' . $keywords . '%']);
        $users = $sqlstate->fetchAll(PDO::FETCH_OBJ);

        return $users;
    }

    function rechercherNomGroup($keywords){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT name_group,description_group FROM groupe WHERE name_group LIKE :keywords');
        $sqlstate->execute([':keywords' => '%' . $keywords . '%']);
        $groupes = $sqlstate->fetchAll(PDO::FETCH_OBJ);

        return $groupes;
    }

    function insertPost($text_content,$imageUrl,$currentDate,$id_user){
        $db = database_connection();
        $sqlState = $db->prepare('INSERT INTO post (text_content, image_path, date_post, id_user) VALUES (?, ?, ?, ?)');
        $post = $sqlState->execute([$text_content,$imageUrl,$currentDate, $id_user]);
        return $post;
    }


    function obtenirTousLesPosts() {
        $db = database_connection();
        $sqlState = $db->query('SELECT * FROM post');
        return $sqlState->fetchAll(PDO::FETCH_OBJ);
    }
    
    function obtenirPostParId($id_post) {
        $db = database_connection();
        $sqlState = $db->prepare('SELECT * FROM post WHERE id_post = ?');
        $sqlState->execute([$id_post]);
        $result = $sqlState->fetch(PDO::FETCH_OBJ);
        if (!$result) {
            return null; // Aucun résultat trouvé
        }
        return $result;
    }
    
    function enregistrerPostModel($id_user, $id_post, $saved_at){
        $db = database_connection(); 
        $sqlState = $db->prepare('INSERT INTO enregistrer_posts (id_user, id_post, saved_at) VALUES (?, ?, ?)');
        $enregsitrer = $sqlState->execute([$id_user, $id_post, $saved_at]);    
        return $enregsitrer; 
   
    }
    
    function supprimerPosteModel($id_post){
        $db = database_connection();
        $sqlState = $db->prepare('DELETE FROM post WHERE id_post = ?');
        return $sqlState->execute([$id_post]);
    }

    function afficherEnregistrerPost($id){
        $db = database_connection();
        $sqlState = $db->prepare('SELECT * FROM enregistrer_posts left join post on post.id_post = enregistrer_posts.id_post left join groupe_post on groupe_post.id_groupe_post = enregistrer_posts.id_post_groupe left join user on user.id_user = post.id_user or user.id_user = groupe_post.id_user WHERE enregistrer_posts.id_user = ?');
        $sqlState->execute([$id]);
        return $sqlState->fetchAll(PDO::FETCH_OBJ);
    }
    function afficherAmiesM(){
        $db = database_connection();
        $sqlState = $db->query('SELECT * FROM user inner join followers on user.id_user = followers.id_user where user.id_user = followers.id_user');
        return $sqlState->fetchAll(PDO::FETCH_OBJ);
    }

    function countcomments(){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT post.id_post, COUNT(comment_post.id_post_groupe) AS comment_count FROM post LEFT JOIN comment_post ON comment_post.id_post_groupe = post.id_post GROUP BY post.id_post');
        $sqlstate->execute([]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function likesamie($id){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM likes JOIN friends ON likes.id_user = friends.user_id_2 OR likes.id_user = friends.user_id_1 JOIN user ON user.id_user = friends.user_id_2 OR user.id_user = friends.user_id_1 WHERE (friends.user_id_2 = ? OR friends.user_id_1 = ?)  AND likes.id_user != ? AND user.id_user != ?');
        $sqlstate->execute([$id,$id,$id,$id]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function selectpostinfoo($id_post){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM post WHERE id_post = ?');
        $sqlstate->execute([$id_post]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }

    function modifierPost($text_content, $imageUrl, $id_post_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('UPDATE post SET text_content = ?, image_path = ? WHERE id_post = ?');
        $sqlstate->execute([$text_content, $imageUrl, $id_post_groupe]);
    }

?>