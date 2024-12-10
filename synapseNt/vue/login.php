<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SynapseNt</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Lobster&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
</head>
<body>
  <div class="section">
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-12 text-center align-self-center">
          <div class="section pb-5 pt-5 pt-sm-2 text-center">
            <h6 class="mb-0 pb-1">
              <span style="color: white; ">Log In </span>
              <span style="color: white; ">Sign Up</span>
            </h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
            <label for="reg-log"></label>

            <div class="card-3d-wrap mx-auto">
              <div class="card-3d-wrapper">
                <div class="card-front">
                  <div class="center-wrap">
                    <div class="section2">
                      <img src="img/Instant information-amico.png">
                    </div>
                    <div class="section1 text-center">
                      <img class="g" src="img/logop.png">
                      <p class="par1">Connectez-vous, Partagez et Explorez ensemble.</p>

                      <h3 class="login1">Se connecter</h3>
                      <form action="index.php?action=validationlogin" method="POST" class="myForm1">
                        <div class="form-group">
                          <input type="email"  name="logemail" class="form-style" placeholder="Email" id="logemail" autocomplete="off" oninput="blurEmail1()">
                          <i class="input-icon uil uil-at"></i>
                          <div class="error-message" id="emailerror"></div>
                        </div>  
                        <div class="form-group mt-2">
                          <input type="password" name="logpass" class="form-style" placeholder="Mot de passe" id="logpass" autocomplete="off">
                          <i class="input-icon uil uil-lock-alt"></i>
                          <div class="error-message" id="passerror"></div>
                        </div>
                        <input type="submit" value="submit" class="btn mt-4">
                          <p class="mb-0 mt-4 text-center">
                            <a href="index.php?action=reintialiser" class="link">Mot de passe oublié?</a><br>
                            <p>Vous n'avez pas de compte? <input type="button" style="color: #102770; background: none; border: none; cursor: pointer;" onclick="createcompte()" value="Creer un compte"></p>
                          </p>
                      </form>
                  </div>
                </div>
 <!-- <br><br><br> -->
                <div class="card-back">
                  <div class="center-wrap">
                    <div class="section2">
                      <img class="img-creer" src="img/Instant information-cuate.png">
                    </div>
                    
                    <div class="section1 text-center">
                      <img class="g" src="img/logop.png">
                      <p class="par2">Connectez-vous, Partagez et Explorez ensemble.</p>
                      <h3 class="login2">Créer un compte</h3>
                      <form action="index.php?action=validationsignup" method="POST" class="myForm2">
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
                          <div class="days form-style-date">
                            <input type="number" name="logyear" oninput="bluryear()"  class="form-style-date" placeholder="Annees" id="year" min="1930" max="2024">
                            <div class="error-message" id="yearerror"></div>
                          </div>
                          <div class="days form-style-date">
                            <input type="number" name="logmonth" oninput="blurmonth()" class="form-style-date" placeholder="Mois" id="month" min="1" max="12">
                            <div class="error-message" id="montherror"></div>
                          </div>
                          <div class="days form-style-date">
                            <input type="number" name="logday"  class="form-style-date"  placeholder="Jours" id="day" min="1" max="31" >
                            <div class="error-message" id="dayserror"></div>
                          </div>
                        </div>  
                        <div class="form-group mt-2">
                          <input type="email" name="logemail" class="form-style" placeholder="Email ou numero de telephone" id="email" oninput="handleEmail(event)">
                          <i class="input-icon uil uil-at"></i>
                          <div class="error-message" id="email2error"></div>
                        </div>  
                        <div class="form-group mt-2">
                          <input type="password" name="logpass" class="form-style" placeholder="Mot de passe" id="password" oninput="handlePassword()">
                          <i class="input-icon uil uil-lock-alt"></i>
                          <div class="error-message" id="pass2error"></div>
                        </div>
                      
                        <input type="submit" value="submit" class="btn mt-4">
                      </form>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    <?php
      if(isset($_GET['email_error'])){
          $email_error = $_GET['email_error'];
          echo 'var emailError = document.getElementById("emailerror");';
          echo 'emailError.innerText = "' . $email_error . '";';
          echo 'emailError.style.display = "block";';
      }
      if(isset($_GET['pass_error'])){
        $pass_error = $_GET['pass_error'];
        echo 'var passError = document.getElementById("passerror");';
        echo 'passError.innerText = "' . $pass_error . '";';
        echo 'passError.style.display = "block";';
      }

      require_once 'assets/script.js';

      if(isset($_GET['prenom_error'])){
        echo 'createcompte();';
        $prenom_error = $_GET['prenom_error'];
        echo 'const prenomerror = document.getElementById("prenomerror");';
        echo 'prenomerror.innerText = "' . $prenom_error . '";';
        echo 'prenomerror.style.display = "block";';
      }

      if(isset($_GET['nom_error'])){
        echo 'createcompte();';
        $nom_error = $_GET['nom_error'];
        echo 'const nomerror = document.getElementById("nomerror");';
        echo 'nomerror.innerText = "' . $nom_error . '";';
        echo 'nomerror.style.display = "block";';
      }

      if(isset($_GET['year_error'])){
        echo 'createcompte();';
        $year_error = $_GET['year_error'];
        echo 'const yearerror = document.getElementById("yearerror");';
        echo 'yearerror.innerText = "' . $year_error . '";';
        echo 'yearerror.style.display = "block";';
      }

      if(isset($_GET['month_error'])){
        echo 'createcompte();';
        $month_error = $_GET['month_error'];
        echo 'const montherror = document.getElementById("montherror");';
        echo 'montherror.innerText = "' . $month_error . '";';
        echo 'montherror.style.display = "block";';
      }

      if(isset($_GET['day_error'])){
        echo 'createcompte();';
        $day_error = $_GET['day_error'];
        echo 'const dayserror = document.getElementById("dayserror");';
        echo 'dayserror.innerText = "' . $day_error . '";';
        echo 'dayserror.style.display = "block";';
      }

      if(isset($_GET['email2_error'])){
        echo 'createcompte();';
        $email2_error = $_GET['email2_error'];
        echo 'var email2error = document.getElementById("email2error");';
        echo 'email2error.innerText = "' . $email2_error . '";';
        echo 'email2error.style.display = "block";';
      }

      if(isset($_GET['pass2_error'])){
        echo 'createcompte();';
        $pass2_error = $_GET['pass2_error'];
        echo 'var pass2error = document.getElementById("pass2error");';
        echo 'pass2error.innerText = "' . $pass2_error . '";';
        echo 'pass2error.style.display = "block";';
      }
    ?>
  </script>
</body>
</html>
<?php
  include 'mail.php';

  $to = "@gmail.com";
  $subject = "Valide account Synapse";
  $body = "<b>Connection successful</b>";

  sendEmail($to,$subject,$body);
?>