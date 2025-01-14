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
                <p style="color: grey;" class="text-center">Entrez votre adresse e-mail pour recevoir un lien de connexion.</p>
                <form action="index.php?action=send_code" method="post" width="100%">
                    <input type="email" class="form-control-r" aria-label="Default" placeholder="E-mail" name="mail" aria-describedby="inputGroup-sizing-default">
                    <div class="error-message" id="emailerror"></div>
                    <input type="submit" class="form-button-r" aria-label="Default" value="Envoyer un lien de connexion" aria-describedby="inputGroup-sizing-default">
                </form>
                <a href="#" class="form-link-r">Vous ne parvenez pas à réinitialiser votre mot de passe ? </a>
                <p class="divider">OU</p>
                <a href="index.php?action=add" class="form-link-r2">Créer un compte</a>
            </div>
    </div>
    <script>
        <?php
            if(isset($_GET['email_error'])){
                $email_error = $_GET['email_error'];
                echo 'var emailError = document.getElementById("emailerror");';
                echo 'emailError.innerText = "' . $email_error . '";';
                echo 'emailError.style.display = "block";';
                echo 'emailError.style.position = "relative";';
            }
        ?>
    </script>
</body>
</html>