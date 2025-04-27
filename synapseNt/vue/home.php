<?php

$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");

$sqlState = $pdo->query('SELECT * FROM  post join user on user.id_user = post.id_user');
$posts = $sqlState->fetchAll(PDO::FETCH_OBJ);


$enregistrerpostes = $pdo->prepare('SELECT * FROM enregistrer_posts LEFT JOIN post ON enregistrer_posts.id_post = post.id_post WHERE enregistrer_posts.id_user = ?');
$enregistrerpostes->execute([$id]);
$enregistrerpostes = $enregistrerpostes->fetchAll(PDO::FETCH_OBJ);




$id_post = $_GET['id_post'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SynapseNt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/home.css" />
    <style>

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4599FF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2B2757;
        }

        /* Popup styles */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none; /* Hidden by default */
            z-index: 1000;
            text-align: center;
        }

        .popup h2 {
            margin-bottom: 10px;
        }

        .popup button {
            background-color: #2B2757;
        }

        /* Overlay to dim background */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none; /* Hidden by default */
            z-index: 999;
        }

        .creer-poste {
            
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container_creer{
            width: 400px;
            overflow: hidden;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
            z-index: 300;
            position: relative;
        }

        .post header {
            font-size: 22px;
            font-weight: 600;
            padding: 17px 0;
            text-align: center;
        }

        .post form {
            margin: 20px 25px;
        }

        form textarea {
            width: 100%;
            resize: none;
            font-size: 18px;
            min-height: 100px;
            outline: none;
            border: none;
            margin-bottom: 15px;
        }

        #uploadedImageContainer img {
            height: 100px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 80%;
            margin-top: 10px;
        }

        #uploadedImageContainer {
            display: flex;
            justify-content: center;
        }

        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 57px;
            margin: 15px 0;
            padding: 0 15px;
            border-radius: 7px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .options p {
            color: #595959;
            font-size: 15px;
            font-weight: 500;
            cursor: default;
        }

        .options .list {
            display: flex;
            list-style: none;
        }

        .options .list li {
            cursor: pointer;
        }

        .options .list li label {
            cursor: pointer;
            display: inline-block;
            padding: 10px;
        }

        .options .list li input[type="file"] {
            display: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background-color: #2B2757;
            border: none;
            border-radius: 8px;
            cursor: pointer;

        }

        input[type="submit"]:hover {
            background-color:rgb(47, 41, 112);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .dropdown {
                    position: relative;
                    display: inline-block;
                }
        .dropdown-btn {
            background-color: while;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-content a {
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown.show .dropdown-content {
            display: block;
        }
        .btn-enregsitrer{
            color:black;
            background-color:white;
        }
        .btn-enregistrer i:hover{
            color:white;
        }

        .hidden-modifier {
            display: none;
        }

        .overlay-modifier {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
        }

        .popup-modifier {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 10px;
            z-index: 1100;
            width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .popup-modifier header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .popup-modifier textarea {
            width: 100%;
            height: 100px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .popup-modifier .options-modifier {
            text-align: left;
            margin-bottom: 20px;
        }

        .popup-modifier .options-modifier p {
            margin: 0;
            font-size: 1rem;
            color: #555;
        }

        .popup-modifier .options-modifier label {
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
        }

        .popup-modifier .options-modifier label img {
            width: 24px;
            height: 24px;
        }

        .popup-modifier button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            margin: 5px;
            width: calc(50% - 10px);
        }

        .popup-modifier button:hover {
            background-color: #45a049;
        }

        .popup-modifier .close-popup-btn-modifier {
            background-color: #f44336;
        }

        .popup-modifier .close-popup-btn-modifier:hover {
            background-color: #e53935;
        }

        .dropdown-modifier {
            position: relative;
            display: inline-block;
        }

        .dropdown-content-modifier {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content-modifier button,
        .dropdown-content-modifier a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            text-align: left;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
        }

        .dropdown-content-modifier button:hover,
        .dropdown-content-modifier a:hover {
            background-color: #f3f4f6;
        }

        .dropdown-modifier .dropdown-btn-modifier:focus + .dropdown-content-modifier {
            display: block;
        }

        .enregistrer-annuler-btn{
            display:flex;
        }
        .btn-modifier-supprimer1{
            color:black;
            background-color: transparent;
            
        }
        .btn-modifier-supprimer1:hover{
            color:white;
           border-radius:50%;
           background-color: lightgrey;
           
            
        }

        /* .like_button:hover{
            background-color: red;
        } */

    </style>
</head>
<body>
    <div class=" mt-3">
        <!-- Navbar -->
        <?php require_once 'vue/layout/navhome1.php'; ?>
       

        <main class="mt-1 d-flex">
            <!-- Sidebar -->
            <?php require_once 'vue/layout/navhome2.php';   ?>
            

            
            <!-- Formulaire de création de post -->
            <div class="content_chat pb-5">
                <div class="content flex-grow-1">
                <?php require_once 'afficherStories.php'; ?>
                
             

             <?php include 'storyPopup.php'; ?>


                    <!-- Formulaire de création de post -->
                    <form class="create-post mb-3 mt-4" >
                        <div class="profile-pic mb-3 d-flex">
                            <img src="<?php echo $user['photo_profil']; ?>">
                            <input type="text" style="background-color: #f6f7f8; border-color: #f6f7f8;" placeholder="What's happening?" class="form-control mb-2 mt-2 ms-2" id="openPopup" readonly>
                        </div>
                    </form>
                    <!-- Popup -->
                    <div class="overlay" id="overlay"></div>
                    <div class="popup" id="popup">
                        <div class="creer-poste">
                            <div class="container_creer">
                                <div class="wrapper">
                                    <section class="post">
                                        <header>Create Post</header>
                                        <form method="post" enctype="multipart/form-data" action="index.php?action=post">
                                            <textarea name="text_content" placeholder="What's on your mind, SynapseNt?" ></textarea>
                                            <div id="uploadedImageContainer"></div>
                                            <div class="options">
                                                <p>Ajouter à votre poste</p>
                                                <ul class="list">
                                                    <li>
                                                        <label for="imageInput">
                                                            <i class="bi bi-images"></i>
                                                        </label>
                                                        <input type="file" id="imageInput" accept="image/*" name="image">
                                                    </li>
                                                </ul>
                                            </div>
                                            <input type="submit" value="Post" name="post">
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feed -->
                    <?php
foreach($posts as $post) {
    // Récupérer l'ID de l'utilisateur depuis la session
    $id_user = $_SESSION['id_user'];  
     
    // Assurez-vous que l'ID de l'utilisateur est stocké dans la session

    ?>
    <div class="feed" width="100%">
        <div class="user">
            <div class="profile-pic" width="100%" style="display: flex; gap: 10px;">
            <img src="<?php echo $post->photo_profil; ?>">
                <div class="name1">
                    <h5 class=" mb-0" ><?php echo $post->prenom; ?> <?php echo $post->nom; ?></h5>
                    

                                    <input type="hidden" name="id_post" value="<?php echo $post->id_post; ?>">
                                    <small style="font-size:small; color: #777;"><?php echo $post->date_post; ?></small>
                                    <div class="caption mt-4">
                                        <span class="hash-tag hash-tag-<?= $post->id_post ?>"><?php echo $post->text_content; ?></span></p>
                                    </div>
                                    
                                </div>
                                <div class="dropdown-modifier"><?php 
                                    if (isset($_SESSION['id_user'])) {
                                        $id = $_SESSION['id_user']; ?>
                                    <button class="dropdown-btn-modifier btn-modifier-supprimer1">...</button>
                                    <?php } ?>
                                    <div class="dropdown-content-modifier">
                                        <!-- <a href="index.php?action=afficherModifierPost&id_post=<?php echo $post->id_post; ?>">Modifier</a> -->
                                        <button class="open-popup-btn-modifier" onclick="affichemodifier(<?php echo $post->id_post; ?>)">Modifier</button>
                                        <button class="open-popup-btn-supprimer" onclick="affichesupprimer(<?php echo $post->id_post; ?>)">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="imageorvideopost imageorvideopost-<?= $post->id_post ?> bg-dark d-flex justify-content-center">
                        <?php
                            // Récupérer l'extension du fichier
                            $fileExtension = pathinfo($post->image_path, PATHINFO_EXTENSION);

                            // Vérifier si c'est une image ou une vidéo
                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                            $videoExtensions = ['mp4', 'webm', 'ogg'];

                            if (in_array(strtolower($fileExtension), $imageExtensions)) {
                                // Si c'est une image
                                echo '<img class="image-width" style="max-heigth:20vh;max-width:100%"  src="' . htmlspecialchars($post->image_path, ENT_QUOTES, 'UTF-8') . '" />';
                            } elseif (in_array(strtolower($fileExtension), $videoExtensions)) {
                                // Si c'est une vidéo
                                echo '<video src="' . htmlspecialchars($post->image_path, ENT_QUOTES, 'UTF-8') . '" controls></video>';
                            }
                        ?>
                        </div>
                        <div class="action-button" style="display: flex; justify-content: space-between;">
                            <div class="interaction-button">
                                <span><button style="background-color:white; color:black" class="like_button p-0" data-post-id="<?php echo $post->id_post; ?>" data-user-id="<?php echo $id_user; ?>"><i class="uil uil-thumbs-up" style="font-size: x-large;"></i></button> <!-- Bouton Like --></span>

                                <!-- Compteur de likes -->
                                

                                <span data-name="span" onclick="affichecommentlist(event)"  style="cursor: pointer;"><i class="uil uil-comment" data-name="span" style="font-size: x-large;"></i></span>
                                <span onclick="affichesharemenu(event)"  style="cursor: pointer;"><i class="uil uil-share" style="font-size: x-large;"></i></span>
                                <div class="share-menu" style="display: none; position: absolute; background: white; border: 1px solid #ccc; border-radius: 5px; padding: 10px; z-index: 1000;">
                                    <button class="btn rounded-circle" style="background-color:#F5F5F5;" onclick="copyLink(<?= $post->id_post; ?>)"><i class="fas fa-link"></i></button>
                                </div>
                            </div>
                           
                            <div class="bookmark">
                                <?php
                                    $isbookmarked = false;
                                    foreach($enregistrerpostes as $bookmarker) {
                                        if($post->id_post == $bookmarker->id_post){
                                                echo '<button name="enregistrer" type="button" class="btn-enregsitrer border-0 is-saved" onclick="save_post_groupe(event)" data-post-id="' .$post->id_post .'"><i class="uil uil-bookmark text-primary" style="font-size: x-large;"></i></button>';
                                                $isbookmarked = true;
                                                break;
                                        }
                                    }
                                    if(!$isbookmarked){
                                        echo '<button name="enregistrer" type="button" class="btn-enregsitrer border-0" onclick="save_post_groupe(event)" data-post-id="' .$post->id_post .'"><i class="uil uil-bookmark" style="font-size: x-large;"></i></button>';
                                    }
                                ?>
                          
                            </div>
                        </div>
                        
                        <div class="liked-by" style="display: flex; ">
                            
                            <?php 
                            $likesa = [];
                            foreach ($likesamie as $like) {
                                if ($like->id_post == $post->id_post) {
                                    $likesa[] = $like;
                                }
                            }
                            $likesacount = 0;
                            if(count($likesa) > 0){ 
                                $likesacount = -2;
                                ?>
                                <span class="liked1"><img  src="<?php if(isset($likesa[0])) { echo $likesa[0]->photo_profil; } ?>" height="25px" width="25px" style="border-radius: 50%;" alt="User Profile Picture"></span>
                                <?php if(count($likesa) > 1){ 
                                    $likesacount = 1;
                                    ?>
                                    <span class="liked2"><img src="<?php if(isset($likesa[1])) { echo $likesa[1]->photo_profil; } ?>" height="25px"width="25px" style="border-radius: 50%;"></span>
                                <?php } ?>
                                <?php if(count($likesa) > 2){ 
                                    $likesacount = 2;
                                    ?>
                                    <span class="liked3"><img src="<?php if(isset($likesa[2])) { echo $likesa[2]->photo_profil; } ?>" height="25px" width="25px" style="border-radius: 50%;"></span>
                                <?php } ?>
                            <?php } ?>
                            <p class="liked4" style="left: <?=-5*$likesacount?>px;">Liker par <b><span id="count_like_<?php echo $post->id_post; ?>"><?php $stmt = $pdo->prepare("SELECT COUNT(*) AS like_count FROM likes WHERE id_post = :id_post");
                                $stmt->execute(['id_post' => $post->id_post]);
                                $likeCount = $stmt->fetch(PDO::FETCH_ASSOC)['like_count']; echo $likeCount; ?></span></b> peronnes
                            </p>
                        </div>
                        <?php 
                        foreach($countcomment as $count){
                            if($count->id_post == $post->id_post){
                                if($count->comment_count == 0){
                                    echo '<div class="comments text-muted">Aucun commentaire</div>';
                                }else{
                                    echo '<div onclick="affichecommentlist(event)" class="comments text-muted" style="cursor: pointer;">Voir les ' . $count->comment_count . ' commentaires</div>';
                                }
                                break;
                            }
                        }
                        ?>
                        <div id="comments-list" class="comments-list text-white ps-2 pe-2 pb-1" style="display: none; border-radius: 5px;overflow-y: auto; border-radius: 5px; -ms-overflow-style: none; scrollbar-width: none;max-height:400px;background-color:#2B2757;" postId=<?=$post->id_post?> ></div>
                    </div>

            <?php
            }
            ?>

                </div>
                
            </div>
        </main>
        <div class="overlay-supprimer hidden-modifier" id="overlay-supprimer"></div>

        <div class="popup-modifier hidden-modifier" id="popup-supprimer">
            <header>Supprimer le Post</header>
            <form method="post" action="index.php?action=supprimerPost">
                <input type="hidden" name="id_post" value="">
                <button name="supprimer" type="submit">Supprimer</button>
                <button type="button" class="close-popup-btn-supprimer">Annuler</button>
            </form>
        </div>
    </div>
    <div class="overlay-modifier hidden-modifier" id="overlay-modifier"></div>

    <div class="popup-modifier hidden-modifier" id="popup-modifier">
        <header>Modifier le Post</header>
        <form id="modifierPostForm" enctype="multipart/form-data">
            <input type="hidden" name="imagehere" id="imagehere_modifier" value="">
            <input type="hidden" name="post_groupe_id" id="group_post_id_modifier" value="">
            <textarea name="text_content" placeholder="Modifier le contenu" id="group_post_content_modifier"></textarea>
            <div class="w-100 bg-dark" id="modifierPostFormdivimage">
                <p type="button" class="btn" style="position: absolute; top: 210px; left: 330px;z-index:999" onclick="removepostimage()"><i style="font-size: 20px;color:grey;" class="bi bi-x-lg"></i></p>
                <img id="group_post_image_modifier" style="max-width: 100%; height: 200px;" src="" alt="">
            </div>
            <div class="options-modifier w-100 d-flex justify-content-center">
                <label for="imageInput-modifier" align="center">
                    <i class="bi bi-card-image" style="background-color: #dfdfdf; border-radius: 50%; padding: 5px;"></i>
                    <p>Changer l'image</p>
                </label>
                <input type="file" id="imageInput-modifier" accept="image/*" name="image" style="display:none;">
            </div>
            <div class="enregistrer-annuler-btn">
            <button type="submit">Modifier</button>
            <button type="button" class="close-popup-btn-modifier">Annuler</button>
            </div>
        </form>
    </div>
    <script>
        function affichesharemenu(event){
            const shareMenu = event.currentTarget.nextElementSibling;
            shareMenu.style.display = shareMenu.style.display === 'block' ? 'none' : 'block';
        }

        function copyLink(id){
            const el = document.createElement('textarea');
            el.value = window.location.href + '&id=' + id;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            const popupMessage = document.createElement('div');
            popupMessage.innerHTML = '<i class="fas fa-check-circle" style="color: white; background-color: green; border-radius: 50%; padding: 5px;"></i> Lien copié dans le presse-papiers';
            popupMessage.style.position = 'fixed';
            popupMessage.style.bottom = '20px';
            popupMessage.style.left = '50%';
            popupMessage.style.transform = 'translateX(-50%)';
            popupMessage.style.backgroundColor = '#333';
            popupMessage.style.color = '#fff';
            popupMessage.style.padding = '10px 20px';
            popupMessage.style.borderRadius = '5px';
            popupMessage.style.zIndex = '1000';
            document.body.appendChild(popupMessage);

            popupMessage.style.transition = 'opacity 0.5s ease';
            popupMessage.style.opacity = '1';
            setTimeout(() => {
                popupMessage.style.opacity = '0';
                setTimeout(() => {
                    popupMessage.remove();
                }, 500);
            }, 2000);
        }

        function commentlike(event){
            var id_comment = event.target.parentElement.parentElement.parentElement.getAttribute('id_comment');
            
            if(event.target.classList.contains('is-liked')){
                $.ajax({
                    url: 'index.php?action=removecommentlike_home',
                    type: 'POST',
                    data: {
                        id_comment : id_comment
                    },
                    success: function(res) {
                        event.target.classList.remove('is-liked');
                        event.target.classList.remove('text-primary');
                        event.target.nextElementSibling.textContent = parseInt(event.target.nextElementSibling.textContent) - 1;
                    }
                });
            }else{
                $.ajax({
                    url: 'index.php?action=commentlike_home',
                    type: 'POST',
                    data: {
                        id_comment : id_comment
                    },
                    success: function(res) {
                        event.target.classList.add('is-liked');
                        event.target.classList.add('text-primary');
                        event.target.nextSibling.textContent = parseInt(event.target.nextSibling.textContent) + 1;
                    }
                });
            }
        }

        function replylike(event){
            var id_reply = event.target.parentElement.parentElement.parentElement.getAttribute('id_reply');
            if(event.target.classList.contains('is-liked')){
                $.ajax({
                    url: 'index.php?action=removereplylike_home',
                    type: 'POST',
                    data: {
                        id_reply : id_reply
                    },
                    success: function(res) {
                        event.target.classList.remove('is-liked');
                        event.target.classList.remove('text-primary');
                        event.target.nextElementSibling.nextElementSibling.textContent = parseInt(event.target.nextElementSibling.nextElementSibling.textContent) - 1;
                    }
                });
            }else{
                $.ajax({
                    url: 'index.php?action=replylike_home',
                    type: 'POST',
                    data: {
                        id_reply : id_reply
                    },
                    success: function(res) {
                        event.target.classList.add('is-liked');
                        event.target.classList.add('text-primary');
                        event.target.nextElementSibling.nextElementSibling.textContent = parseInt(event.target.nextElementSibling.nextElementSibling.textContent) + 1;
                    }
                });
            }
        }

        function onoffreponses(event,id_comment){
            var reponses = event.target.parentElement.parentElement.nextElementSibling;
            if(reponses.style.display === 'block'){
                reponses.style.display = 'none';
            }else{
                $.ajax({
                    url: 'index.php?action=getresponses_home',
                    type: 'POST',
                    data:{
                        id_comment : id_comment,
                    },
                    success: function(res) {
                        document.querySelector('div[id_comment="'+id_comment+'"] .reply-div').innerHTML = res.response.map(resp=>{
                        var likes = 0;
                        var likebutton = '<i onclick="replylike(event)" class="bi bi-heart" style="cursor:pointer"></i>';
                    
                        res.replylikes.forEach(like => {
                            if (like.id_reply_grp === resp.id_reply_grp) {
                                if (like.id_user === res.id_member) {
                                    likebutton = '<i onclick="replylike(event)" class="bi bi-heart is-liked text-primary" style="cursor:pointer"></i>';
                                }
                                likes++;
                            }
                        });
                        
                        
                        return `
                            <div id_reply="${resp.id_reply_grp}" class="reply w-100 gap-2 pt-1 pb-1" style="min-height: 40px;padding-left: 50px;">
                                <div class="comment d-flex w-100 gap-2 pt-1 pb-1" style="min-height: 40px;">
                                    <div class="profile-pic">
                                        <img src="${resp.photo_profil}" alt="">
                                    </div>
                                    <div class="comment-content" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word; white-space: normal;">
                                        <p class="m-0 p-0" style="font-size: small;">${resp.prenom} ${resp.nom} ${calculerdate(resp.reply_grp_at)}</p>
                                        <p class="m-0 p-0" style="font-size: small;">${resp.content_reply_grp}</p>
                                    </div>
                                </div>
                                <div class="d-flex w-100 gap-2 ps-5 pt-1 pb-1 justify-content-between" style="min-height: 40px;">
                                    <p class="text-center">${likebutton}<br><span>${likes}</span></p>
                                </div>
                            </div>
                        `}).join('<br>');
                    }
                });
                reponses.style.display = 'block';
            }
        }

        function removereply(event) {
            event.target.parentElement.nextElementSibling.querySelector('input[name="reply_to"]').remove();
            event.target.parentElement.remove();
        }

        function replygrp(event,id, name) {
            const commentform = event.target.parentElement.parentElement.parentElement.parentElement.querySelector('div[class="comment-form"]');

            if(commentform.querySelector('#reply_to') != null){
                commentform.querySelector('#reply_to').remove();
            }
            
            const hiddenInput = document.createElement('input');
            hiddenInput.id = 'reply_to';
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'reply_to';
            hiddenInput.value = id;
            const commentInput = commentform.querySelector('input[name="groupe_comment_content"]');
            commentInput.parentElement.appendChild(hiddenInput);
            commentInput.focus();

            if(commentform.querySelector('.reply_to') != null){
                commentform.querySelector('.reply_to').remove();
            }

            const div = document.createElement('div');
            div.classList.add('reply_to');
            div.classList.add('w-100');
            div.classList.add('d-flex');
            div.classList.add('justify-content-between');
            div.classList.add('align-items-center');
            div.classList.add('p-1');
            div.innerHTML = `
                <p class="m-0">Répondre à ${name}</p>
                <i class="bi bi-x" style="cursor:pointer" onclick="removereply(event)"></i>
                `;
            commentform.insertBefore(div, commentform.firstChild);

        }

        function submitcommentgroup(e,postId) {
            var comment_content = e.target.previousElementSibling.value;
            var commentList = e.target.parentElement.parentElement.parentElement;
            if(e.target.nextElementSibling != null){
                var reply_to = e.target.nextElementSibling.value;
                $.ajax({
                    url: 'index.php?action=submitreply',
                    type: 'POST',
                    data: {
                        groupe_comment : comment_content,
                        reply_to : reply_to
                    },
                    success: function(res) {
                        e.target.previousElementSibling.value = "";
                        document.querySelector('div[id_comment="'+reply_to+'"] .reply-div').innerHTML = `
                            <div id_reply="${res.id_reply_grp}" class="reply w-100 gap-2 pt-1 pb-1" style="min-height: 40px;padding-left: 50px;">
                                <div class="comment d-flex w-100 gap-2 pt-1 pb-1" style="min-height: 40px;">
                                    <div class="profile-pic">
                                        <img src="${res.photo_profile}" alt="">
                                    </div>
                                    <div class="comment-content" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word; white-space: normal;">
                                        <p class="m-0 p-0" style="font-size: small;">${res.fullname} ${calculerdate(res.date_reply)}</p>
                                        <p class="m-0 p-0" style="font-size: small;">${res.reply}</p>
                                    </div>
                                </div>
                                <div class="d-flex w-100 gap-2 ps-5 pt-1 pb-1 justify-content-between" style="min-height: 40px;">
                                    <p class="text-center"><i class="bi bi-heart" style="cursor:pointer" onclick="replylike(event)"></i><br><span>0</span></p>
                                </div>
                            </div>
                        `;
                        document.querySelector('div[id_comment="'+reply_to+'"] .reply-div').style.display = 'block';
                    }
                });

            }else{
                $.ajax({
                    url: 'index.php?action=submitcomment',
                    type: 'POST',
                    data: {
                        groupe_comment : comment_content,
                        id_groupe_post : postId
                    },
                    success: function(res) {
                        console.log(res);
                        e.target.previousElementSibling.value = "";
                        $.ajax({
                            url: 'index.php?action=allcommentshome',
                            type: 'POST',
                            data: {
                                id_groupe_post : postId,
                            },
                            success: function(res) {
                                commentList.previousElementSibling.setAttribute('onclick', 'affichecommentlist(event)');
                                commentList.previousElementSibling.setAttribute('style', 'cursor: pointer;');
                                commentList.previousElementSibling.innerHTML = `Voir les ${res.comments.length} commentaires`;
                                commentList.innerHTML = res.comments.map(comment =>{
                                    var likes = 0;
                                    var likebutton = '<i onclick="commentlike(event)" class="bi bi-heart" style="cursor:pointer"></i>';
                                
                                    res.likesofcomment.forEach(like => {
                                        if (like.id_comment === comment.id_groupe_comment) {
                                            if (like.id_user === res.id_user) {
                                                likebutton = '<i onclick="commentlike(event)" class="bi bi-heart is-liked text-primary" style="cursor:pointer"></i>';
                                            }
                                            likes++;
                                        }
                                    });


                                    return `
                                    <div id_comment="${comment.id_groupe_comment}" class="comment w-100 gap-2 pt-1 pb-1" style="min-height: 40px;">
                                        <div class="comment d-flex w-100 gap-2 pt-1 pb-1" style="min-height: 40px;">
                                            <div class="profile-pic">
                                                <img src="${comment.photo_profil}" alt="">
                                            </div>
                                            <div class="comment-content" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word; white-space: normal;">
                                                <p class="m-0 p-0" style="font-size: small;">${comment.prenom} ${comment.nom} ${calculerdate(comment.date_groupe_comment)}</p>
                                                <p class="m-0 p-0" style="font-size: small;">${comment.groupe_comment_content}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex w-100 gap-2 ps-5 pt-1 pb-1 justify-content-between" style="min-height: 40px;">
                                            <div class="d-flex w-100 gap-2">
                                                <p onclick="replygrp(event,${comment.id_groupe_comment},'${comment.prenom} ${comment.nom}')" style="cursor:pointer">Répondre</p>
                                                <p onclick="onoffreponses(event,${comment.id_groupe_comment})" style="cursor:pointer">Réponses</p>
                                            </div>
                                            <p class="text-center">${likebutton}<span>${likes}</span></p>
                                        </div>
                                        <div class="reply-div"></div>
                                    </div>
                                `}).join('<br>');

                                commentList.innerHTML += `
                                    <div class="comment-form"  style="margin-top: 10px; width: 100%; position: sticky; bottom: 0; background-color:rgb(0, 0, 0); border-radius: 5px 5px 0 0;">
                                        <div style="display: flex; gap: 10px; position: sticky; bottom: 0;"> 
                                            <input type="text" name="groupe_comment_content" class="form-control" placeholder="Commenter...">
                                            <button type="button" class="btn btn-primary" onclick="submitcommentgroup(event, ${postId})">Commenter</button>
                                        </div>
                                    </div>
                                `;
                            }
                        });
                    }
                });
            }
        }

        function calculerdate(datec){
            var date1 = new Date(datec);
            var date2 = new Date();
            var diffTime = Math.abs(date2 - date1);
            var diffSeconds = Math.floor(diffTime / 1000);
            var diffMinutes = Math.floor(diffSeconds / 60);
            var diffHours = Math.floor(diffMinutes / 60);
            var diffDays = Math.floor(diffHours / 24);

            if (diffDays > 0) {
            return diffDays + " days ago";
            } else if (diffHours > 0) {
            return diffHours + " hours ago";
            } else if (diffMinutes > 0) {
            return diffMinutes + " minutes ago";
            } else {
            return diffSeconds + " seconds ago";
            }
        }

        function affichecommentlist(event){
            if(event.currentTarget.getAttribute("data-name") == "span"){
                var commentList = event.currentTarget.parentElement.parentElement.nextElementSibling.nextElementSibling.nextElementSibling;
            }else{
                var commentList = event.currentTarget.nextElementSibling;
            }

            const postId = commentList.getAttribute('postId');

            $.ajax({
                url: 'index.php?action=allcommentshome',
                type: 'POST',
                data: {
                    id_groupe_post : postId,
                },
                success: function(res) {
                    console.log(res);
                    commentList.previousElementSibling.setAttribute('onclick', 'affichecommentlist(event)');
                    commentList.previousElementSibling.setAttribute('style', 'cursor: pointer;');
                    commentList.previousElementSibling.innerHTML = `Voir les ${res.comments.length} commentaires`;
                    commentList.innerHTML = res.comments.map(comment =>{
                        var likes = 0;
                        var likebutton = '<i onclick="commentlike(event)" class="bi bi-heart" style="cursor:pointer"></i>';
                    
                        res.likesofcomment.forEach(like => {
                            if (like.id_comment === comment.id_groupe_comment) {
                                if (like.id_user === res.id_user) {
                                    likebutton = '<i onclick="commentlike(event)" class="bi bi-heart is-liked text-primary" style="cursor:pointer"></i>';
                                }
                                likes++;
                            }
                        });
                        
                        
                        return `
                        <div id_comment="${comment.id_groupe_comment}" class="comment w-100 gap-2 pt-1 pb-1" style="min-height: 40px;">
                            <div class="comment d-flex w-100 gap-2 pt-1 pb-1" style="min-height: 40px;">
                                <div class="profile-pic">
                                    <img src="${comment.photo_profil}" alt="">
                                </div>
                                <div class="comment-content" style="word-wrap: break-word; overflow-wrap: break-word; word-break: break-word; white-space: normal;">
                                    <p class="m-0 p-0" style="font-size: small;">${comment.prenom} ${comment.nom} ${calculerdate(comment.date_groupe_comment)}</p>
                                    <p class="m-0 p-0" style="font-size: small;">${comment.groupe_comment_content}</p>
                                </div>
                            </div>
                            <div class="d-flex w-100 gap-2 ps-5 pt-1 pb-1 justify-content-between" style="min-height: 40px;">
                                <div class="d-flex w-100 gap-2">
                                    <p onclick="replygrp(event,${comment.id_groupe_comment},'${comment.prenom} ${comment.nom}')" style="cursor:pointer">Répondre</p>
                                    <p onclick="onoffreponses(event,${comment.id_groupe_comment})" style="cursor:pointer">Réponses</p>
                                </div>
                                <p class="text-center">${likebutton}<span>${likes}</span></p>
                            </div>
                            <div class="reply-div"></div>
                        </div>
                    `}).join('<br>');
                            
                    commentList.innerHTML += `
                        <div class="comment-form"  style="margin-top: 10px; width: 100%; position: sticky; bottom: 0; background-color:rgb(0, 0, 0); border-radius: 5px 5px 0 0;">
                            <div style="display: flex; gap: 10px; position: sticky; bottom: 0;"> 
                                <input type="text" name="groupe_comment_content" class="form-control" placeholder="Commenter...">
                                <button type="button" class="btn btn-primary" onclick="submitcommentgroup(event, ${postId})">Commenter</button>
                            </div>
                        </div>
                    `;

                    if (commentList.style.display === 'block') {
                        commentList.style.display = 'none';
                    } else {
                        commentList.style.display = 'block';
                    }
                }
            });

        }

        document.getElementById("imageInput").addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const uploadedImageContainer = document.getElementById("uploadedImageContainer");
                    const fileExtension = file.name.split('.').pop().toLowerCase();
                    
                    if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                        // If it's an image
                        uploadedImageContainer.innerHTML = `<img src="${e.target.result}" alt="Uploaded Image">`;
                    } else if (['mp4', 'webm', 'ogg'].includes(fileExtension)) {
                        // If it's a video
                        uploadedImageContainer.innerHTML = `<video controls style="width: 100%; height: auto;"><source src="${e.target.result}" type="video/${fileExtension}">Your browser does not support the video tag.</video>`;
                    } else {
                        uploadedImageContainer.innerHTML = `<p>Unsupported file type</p>`;
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        // Get elements
        const openPopupButton = document.getElementById('openPopup');
        const closePopupButton = document.getElementById('closePopup');
        const popup = document.getElementById('popup');
        const overlay = document.getElementById('overlay');
        // Open popup
        openPopupButton.addEventListener('click', (e) => {
            e.preventDefault();
            popup.style.display = 'block';
            overlay.style.display = 'block';
        });



        // Close popup by clicking outside the popup
        overlay.addEventListener('click', (e) => {
            e.preventDefault();
            popup.style.display = 'none';
            overlay.style.display = 'none';
        });

        document.querySelectorAll('.dropdown-btn-modifier').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const dropdownContent = button.nextElementSibling;
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });
        });

        // Open modify popup
        document.querySelectorAll('.open-popup-btn-modifier').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                document.getElementById('popup-modifier').classList.remove('hidden-modifier');
                document.getElementById('overlay-modifier').classList.remove('hidden-modifier');
            });
        });

        document.getElementById("imageInput-modifier").addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imageElement = document.getElementById("group_post_image_modifier");
                    imageElement.src = e.target.result;
                };
                reader.readAsDataURL(file);
                if (document.getElementById('modifierPostFormdivimage').style.display === "none") {
                    document.getElementById('modifierPostFormdivimage').style.display = "block";
                }
                document.getElementById('imagehere_modifier').value = "true";
            }
        });

        $(document).ready(function() {
            $('#modifierPostForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: 'index.php?action=modifierpost',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        document.getElementById('imageInput-modifier').value = '';
                        // Clear the content of .hash-tag-{res.id_post_groupe}
                        document.querySelector('.hash-tag-' + res.id_post_groupe).innerHTML = ''; // Use innerHTML to clear content
                        document.querySelector('.hash-tag-' + res.id_post_groupe).append(res.text_content);

                        // Clear the content of .imageorvideopost
                        document.querySelector('.imageorvideopost-' + res.id_post_groupe).innerHTML = ''; // Use innerHTML to clear content
                    
                        if(res.image_url !== ""){
                            let fileUrl = res.image_url; // Assuming res.image_url contains the image or video URL
                            let fileExtension = fileUrl.split('.').pop().toLowerCase(); // Get the file extension

                            let element; // This will be the element we append

                            if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                                // If it's an image, create an <img> element
                                element = document.createElement('img');
                                element.classList.add('image-width');
                                element.style.maxWidth = '100%';
                                element.src = fileUrl;
                            } else if (['mp4', 'webm', 'ogg'].includes(fileExtension)) {
                                // If it's a video, create a <video> element
                                element = document.createElement('video');
                                element.controls = true;
                                element.src = fileUrl;
                            }

                            // Append the created element to the target container
                            document.querySelector('.imageorvideopost-' + res.id_post_groupe).append(element);
                        }

                        // Hide the popup and overlay
                        document.getElementById('popup-modifier').classList.add('hidden-modifier');
                        document.getElementById('overlay-modifier').classList.add('hidden-modifier');

                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred: " + error);
                        alert("An error occurred: " + xhr.responseText);
                    }
                });
            });
        });

        function removepostimage(){
            document.getElementById('group_post_image_modifier').src = '';
            document.getElementById('modifierPostFormdivimage').style.display = "none";
            document.getElementById('imagehere_modifier').value = "false";
            document.getElementById('imageInput-modifier').value = '';
        }

        function affichemodifier(id){
                document.getElementById('popup-modifier').classList.remove('hidden-modifier');
                document.getElementById('overlay-modifier').classList.remove('hidden-modifier');

                $.ajax({
                    url: 'index.php?action=selectpostinfo',
                    type: 'POST',
                    data: {
                        id_post: id,
                    },
                    success: function(res){
                        document.getElementById('group_post_id_modifier').value = res.id_post;
                        document.getElementById('group_post_content_modifier').value = res.text_content;
                        const fileExtension = res.image_path.split('.').pop().toLowerCase();
                        const imageContainer = document.getElementById('group_post_image_modifier');
                        
                        if (['mp4', 'webm', 'ogg'].includes(fileExtension)) {
                            const videoElement = document.createElement('video');
                            videoElement.controls = true;
                            videoElement.src = res.image_path;
                            videoElement.style.maxWidth = '100%';
                            videoElement.style.height = '200px';
                            imageContainer.replaceWith(videoElement);
                            videoElement.id = 'group_post_image_modifier';
                        } else {
                            imageContainer.src = res.image_path;
                        }
                        if (document.getElementById('modifierPostFormdivimage').style.display === "none") {
                            document.getElementById('modifierPostFormdivimage').style.display = "block";
                        }

                        if(res.image_path == ""){
                            document.getElementById('modifierPostFormdivimage').style.display = "none";
                            document.getElementById('imagehere_modifier').value = "false";
                        }else{
                            document.getElementById('imagehere_modifier').value = "true";
                        }
                    }
                });
        }

        // Open delete popup
        function affichesupprimer(id){
            document.getElementById('popup-supprimer').classList.remove('hidden-modifier');
            document.getElementById('overlay-supprimer').classList.remove('hidden-modifier');
            const firstInput = document.querySelector('#popup-supprimer input');
            firstInput.value = id;
        }

        // Close popup
        document.querySelectorAll('.close-popup-btn-modifier').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('popup-modifier').classList.add('hidden-modifier');
                document.getElementById('overlay-modifier').classList.add('hidden-modifier');
                document.getElementById('group_post_id_modifier').value = '';
                document.getElementById('group_post_content_modifier').value = '';
                document.getElementById('group_post_image_modifier').src = '';
                document.getElementById('imageInput-modifier').value = '';
            });
        });

        // Close delete popup
        document.querySelectorAll('.close-popup-btn-supprimer').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('popup-supprimer').classList.add('hidden-modifier');
                document.getElementById('overlay-supprimer').classList.add('hidden-modifier');
            });
        });

        // Close by clicking outside the popup
        document.getElementById('overlay-modifier').addEventListener('click', () => {
            document.getElementById('popup-modifier').classList.add('hidden-modifier');
            document.getElementById('overlay-modifier').classList.add('hidden-modifier');
        });

        document.getElementById('overlay-supprimer').addEventListener('click', () => {
            document.getElementById('popup-supprimer').classList.add('hidden-modifier');
            document.getElementById('overlay-supprimer').classList.add('hidden-modifier');
        });   
        
        document.addEventListener("DOMContentLoaded", function () {
    var likeButtons = document.querySelectorAll('.like_button');
    
    likeButtons.forEach(function(likeButton) {
        likeButton.addEventListener("click", function () {
            var postId = this.getAttribute('data-post-id');  // Récupérer l'ID du post
            var userId = this.getAttribute('data-user-id');  // Récupérer l'ID de l'utilisateur
            var countLike = document.getElementById("count_like_" + postId);  // Compteur de likes spécifique au post

            // Création de l'objet XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configuration de la requête POST
            xhr.open("POST", "vue/like_post.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Gestion de la réponse
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        // Mise à jour du compteur de likes
                       
                        countLike.textContent = response.like_count;
                       
                    } else {
                        alert("Erreur : " + response.message);
                    }
                }
            };

            // Envoi des données (ID du post et de l'utilisateur)
            xhr.send("post_id=" + postId + "&user_id=" + userId); // ID du post et de l'utilisateur
        });
    });
});


function save_post_groupe(event){
            var postId = event.currentTarget.getAttribute('data-post-id');

                if (event.currentTarget.classList.contains('is-saved')) {
                    // If the post is already saved, unsave it
                    $.ajax({
                        url: 'index.php?action=enregistrerPost3',
                        type: 'POST',
                        data: {
                            id_post : postId,
                            id_user : <?php echo $id ; ?>,
                        },
                        success: function(res) {
                            
                          
                            document.querySelectorAll('.btn-enregsitrer').forEach(SaveButton => {
                                if (SaveButton.getAttribute('data-post-id') == res.id_post_groupe) {
                                    SaveButton.querySelector('i').classList.remove('text-primary');
                                    SaveButton.classList.remove('is-saved');
                                }

                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error occurred: " + error);
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                            alert("An error occurred: " + xhr.responseText);
                        }
                        
                    });
                }else{

                    $.ajax({
                        url: 'index.php?action=enregistrerPost2',
                        type: 'POST',
                        data: {
                            id_post : postId,
                            id_user : <?php echo $id ; ?>,
                        },
                        success: function(res) {
                           
                            document.querySelectorAll('.btn-enregsitrer').forEach(SaveButton => {
                                if (SaveButton.getAttribute('data-post-id') == res.id_post_groupe) {
                                    SaveButton.querySelector('i').classList.add('text-primary');
                                    SaveButton.classList.add('is-saved');
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error occurred: " + error);
                            alert("An error occurred: " + xhr.responseText);
                        }
                    });
                }
        }


    </script>

       
        
        
</body>
</html>