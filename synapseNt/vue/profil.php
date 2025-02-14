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
            width:80%;
            left:0;
        }
        .img_profil{
            height:100px;
            
            
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
            <div class="content_chat">
              <div class="content flex-grow-1"> <?php 
              
                
              
              ?>
                  <!-- Formulaire de création de post -->
                  <form action="index.php?action=" method="post" class="create-post mb-3 mt-4" >
                    <img src="<?php  echo $user['banner']; ?>" alt="" width="100%" height="200px">
                    <?php   ?>
                          <img src="<?php  echo $user['photo_profil']; ?>" alt="" class="img_profil">
                    <h3><?php if(isset($fullname)){echo $fullname;} ?></h3>
                    <p></p>                          
                     <input type="submit" name="follow" value="Modifier Profil" class="btn btn-primary m-0" style="border-color: #2B2757; margin-right: 2%; width: 20%;">
                     
                  </form>
                
                  <!-- Feed -->
                  

              <nav class="navhome3">
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
              </nav>
            </div>
        </main>
    </div>
</body>
</html>