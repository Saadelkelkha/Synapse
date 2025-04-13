        <nav class="navhome1" style="padding:30px 3%;" >
            <div class="navhome1_left">
                <a href="index.php?action=home">
                  <img src="img/logop.png" height="50">
                </a>
                <?php  include 'vue/chatbot1.php';?>
                <?php  include 'vue/message.php';?>
            </div>
            <form action="index.php?action=search" method="POST" style="display:flex; gap:10px">
                <input type="text" name="keywords" id="" class="form-control search-bar">
                <button type="submit" name="rechercher" class="btn btn-primary rechercher-nom" style="border-color: #2B2757;" value="rechercher">
                    <i class="bi bi-search"></i> 
                </button>
            </form>
            <div class="navhome1_right">
                <b class="cyndy"><?php if(isset($fullname)){echo $fullname;} ?></b>
                <img class="navhome1_profile" src="<?= $user['photo_profil'] ?>" height="50" width="50">
            </div>
        </nav>