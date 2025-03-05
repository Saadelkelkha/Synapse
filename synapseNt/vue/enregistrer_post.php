<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar and Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/home.css"/>
</head>
<body>
    <div class=" mt-3">
        <!-- Navbar -->
        <?php require_once 'vue/layout/navhome1.php'; ?>

        <main class="mt-1 d-flex">
            <!-- Sidebar -->
            <?php require_once 'vue/layout/navhome2.php'; ?>
            <!-- Formulaire de création de post -->
            <div class="content_chat">
              <div class="content flex-grow-1">
                  <!-- Formulaire de création de post -->
                 
                
                  <!-- Feed --><?php
                  foreach($posts as $post) {
    // Récupérer l'ID de l'utilisateur depuis la session
    $id_user = $_SESSION['id_user'];  
     
    // Assurez-vous que l'ID de l'utilisateur est stocké dans la session

    ?>
    <div class="feed" width="100%">
        <div class="user">
            <div class="profile-pic" width="100%" style="display: flex; gap: 10px;">
                <img src="img/Profile/Julia Clarke.png" alt="">
                <div class="name1">
                    <h5 class=" mb-0" >Ahmed Said</h5>
                    

                                    <input type="hidden" name="id_post" value="<?php echo $post->id_enposte; ?>">
                                    <small style="font-size:small; color: #777;"><?php echo $post->date_post; ?></small>
                                    <div class="caption mt-4">
                                        <span class="hash-tag"><?php echo $post->text_content; ?></span></p>
                                    </div>
                                    <a href="index.php?action=afficherModifierPost&id_post=<?php echo $post->id_post; ?>">Modifier</a>
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
                        </div>
                        <div class="comments text-muted">View all 130 comments</div>
                    </div>

            <?php
            }
            ?>

        </main>
    </div>
    <script>
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
</body>
</html>