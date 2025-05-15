<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/home.css">
    <title>Paramètres | SynapseNt</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/logop11.png" type="image/png">
    <style>
        .navhome1{
  display: flex;
  padding:0px 3%;
  margin: 0px;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  height: 80px;
  position: fixed;
  background-color: #ffffff;
  z-index: 5;
  top: 0;
  left: 0;
}

.navhome1_left{
display: flex;
}

.navhome1_left form{
display: flex;
}

.navhome1 > form > input {
width: 40vw;
}

.navhome1_right{
gap: 5px;
display: flex;
justify-content: end;
align-items: center;
padding: 0px;
}

.navhome1_profile{
border-radius: 50%;
}

.content_chat{
  display: flex;
  width: 60%;
  position: relative;
  left: 20vw;
  top: 80px;
}
    </style>
    <script>
        // Fonction pour prévisualiser l'image
        function previewImage(input, previewId) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                const img = document.getElementById(previewId);
                img.src = e.target.result;
                img.style.display = "block"; // Afficher l'image
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        // Fonction pour initialiser la prévisualisation des images
        document.addEventListener('DOMContentLoaded', function () {
            // Photo de profil
            const profilePhotoInput = document.querySelector('input[name="photo_profil"]');
            const profilePhotoPreview = document.getElementById('profilePhotoPreview');
            profilePhotoInput.addEventListener('change', function () {
                previewImage(this, 'profilePhotoPreview');
            });

            // Bannière
            const bannerInput = document.querySelector('input[name="banner"]');
            const bannerPreview = document.getElementById('bannerPreview');
            bannerInput.addEventListener('change', function () {
                previewImage(this, 'bannerPreview');
            });
        });
    </script>
</head>
<body class="bg-light p-5">
<?php require_once 'vue/layout/navhome1.php'; ?>
<br><br>
    <div class="container bg-white p-4 rounded shadow">
        <h2 class="mb-3">Paramètres du Compte</h2>
        <form method="POST" enctype="multipart/form-data" action="index.php?action=modifierProfile1">
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="<?php echo htmlspecialchars($user['prenom']); ?>">
                </div>
                <div class="col-md-6">
                    <input type="text" name="nom" class="form-control" placeholder="Nom" value="<?php echo htmlspecialchars($user['nom']); ?>">
                </div>
            </div>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>">
            <input type="date" name="date_naissance" class="form-control mb-3" value="<?php echo htmlspecialchars($user['date_naissance']); ?>">
            <textarea name="bio" class="form-control mb-3" placeholder="Bio"><?php echo htmlspecialchars($user['bio']); ?></textarea>
            
            <div class="mb-3">
                <h3>Photo de Profil</h3>
                <img id="profilePhotoPreview" src="<?php echo $user['photo_profil']; ?>" class="rounded-circle border" width="100" height="100" alt="Profile" style="display: block;">
                <input type="file" name="photo_profil" class="form-control mt-2">
            </div>
            
            <div class="mb-3">
                <h3>Bannière</h3>
                <img id="bannerPreview" src="<?php echo $user['banner']; ?>" class="w-100 border rounded" alt="Cover" style="display: block;">
                <input type="file" name="banner" class="form-control mt-2">
            </div>
            
            <button type="submit" class="btn btn-dark" name="modifierProfil">Enregistrer les modifications</button>
            
        </form>
    </div>

</body>
</html>
