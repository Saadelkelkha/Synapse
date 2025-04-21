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
    <link rel="stylesheet" href="assets/style.css" />
    <style>
      #Groups i{
        color: #102770;
      }

      #Groups h3{
        color: #102770;
      }
    </style>
</head>
<body>
    <div class="">
        <?php require_once 'vue/layout/navhome1admin.php'; ?>
        <main class="mt-1 d-flex">
            <?php require_once 'vue/layout/navhome2admin.php';?>
            <div class="gusersupdate">
                <div class="center-wrap w-100">
                    <div class="section1 text-center w-100">
                      <img class="g" src="img/logop.png" width="50%">
                        <p class="par2">Gérez vos tâches administratives efficacement.</p>
                        <h3 class="login2">Mise à jour du groupe par l'administrateur</h3>
                          <form action="index.php?action=valide_update_groupe" method="POST" class="myForm2">
                            <input type="hidden" name="id" value="<?php if(isset($id_groupe)){echo $id_groupe;} ?>">
                            <label for="logdate" style="align-self: flex-start;margin-left: 15%; margin-top: 15px; margin-bottom: -10px;">Nom de groupe</label>
                            <div class="form-group mt-2">
                              <input type="text" name="logprenom" class="form-style" placeholder="Nom de groupe" id="logprenom" value="<?php if(isset($name_group)){echo $name_group;} ?>" required>
                              <div class="error-message" id="prenomerror"></div>
                            </div>
                            <label for="logdate" style="align-self: flex-start;margin-left: 15%; margin-top: 15px; margin-bottom: -10px;">Description de groupe</label>
                            <div class="form-group mt-2">
                              <textarea name="lognom" class="form-style" placeholder="Description" id="lognom" required><?php if(isset($description_group)){echo $description_group;} ?></textarea>
                              <div class="error-message" id="nomerror"></div>
                            </div>
                            <input type="submit" value="submit" class="btn mt-4" style="background-color: #102770;color:white">
                          </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
  </script>
</body>
</html>