<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Explore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/home.css"/>
</head>
<body>
    <div class="mt-3">
        <?php require_once 'vue/layout/navhome1.php'; ?>

        <main class="mt-1 d-flex">
            <?php require_once 'vue/layout/navhome2.php'; ?>
            <div class="explore_groupe">
                <img class="groupe-banner" src="img/groupe.jpg" width="100%">
                <div class="groupe-info w-100 p-2 ps-3 pe-3 bg-white">
                    <h1 class="w-100"><b><?= $group_info->name_group  ?></b></h1>
                    <p><?= $group_info->description_group  ?></p>
                    <p class="w-100"><?= $countmembres ?> membres</p>
                    <div class="d-flex justify-content-between w-100">
                        <div class="d-flex align-items-center">
                            <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" width="50px" height="50px">
                        </div>  
                        <div>
                            <button class="btn btn-primary">inviter</button>
                            <button class="btn btn-secondary">Partager</button>
                        </div>
                    </div>
                    <nav class="border-top border-2 mt-2 pt-1 d-flex gap-3">
                        <form action="index.php?action=exploregroup" method="post" style="display:inline;">
                            <input type="hidden" value="<?= $id_group; ?>" name="id_group">
                            <button type="submit" style="border-bottom: 2px solid #2B2757;color:#2B2757" class="btn" id="group_discussion">Discussion</button>
                        </form>
                        <form action="index.php?action=invitationgroup" method="post" style="display:inline;">
                            <input type="hidden" value="<?= $id_group; ?>" name="id_group">
                            <button type="submit" class="btn" id="group_invitation">Invitation</button>
                        </form>
                        <form action="index.php?action=membresgroup" method="post" style="display:inline;">
                            <input type="hidden" value="<?= $id_group; ?>" name="id_group">
                            <button type="submit" class="btn" id="group_Membres">Membres</button>
                        </form>
                    </nav>
                </div>
                <form action="index.php?action=post" method="post" class="create-post mb-3 mt-4" >
                      <div class="profile-pic mb-3 d-flex">
                          <img src="img/Profile/Julia Clarke.png" alt="" >
                          <input type="text" name="postdescription" style="background-color: #f6f7f8; border-color: #f6f7f8;" placeholder="What's happening?" class="form-control mb-2 mt-2 ms-2" id="create-post">
                      </div>
                      <div class="photo-i" style="display: flex; justify-content: space-between; margin-left: 2%;">
                          <a href="" style="color: #b8bec4;text-decoration: none; display:flex;gap: 8px;align-items: center;"><i class="bi bi-clock-history"></i></i>Stories</a>
                          <a href="" style="color: #b8bec4;text-decoration: none;display:flex;gap: 8px;align-items: center;"><i class="fa-regular fa-image"></i>Photos</a>
                          <a href="" style="color: #b8bec4;text-decoration: none;display:flex;gap: 8px;align-items: center;"><i class="fa-regular fa-face-smile"></i>Feelings</a>
                          <input type="submit" name="postbutton" value="Post" class="btn btn-primary m-0" style="border-color: #2B2757; margin-right: 2%; width: 20%;">
                      </div>
                  </form>
                
                  <!-- Feed -->
                  <div class="feed" width="100%">
                      <div class="user">
                          <div class="profile-pic" width="100%" style="display: flex; gap: 10px;">
                              <img src="img/Profile/Julia Clarke.png" alt="">
                              <div class="name1">
                              <h5 class=" mb-0" >Ahmed Said</h5>
                              <small style="font-size:small; color: #777;">Dubai-Emirates, 15 MINUTES AGO</small>
                              </div>
                          </div>
                        
                          <span class="edit"><i class="uil uil-ellipsis-h"></i></span>
                      </div>
                    
                        <img class="image-width" height="500px" width="100%" src="img/Profile/Julia Clarke.png" alt="">
                    
                      <div class="action-button" style="display: flex; justify-content: space-between;">
                          <div class="interaction-button">
                              <span><i class="uil uil-thumbs-up" style="font-size: x-large;"></i></span>
                              <span><i class="uil uil-comment" style="font-size: x-large;"></i></span>
                              <span><i class="uil uil-share" style="font-size: x-large;"></i></span>
                          </div>
                          <div class="bookmark">
                              <span><i class="uil uil-bookmark" style="font-size: x-large;"></i></span>
                          </div>
                      </div>
                    
                      <div class="liked-by" style="display: flex; ">
                          <span class="liked1"><img  src="img/Profile/Julia Clarke.png" height="25px" width="25px" style="border-radius: 50%;"></span>
                          <span class="liked2"><img src="img/Profile/Julia Clarke.png" height="25px"width="25px" style="border-radius: 50%;"></span>
                          <span class="liked3"><img src="img/Profile/Julia Clarke.png" height="25px" width="25px" style="border-radius: 50%;"></span>
                          <p class="liked4">Liked by <b>Enrest Achiever</b> and <b>220 others</b></p>
                      </div>
                    
                      <div class="caption">
                          <p><b>Ahmed said</b> Lorem ipsum dolor storiesquiquam eius.
                              <span class="hash-tag">#lifestyle</span></p>
                      </div>
                      <div class="comments text-muted">View all 130 comments</div>
                  </div>
              </div>
            </div>
        </main>
    </div>
</body>
</html>