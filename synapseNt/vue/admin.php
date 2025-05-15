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
    <link rel="stylesheet" href="assets/home.css" />
    <link rel="shortcut icon" href="img/logop11.png" type="image/png">
    <style>
      #Register i{
        color: #102770;
      }

      #Register h3{
        color: #102770;
      }
    </style>
</head>
<body>
    <div class="">
        <?php require_once 'vue/layout/navhome1admin.php'; ?>

        <main class="mt-1 d-flex">
            <?php require_once 'vue/layout/navhome2admin.php'; ?>

            <div class="Register">
                <div class="center-wrap">
                    <div class="section1 text-center">
                      <img class="g" src="img/logop.png" width="50%">
                        <p class="par2">Gérez vos tâches administratives efficacement.</p>
                        <h3 class="login2">Créer un compte administrateur</h3>
                      <form action="index.php?action=validationsignupadmin" method="POST" class="myForm2">
                        <div class="form-group">
                          <div class="form-group">
                            <input type="text" name="logprenom" class="form-style" placeholder="Prenom" id="logprenom" oninput="handlePrenom(event)">
                            <i class="input-icon uil uil-user"></i>
                            <div class="error-message" id="prenomerror"></div>
                          </div>
                          <div class="form-group">
                            <input type="text" name="lognom" class="form-style" placeholder="Nom" id="lognom" oninput="handleNom(event)">
                            <i class="input-icon uil uil-user"></i>
                            <div class="error-message" id="nomerror"></div>
                          </div>
                        </div>
                        <label for="" style="align-self: flex-start;margin-left: 15%; margin-top: 15px; margin-bottom: -10px;">Date de naissance</label>
                        <div class="form-group mt-2">
                            <input type="date" name="logdate"  class="form-style" id="date">
                            <i class="input-icon bi bi-calendar-week"></i>
                            <div class="error-message" id="dateerror"></div>
                        </div>  
                        <div class="form-group mt-2">
                          <input type="email" name="logemail" class="form-style" placeholder="Email" id="email" oninput="handleEmail(event)">
                          <i class="input-icon uil uil-at"></i>
                          <div class="error-message" id="email2error"></div>
                        </div>  
                        <div class="form-group mt-2">
                          <input type="password" name="logpass" class="form-style" placeholder="Mot de passe" id="password" oninput="handlePassword()">
                          <i class="input-icon uil uil-lock-alt"></i>
                          <div class="error-message" id="pass2error"></div>
                        </div>
                      
                        <input type="submit" value="submit" class="btn submit_register mt-4" style="background-color: #102770;color:white">
                      </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
    <?php
      require_once 'assets/script.js';

      if(isset($_GET['prenom_error'])){
        $prenom_error = $_GET['prenom_error'];
        echo 'const prenomerror = document.getElementById("prenomerror");';
        echo 'prenomerror.innerText = "' . $prenom_error . '";';
        echo 'prenomerror.style.display = "block";';
      }

      if(isset($_GET['nom_error'])){
        $nom_error = $_GET['nom_error'];
        echo 'const nomerror = document.getElementById("nomerror");';
        echo 'nomerror.innerText = "' . $nom_error . '";';
        echo 'nomerror.style.display = "block";';
      }

      if(isset($_GET['date_error'])){
        $date_error = $_GET['date_error'];
        echo 'const dateerror = document.getElementById("dateerror");';
        echo 'dateerror.innerText = "' . $date_error . '";';
        echo 'dateerror.style.display = "block";';
      }

      if(isset($_GET['email2_error'])){
        $email2_error = $_GET['email2_error'];
        echo 'var email2error = document.getElementById("email2error");';
        echo 'email2error.innerText = "' . $email2_error . '";';
        echo 'email2error.style.display = "block";';
      }

      if(isset($_GET['pass2_error'])){
        $pass2_error = $_GET['pass2_error'];
        echo 'var pass2error = document.getElementById("pass2error");';
        echo 'pass2error.innerText = "' . $pass2_error . '";';
        echo 'pass2error.style.display = "block";';
      }
    ?>
  </script>
</body>
</html>