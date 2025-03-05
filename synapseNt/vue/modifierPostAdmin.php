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
    <style>
      #Users i{
        color: #102770;
      }

      #Users h3{
        color: #102770;
      }


.gusersupdate {
    width: 50%;
    margin:  auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
}

.center-wrap {
    text-align: center;
}

.gusersupdate h3 {
    color: #102770;
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 20px;
}

.gusersupdate p {
    color: #6c757d;
    font-size: 14px;
    margin-bottom: 20px;
}

.img-nom5 {
    display: flex;
    align-items: center;
    gap: 15px;
    justify-content: center;
}

.img-nom5 img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #102770;
}

textarea.form-control {
    border-radius: 10px;
    padding: 15px;
    font-size: 16px;
    border: 2px solid #ddd;
    transition: 0.3s;
}

textarea.form-control:focus {
    border-color: #102770;
    box-shadow: 0 0 10px rgba(16, 39, 112, 0.2);
}

.options {
    margin: 20px 0;
    text-align: center;
}

.options label {
    font-weight: 600;
    color: #102770;
    cursor: pointer;
    padding: 10px 15px;
    border: 2px solid #102770;
    border-radius: 5px;
    display: inline-block;
    transition: 0.3s;
}

.options label:hover {
    background-color: #102770;
    color: white;
}

#imageInput {
    display: none;
}

button.btn-primary {
    background-color: #102770;
    border: none;
    padding: 12px 20px;
    font-size: 16px;
    border-radius: 8px;
    transition: 0.3s;
    font-weight: 600;
}

button.btn-primary:hover {
    background-color: #0c1f55;
}

.image-width {
    border-radius: 10px;
    margin-top: 10px;
    object-fit: cover;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}


      
    </style>
</head>
<body>
    <div class="">
        <?php require_once 'vue/layout/navhome1admin.php'; ?>
        <main class="mt-1 d-flex">
            <?php require_once 'vue/layout/navhome2admin.php';?>
            <div class="gusersupdate">
                <div class="center-wrap">
                    <div class="section1 text-center">
                      <img class="g" src="img/logop.png" width="50%">
                        <p class="par2">Gérez vos tâches administratives efficacement.</p>
                        <h3 class="login2">Mise à jour du compte utilisateur par l'administrateur</h3>
                        <form action="index.php?action=modifierPost" enctype="multipart/form-data" method="post">
                    <div class="name1">
                        <div class="img-nom5">
                            <img src="img/Profile/Julia Clarke.png" alt="">
                            <h5 class="mt-2">Ahmed Said</h5>
                        </div>
                        <input type="hidden" name="id_post" value="<?php echo htmlspecialchars($post->id_post); ?>">

                        <textarea class="form-control mt-3" placeholder="What's on your mind, SynapseNt?" rows="3" name="text_content"><?php echo htmlspecialchars($post->text_content); ?></textarea>

                        <div class="options">
                            <label for="imageInput">Choisir une nouvelle image</label>
                            <div id="uploadedImageContainer"></div>
                            <input type="file" id="imageInput" name="image" accept="image/*">
                        </div>
                        
                    </div>
                    <button class="btn btn-primary" id="supprimerPhoto">Supprimer La photo</button>
                    <input type="hidden" name="oldimagepath" value="<?php echo htmlspecialchars($post->image_path);  ?>">
                    <input type="hidden" name="oldimagepathTrue" value="true">
                    <img class="image-width" height="500px" width="100%" src="<?php echo htmlspecialchars($post->image_path); ?>" alt="Image du post">
                    <br>
                    <button class="btn btn-primary mt-1" name="modifier">Modifier</button>
                    
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