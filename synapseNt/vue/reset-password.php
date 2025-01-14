<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problèmes de connexion</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color: white;">
    <div class="container_reinitialiser">
        <div class="nav-r mb-5">
            <img src="img/logop.png" class="nav-r-logo mt-0" alt="">
        </div>
        <div class="par1-r">
            <div class="a" id="a">
                    <img src="img/logop.png" class="mb-5" alt="" width="30%">
                    <h6 style="color: black;"><b>Problèmes de connexion ?</b></h6>
                    <p style="color: grey;" class="text-center">Entrez un nouveau mot de passe pour récupérer votre compte.</p>
                    <form action="index.php?action=change_password" method="post">
                        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                        <?php if(isset($_GET['admin'])){ 
                            echo "<input type='hidden' name='admin' value='{$_GET['admin']}'>";
                        }
                        ?>
                        <input type="password" class="form-control-r" aria-label="Default" placeholder="Nouveau mot de passe" name="pass" aria-describedby="inputGroup-sizing-default">
                        <div class="error-message" id="passerror"></div>
                        <input type="submit" class="form-button-r" aria-label="Default" value="Changer le mot de passe" aria-describedby="inputGroup-sizing-default">
                    </form>
                    <a href="#" class="form-link-r">Vous ne parvenez pas à réinitialiser votre mot de passe ? </a>
                    <p class="divider">OU</p>
                    <a href="index.php?action=add" class="form-link-r2">Créer un compte</a>
            </div>
            <a class="go-login-link" href="index.php?action=add"><b>Revenir à l'écran de connexion</b></a>
        </div>
    </div>
    <script>
        <?php
            if(isset($_GET['pass3_error'])){
                $pass_error = $_GET['pass3_error'];
                echo 'var passError = document.getElementById("passerror");';
                echo 'passError.innerText = "' . $pass_error . '";';
                echo 'passError.style.display = "block";';
                echo 'passError.style.position = "relative";';
            }
        ?>
    </script>
</body>
</html>