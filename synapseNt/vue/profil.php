<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar and Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheest" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/home.css">
    <style>
        .fixed-profile {
    position: sticky;
    top: 100px; /* Ajuste selon la hauteur de ton header */
    height: fit-content;
    max-height: 90vh; /* S'assure qu'il ne dépasse pas l'écran */
}


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
        .create-post {
  flex: 1; /* Prend l'espace restant disponible */
  max-width: 85%; /* Limite la largeur maximale */
  padding: 1rem;
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  /* background-color: #f9f9f9; */
  height: 20%;
}

.create-post .profile-pic img {
  border-radius: 50%;
  width: 50px;
  height: 50px;
  object-fit: cover;
}

.create-post input[type="text"] {
  width: 100%; /* Assure que l'input texte prend toute la largeur */
}

.create-post input[type="submit"] {
  display: block;
  margin-top: 1rem;
}

.image-width{
  max-height: 85vh;
}

        body{
            background-color: #f6f7f8;
        }
        .content_chat{
            width:40%;
            left:0;
           
        }
        .img_profil{
            height:100px;
            
            
        }
        .profile-banner {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    display: block; /* Supprime les marges automatiques */
    margin-top: 60px; /* Enlève toute marge */
    padding: 0; /* Enlève tout padding */
}

.profile-container {
    position: relative;
    margin-top: -60px;
    text-align: center;
    display: flex;
    flex-direction: column;
    /* align-items: center; Centrage sans décalage */
   
    width: 100%; /* Pour s'assurer que tout est bien aligné */
    padding: 0;
  
   
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Enlève tout padding */
}


.profile-img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    border: 4px solid white;
    background-color: white;
    object-fit: cover;
    margin-left: 20px;
    padding: 0; /* Supprime tout padding */
}
.text-profil-after-pic{
    margin-left: 50px;
}

.profile-info {
   
    margin: 0; /* Enlève les marges */
    padding: 0; /* Supprime les espaces inutiles */
}

.profile-info h3 {
    font-size: 20px;
    font-weight: bold;
    margin-top: 5px; /* Ajustement pour éviter le décalage */
}

.btn-edit {
    margin-top: 10px;
    padding: 8px 16px;
    font-size: 14px;
    border-radius: 20px;
}
.navbar-nav .nav-link {
            color: #333;
            font-weight: bold;
        }
        .profile-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .btn-light {
            width: 100%;
            text-align: left;
        }
        .post-box {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .post-options button {
            background: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .filter-buttons button {
            border: none;
            padding: 5px 10px;
            font-weight: bold;
        }
        #openPopup:hover{
            cursor:pointer;
        }

    </style>
</head>
<body>
    <div class=" mt-3">
        <!-- Navbar -->
        <?php require_once 'vue/layout/navhome1.php'; ?>

        <main class="mt-1 d-flex">
            <!-- Sidebar -->
            
            <!-- Formulaire de création de post -->
            <div class="container mt-4">
        <!-- Profile Banner -->
        <img src="<?php echo $user['banner']; ?>" alt="Banner" class="profile-banner">
        
        <!-- Profile Info -->
        <div class="profile-container">
            <img src="<?php echo $user['photo_profil']; ?>" alt="Profile Picture" class="profile-img">
            <div class="profil-pic-button">
                
              <div class="text-profil-after-pic">
              <h3 align="start"><?php if(isset($fullname)){echo $fullname;} ?></h3>
             
            
              <p align="start"><?php echo htmlspecialchars($user['bio']); ?></p>
            <?php  
                  // Récupérer le nombre d'amis
                  $id_user = $_SESSION['id_user'] ?? 1;
                    $pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                    $stmt = $pdo->prepare("SELECT COUNT(*)   AS friend_count FROM friends WHERE user_id_1 = ? OR user_id_2 = ?");
                    $stmt->execute([$id_user, $id_user]);
                    $friendCount = $stmt->fetch(PDO::FETCH_ASSOC)['friend_count'];
            ?>
              <p align="start"><?=  $friendCount ?> ami(s)</p>
              </div>
               
            </div>
          
          
         <br><br>
        
                  
<div class="container mt-2">
<nav class=" navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php?action=afficherProfil">Publications</a></li>
                <li class="nav-item"><a class="nav-link" href="#">À propos</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=afficherAmies">Ami(e)s</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=afficherPhotos">Photos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Vidéos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Plus</a></li>
            </ul>
        </div>
    </div>
</nav> <br>
    <div class="row">
        <!-- Colonne gauche (Profil, Bio) -->
        <div class="col-md-4 fixed-profile">
            <div class="profile-card mb-3">
                <h5><strong>Intro</strong></h5>
                <button class="btn btn-light mb-2">Ajouter une bio</button>
                <button class="btn btn-light mb-2"><a style="color:black; text-decoration:none;"  href="index.php?action=modifierProfile">Modifier Profil</a></button>
                <button class="btn btn-light">Ajouter du contenu à la une</button>
            </div>
            <div class="profile-card">
                <h5><strong>Photos</strong></h5>
                <a href="#">Toutes les photos</a>
            </div>
        </div>

        <!-- Colonne droite (Publications) -->
        <div class="col-md-8">
            <!-- Champ de publication -->
          
               
               
                    <form class="post-box mb-" >
                        <div class="profile-pic mb-3 d-flex">
                            <img src="img/Profile/Julia Clarke.png" alt="" >
                            <input  type="text" style="background-color: #f6f7f8; border-color: #f6f7f8;" placeholder="What's happening?" class="form-control mb-2 mt-2 ms-2" id="openPopup">
                        </div>
                        
                        
                    </form>
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
                                                            <img src="img/fb-icons/gallery.svg" alt="gallery">
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
                    
           
           

   <br><br>           

            <!-- Liste des publications -->
            <div id="postContainer">
                <?php
                $pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
                $id = $_SESSION['id_user'];
                $sqlState = $pdo->prepare('SELECT * FROM post WHERE id_user = ?'); 
                $sqlState->execute([$id]); 
                $posts = $sqlState->fetchAll(PDO::FETCH_OBJ);
                
foreach($posts as $post) {
    // Récupérer l'ID de l'utilisateur depuis la session
    $id_user = $_SESSION['id_user'];  
     
    // Assurez-vous que l'ID de l'utilisateur est stocké dans la session

    ?>
    <div class="profile-card" width="100%">



        <div class="user">
            
            <div class="profile-pic" width="100%" style="display: flex; gap: 10px;">
            <img src="<?php echo $user['photo_profil']; ?>" alt="Profile Picture" class="profile-img">
                <div class="name1">
                    <h5 class=" mb-0" align="start"><?php if(isset($fullname)){echo $fullname;} ?></h5>
                    

                                    <input type="hidden" name="id_post" value="<?php echo $post->id_post; ?>">
                                    <input type="hidden" name="id_user" value="<?php echo $post->id_user; ?>">
                                    <small align="start" style="font-size:small; color: #777;"><?php echo $post->date_post; ?></small>
                                    <div class="caption mt-4">
                                        <span class="hash-tag"><?php echo $post->text_content; ?></span></p>
                                    </div>
                                    <a href="index.php?action=afficherModifierPost&id_post=<?php echo $post->id_post; ?>">Modifier</a>
                                </div>
                                <div class="dropdown-modifier">
                                    <button class="dropdown-btn-modifier btn-modifier-supprimer1">...</button>
                                    <div class="dropdown-content-modifier">
                                        <a href="index.php?action=afficherModifierPost&id_post=<?php echo $post->id_post; ?>">Modifier</a>
                                        <button class="open-popup-btn-supprimer" onclick="affichesupprimer(<?php echo $post->id_post; ?>)">Supprimer</button>
                                    </div>
                                </div>

                                <div class="overlay-modifier hidden-modifier" id="overlay-modifier"></div>

                                <div class="popup-modifier hidden-modifier" id="popup-modifier">
                                    <header>Modifier le Post</header>
                                    <form method="post" enctype="multipart/form-data" action="index.php?action=modifierPost">
                                        <input type="hidden" name="post_id" id="post_id-modifier" value="">
                                        <textarea name="text_content" placeholder="Modifier le contenu"></textarea>
                                        <img height="100px" src="../img/Profile/Julia Clarke.png" alt="">
                                        <div class="options-modifier">
                                            <label for="imageInput-modifier">
                                                <img src="" alt="gallery">
                                            </label>
                                            <input type="file" id="imageInput-modifier" accept="image/*" name="image" style="display:none;">
                                        </div>
                                        <div class="enregistrer-annuler-btn">
                                        <button type="submit">Modifier</button>
                                        <button type="button" class="close-popup-btn-modifier">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="bg-dark d-flex justify-content-center">
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
                                <span><button style="background-color:white; color:black" class="like_button" data-post-id="<?php echo $post->id_post; ?>" data-user-id="<?php echo $id_user; ?>"><i class="uil uil-thumbs-up" style="font-size: x-large;"></i></button> <!-- Bouton Like --></span>

                                <!-- Compteur de likes -->
                                

                                <span><i class="uil uil-comment" style="font-size: x-large;"></i></span>
                                <span><i class="uil uil-share" style="font-size: x-large;"></i></span>
                            </div>
                            <div class="bookmark">
                              <form action="index.php?action=enregistrerPost" method="post">
                              <input type="hidden" name="id_post" value="<?= $post->id_post; ?>">
                              <button name="enregistrer" class="btn-enregsitrer"><i class="uil uil-bookmark" style="font-size: x-large;"></i></button>

                              </form>
                            </div>
                        </div>
                        
                        <div class="liked-by" style="display: flex; ">
                            <span class="liked1"><img  src="img/Profile/Julia Clarke.png" height="25px" width="25px" style="border-radius: 50%;"></span>
                            <span class="liked2"><img src="img/Profile/Julia Clarke.png" height="25px"width="25px" style="border-radius: 50%;"></span>
                            <span class="liked3"><img src="img/Profile/Julia Clarke.png" height="25px" width="25px" style="border-radius: 50%;"></span>
                            <p class="liked4">Liker par <b><span id="count_like_<?php echo $post->id_post; ?>"><?php $stmt = $pdo->prepare("SELECT COUNT(*) AS like_count FROM likes WHERE id_post = :id_post");
$stmt->execute(['id_post' => $post->id_post]);
$likeCount = $stmt->fetch(PDO::FETCH_ASSOC)['like_count']; echo $likeCount; ?></span></b> peronnes</p>
                        </div>
                        <div class="comments text-muted" align="start">View all 130 comments</div>
                    </div>

            <?php
            }
            ?>
                </div>
            </div>
        </div>
    </div>
</div>
                    <!-- Popup -->
                  
                    <!-- Feed -->


             
       
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
    <script>
        

document.getElementById("imageInput").addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const uploadedImageContainer = document.getElementById("uploadedImageContainer");
            uploadedImageContainer.innerHTML = '<img src="${e.target.result}" alt="Uploaded Image"/>';
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

    


</script>

</html>