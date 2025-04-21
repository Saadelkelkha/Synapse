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
    <link rel="stylesheet" href="assets/style.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #group_discussion{
            border-bottom: 2px solid #2B2757;
            color:#2B2757;
        }

        /* Popup styles */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            text-align: center;
        }

        .popup h2 {
            margin-bottom: 10px;
        }

        .popup button {
            background-color: #2B2757;
        }

        /* Overlay to dim background */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none; /* Hidden by default */
            z-index: 999;
        }

        .creer-poste {
            
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container_creer{
            width: 400px;
            overflow: hidden;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
            z-index: 300;
            position: relative;
        }

        .post header {
            font-size: 22px;
            font-weight: 600;
            padding: 17px 0;
            text-align: center;
        }

        .post form {
            margin: 20px 25px;
        }

        form textarea {
            width: 100%;
            resize: none;
            font-size: 18px;
            min-height: 100px;
            outline: none;
            border: none;
            margin-bottom: 15px;
        }

        #uploadedImageContainer img {
            height: 100px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 80%;
            margin-top: 10px;
        }

        #uploadedImageContainer {
            display: flex;
            justify-content: center;
        }

        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 57px;
            margin: 15px 0;
            padding: 0 15px;
            border-radius: 7px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .options p {
            color: #595959;
            font-size: 15px;
            font-weight: 500;
            cursor: default;
        }

        .options .list {
            display: flex;
            list-style: none;
        }

        .options .list li {
            cursor: pointer;
        }

        .options .list li label {
            cursor: pointer;
            display: inline-block;
            padding: 10px;
        }

        .options .list li input[type="file"] {
            display: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background-color: #2B2757;
            border: none;
            border-radius: 8px;
            cursor: pointer;

        }

        input[type="submit"]:hover {
            background-color:rgb(47, 41, 112);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .dropdown {
                    position: relative;
                    display: inline-block;
                }
        .dropdown-btn {
            background-color: while;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-content a {
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown.show .dropdown-content {
            display: block;
        }
        .btn-enregsitrer{
            color:black;
            background-color:white;
        }
        .btn-enregistrer i:hover{
            color:white;
        }

        .hidden-modifier {
            display: none;
        }

        .overlay-modifier {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
        }

        .overlay-supprimer{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
        }

        .popup-modifier {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 10px;
            z-index: 1100;
            width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .popup-modifier header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .popup-modifier textarea {
            width: 100%;
            height: 100px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .popup-modifier .options-modifier {
            text-align: left;
            margin-bottom: 20px;
        }

        .popup-modifier .options-modifier p {
            margin: 0;
            font-size: 1rem;
            color: #555;
        }

        .popup-modifier .options-modifier label {
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
        }

        .popup-modifier .options-modifier label img {
            width: 24px;
            height: 24px;
        }

        .popup-modifier button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            margin: 5px;
            width: calc(50% - 10px);
        }

        .popup-modifier button:hover {
            background-color: #45a049;
        }

        .popup-modifier .close-popup-btn-modifier {
            background-color: #f44336;
        }

        .popup-modifier .close-popup-btn-modifier:hover {
            background-color: #e53935;
        }

        .dropdown-modifier {
            position: relative;
            display: inline-block;
        }

        .dropdown-content-modifier {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content-modifier button,
        .dropdown-content-modifier a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            text-align: left;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
        }

        .dropdown-content-modifier button:hover,
        .dropdown-content-modifier a:hover {
            background-color: #f3f4f6;
        }

        .dropdown-modifier .dropdown-btn-modifier:focus + .dropdown-content-modifier {
            display: block;
        }

        .enregistrer-annuler-btn{
            display:flex;
        }
    </style>
</head>
<body>
    <div class="mt-3">
        <nav class="navhome1" style="padding:30px 3%;" style="100px">
            <div class="navhome1_left">
                <img src="img/logop.png" height="50">
            </div>
            <div class="navhome1_right">
                
            </div>
        </nav>
        <main class="mt-1 d-flex">
            
        </main>
    </div>
    <div>
    <div id="login" class="popup p-0" style="max-width: 400px;">
            <div class="section1 text-center w-100" style="border-radius: 10px;">
              <img class="g" src="img/logop.png">
              <p class="par1">Connectez-vous, Partagez et Explorez ensemble.</p>

              
              <h3 class="login1">Se connecter</h3>
              <form action="index.php?action=validationlogin" method="POST" class="myForm1">
                <input type="hidden" name="id_post_partager" value="<?= $id_post; ?>">
                <div class="form-group  w-100">
                  <input type="email"  name="logemail" class="form-style" placeholder="Email" id="logemail" autocomplete="off" oninput="blurEmail1()">
                  <i class="input-icon uil uil-at"></i>
                  <div class="error-message" id="emailerror"></div>
                </div>  
                <div class="form-group  w-100 mt-2">
                  <input type="password" name="logpass" class="form-style" placeholder="Mot de passe" id="logpass" autocomplete="off">
                  <i class="input-icon uil uil-lock-alt"></i>
                  <div class="error-message" id="passerror"></div>
                </div>
                <input type="submit" value="submit" class="btn mt-4">
                  <p class="mb-0 mt-4 text-center">
                    <a href="index.php?action=reintialiser" class="link">Mot de passe oublié?</a><br>
                    <p>Vous n'avez pas de compte? <a style="color: #102770; background: none; border: none; cursor: pointer;" href="index.php?action=add">Creer un compte</a></p>
                  </p>
              </form>
            </div>
    </div>
    <div class="overlay" id="overlayamie" onclick="affichepopup(event)"></div>
    <script>
        function affichepopup(event) {
            var form = document.getElementById('login');
            var overlay = document.getElementById('overlayamie');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'flex';
                overlay.style.display = 'block';
            } else {
                form.style.display = 'none';
                overlay.style.display = 'none';
            }
        }
    </script>
</body>
</html>