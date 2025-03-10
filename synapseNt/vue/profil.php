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
    <style>
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
    margin: 0; /* Enlève toute marge */
    padding: 0; /* Enlève tout padding */
}

.profile-container {
    position: relative;
    margin-top: -80px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center; /* Centrage sans décalage */
    justify-content: center;
    width: 100%; /* Pour s'assurer que tout est bien aligné */
    padding: 0; /* Enlève tout padding */
}

.profile-img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid white;
    background-color: white;
    object-fit: cover;
    margin: 0; /* Supprime toute marge */
    padding: 0; /* Supprime tout padding */
}

.profile-info {
    text-align: center;
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
            <div class="profile-info">
                <h3><?php if(isset($fullname)){echo $fullname;} ?></h3>
                <p>Lead Product Designer at Apple</p>
                <button class="btn btn-primary btn-edit">Modifier Profil</button>
            </div>
        </div>
        
        <!-- Followers and Connections -->
        <div class="text-center mt-3">
            <span class="fw-bold">6,476</span> followers 
    </div>

                
                  <!-- Feed -->
                  

              <!-- <nav class="navhome3">
                  <form>
                      <input class="form-control search-bar" type="search" placeholder="Search" aria-label="Search">
                  </form>
                  <div class="home_stories">
                      <div class="home_make_story">
                          <img src="img/Profile/Julia Clarke.png">
                          <b>+</b>
                          <p>Add</p>
                      </div>
                      <div class="home_story">
                          <img src="img/Profile/Julia Clarke.png">
                          <p>Julia Clarke</p>
                      </div>
                  </div>
                  <div class="home_chats">
                      <b>Recent Chats</b>
                      <div>
                          <div class="home_chat">
                              <img src="img/Profile/Julia Clarke.png">
                              <div>
                                  <b>Julia Clarke</b>
                                  <p>12 mutual friends</p>
                              </div>
                          </div>
                          <i class="uil uil-comment-alt-dots"></i>
                      </div>
                  </div>
                  <div class="home_chats_bot">
                      <b>Chat bot</b>
                      <div>
                          <div class="home_chat_bot">
                              <img src="img/Profile/Julia Clarke.png">
                              <div>
                                  <b>Chat Bot</b>
                              </div>
                          </div>
                          <i class="uil uil-comment-alt-dots"></i>
                      </div>
                  </div>
              </nav> -->
            </div>
        </main>
    </div>
</body>
</html>