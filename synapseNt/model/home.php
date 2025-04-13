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
     /* mn hna tghyir*/
    function modifierPost($text_content , $imagePath, $id_post){
        $db = database_connection();
        $sqlstate = $db->prepare("UPDATE post SET text_content = ? , image_path = ? WHERE id_post = ?");
        return $sqlstate->execute([$text_content , $imagePath,  $id_post]);
    }

    function afficherEnregistrerPost(){
        $db = database_connection();
        $sqlState = $db->query('SELECT * FROM post inner join enregistrer_posts on post.id_post = enregistrer_posts.id_post where post.id_post = enregistrer_posts.id_post');
        return $sqlState->fetchAll(PDO::FETCH_OBJ);
    }
    function afficherAmiesM(){
        $db = database_connection();
        $sqlState = $db->query('SELECT * FROM user inner join followers on user.id_user = followers.id_user where user.id_user = followers.id_user');
        return $sqlState->fetchAll(PDO::FETCH_OBJ);
    }

?>