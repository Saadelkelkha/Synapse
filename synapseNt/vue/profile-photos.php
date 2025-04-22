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
        .image-phpstyle{
            background-color: red;
            display:flex;
            flex-direction:row;
        }
        .post-gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; /* Espacement entre les images */
}
.post-gallery img,
.post-gallery video {
    max-height: 250px;
    object-fit: cover;
    border-radius: 10px;
}
.photo-gallery {
    color: white;
    padding: 20px;
    border-radius: 10px;
    margin: auto;
}

.gallery-tabs {
    display: flex;
    gap: 20px;
    font-size: 18px;
    margin-bottom: 10px;
}

.gallery-tabs span {
    cursor: pointer;
    padding-bottom: 5px;
}

.gallery-tabs .active {
    border-bottom: 2px solid #1877f2;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 10px;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
}

.gallery-img, .gallery-video {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
}

.edit-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(0, 0, 0, 0.6);
    border: none;
    color: white;
    padding: 5px 8px;
    border-radius: 50%;
    cursor: pointer;
}
/* Lightbox style */
.lightbox {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.lightbox-content {
    max-width: 90%;
    max-height: 90%;
}

.lightbox img,
.lightbox video {
    max-width: 100%;
    max-height: 100%;
    border-radius: 10px;
}

.lightbox-close {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 30px;
    color: white;
    cursor: pointer;
}





    </style>
</head>
<body>
    <div class=" mt-3">
        <!-- Navbar -->
        <?php require_once 'vue/layout/navhome1.php'; ?>

        <main class="mt-1 d-flex">
            <?php 
            $id = $_SESSION['id_user'];
            $db = new PDO("mysql:host=localhost;dbname=synapse","root","");
            $sqlstate = $db->prepare("SELECT * FROM user WHERE id_user = ?");
            $sqlstate->execute([$id]);
            $user = $sqlstate->fetch(PDO::FETCH_ASSOC);
            
            ?>
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
              <p align="start"><?php
               if (!empty($user['bio'])){ 
                echo  $user['bio'];
            }
                 else{ 
                    echo null ; 
                    }?></p>
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
<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
        <ul class="navbar-nav flex-row gap-3">
            <li class="nav-item">
                <a class="nav-link active" href="index.php?action=afficherProfil">Publications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=afficherAmies">Ami(e)s</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=afficherPhotos">Multimédia</a>
            </li>
        </ul>
    </div>
</nav> <br>
<?php
$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
$id = $_SESSION['id_user'];
$sqlState = $pdo->query('SELECT id_post, id_user, image_path FROM post'); 
$posts = $sqlState->fetchAll(PDO::FETCH_OBJ);
?>

<div class="photo-gallery">
    <h2 style="color:black;" align="start">Photos</h2>
    
    <div class="gallery-grid">
        <?php foreach ($posts as $post) {
             if (!empty($post->image_path) && trim($post->image_path) !== "vue/uploads/") {
            $fileExtension = pathinfo($post->image_path, PATHINFO_EXTENSION);
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $videoExtensions = ['mp4', 'webm', 'ogg'];
        ?>
            <div class="gallery-item">
                <?php if (in_array(strtolower($fileExtension), $imageExtensions)) { ?>
                    <img src="<?= htmlspecialchars($post->image_path, ENT_QUOTES, 'UTF-8') ?>" class="gallery-img" onclick="openLightbox('<?= htmlspecialchars($post->image_path, ENT_QUOTES, 'UTF-8') ?>', 'image')">

                <?php } elseif (in_array(strtolower($fileExtension), $videoExtensions)) { ?>
                    <video class="gallery-video" controls onclick="openLightbox('<?= htmlspecialchars($post->image_path, ENT_QUOTES, 'UTF-8') ?>', 'video')">
                        <source src="<?= htmlspecialchars($post->image_path, ENT_QUOTES, 'UTF-8') ?>" type="video/<?= htmlspecialchars($fileExtension, ENT_QUOTES, 'UTF-8') ?>">
                        Your browser does not support the video tag.
                    </video>
                <?php } ?>
               
            </div>
        <?php } } ?>
    </div>
</div>
<div class="lightbox" id="lightbox">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <div id="lightboxContent" class="lightbox-content"></div>
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
function openLightbox(path, type) {
    const lightbox = document.getElementById('lightbox');
    const content = document.getElementById('lightboxContent');
    
    if (type === 'image') {
        content.innerHTML = `<img src="${path}" alt="Image">`;
    } else if (type === 'video') {
        content.innerHTML = `
            <video controls autoplay>
                <source src="${path}" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo.
            </video>
        `;
    }

    lightbox.style.display = 'flex';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.getElementById('lightboxContent').innerHTML = '';
}




</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</html>