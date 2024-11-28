<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login/Signup Form</title>
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
                      <form action="" method="" class="myForm1" onsubmit="submitform1(event)">
                        <div class="form-group">
                          <input type="email"  name="logemail" oninput="blurEmail1(event)" class="form-style" placeholder="Email" id="logemail" autocomplete="off" >
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
                      </div>
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
                      <form action="" class="myForm2" onsubmit="submitForm2(event)">
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
                            <input type="number" name="logyear" oninput="bluryear(event)"  class="form-style-date" placeholder="Annees" id="year" min="1930" max="2024">
                            <div class="error-message" id="yearerror"></div>
                          </div>
                          <div class="days form-style-date">
                            <input type="number" name="logmonth" oninput="blurmonth(event)" class="form-style-date" placeholder="Mois" id="month" min="1" max="12" disabled>
                            <div class="error-message" id="montherror"></div>
                          </div>
                          <div class="days form-style-date">
                            <input type="number" name="logday" class="form-style-date"  placeholder="Jours" id="day" min="1" max="31" disabled>
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
  <script src="assets/script.js"> </script>
</body>
</html>
<?php
  include 'mail.php';

  $to = "ziadchamrah20@gmail.com";
  $subject = "Valide account Synapse";
  $body = "<b>Connection successful</b>";

  sendEmail($to,$subject,$body);
?>
