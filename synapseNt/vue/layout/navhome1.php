
        <nav class="navhome1" style="padding:30px 3%;" >
            <div class="navhome1_left">
                <a href="index.php?action=home">
                  <img src="img/logop.png" height="50">
                </a>
                <?php  include 'vue/chatbot1.php';?>
                <?php  include 'vue/message.php';?>
            </div>
<form action="index.php?action=search" method="POST" style="display: flex; gap: 10px; align-items: center;">
  <div class="position-relative" style="flex: 1;">
    <!-- Bouton intégré dans le champ -->
    <button   type="submit" name="rechercher" class="btn p-0 m-0 position-absolute d-flex align-items-center justify-content-center"
            style="left: 10px; top: 50%; transform: translateY(-50%); width: 36px; height: 36px; border: none; background: transparent; cursor:auto;">
      <i class="bi bi-search" style="color: #aaa;"></i>
    </button>

    <!-- Champ avec padding à gauche pour l’icône-bouton -->
    <input type="text" name="keywords" class="form-control search-bar ps-5" placeholder="Rechercher sur SynapseNt" style="border-radius: 30px;">
  </div>
</form>


            <div class="dropdown" style="position: relative;">
              <button class="btn dropdown-toggle" style="background-color: #2B2757;color:white;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <b class="cyndy"><?php if(isset($fullname)){echo $fullname;} ?></b>
                <img class="navhome1_profile" src="<?= $user['photo_profil'] ?>" height="50" width="50">
              </button>
              <ul class="dropdown-menu" style="z-index: 9999; position: absolute;">
                <li><a class="dropdown-item" href="index.php?action=deconnexion">Déconnexion</a></li>
              </ul>
            </div>
            <!-- <div class="dropdown navhome1_right">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('login.logout')}}">Deconnexion</a>
              </div>
            </div> -->
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>