        <nav class="navhome1">
            <div class="navhome1_left">
                <img src="img/logop.png" height="50" alt="Logo">
            </div>
            <div class="navhome1_right">
                <div class="dropdown" style="position: relative;">
                  <button class="btn dropdown-toggle w-100" style="background-color: #2B2757;color:white;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <b class="cyndy"><?php if(isset($fullname)){echo $fullname;} ?></b>
                  </button>
                  <ul class="dropdown-menu" style="z-index: 9999; position: absolute;">
                    <li><a class="dropdown-item" href="index.php?action=deconnexion">Déconnexion</a></li>
                  </ul>
                </div>
                <div></div>
            </div>
        </nav>
        <!-- Include Bootstrap CSS and JS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>