<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/home.css" />
</head>
<body>
    <div class=" mt-4">
        <!-- Navbar -->
        <?php require_once 'vue/layout/navhome1.php'; ?>

        <main class="mt-1 d-flex">
            <!-- Sidebar -->
            <?php require_once 'vue/layout/navhome2.php'; ?>
            <!-- Formulaire de création de post -->
            <div class="content_chat" id="content10">
                
                <div class="content flex-grow-1 " width=100vw >
                    <h2 align="right" class="mt-3" style="font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Resultats de la recherche "<?php echo $keywords; ?>" </h2>

                      <div class="feed" style="width: 80%;">
                        <div class="user">
                            <!-- Section Groupes -->
                            <div class="profile-pic" style="width: 100%; display: flex; gap: 10px;">
                                <div class="name1" style="padding: 0 2%; width: 100%;">
                                    <h4 class="mb-4" style="font-weight: bold;">Groupes</h4>
                                    <div class="group-rejoindre" style="display: flex; flex-direction: column; gap: 20px; width: 100%;">
                                    <?php if ($afficher && !empty($groupes)) {
                                            foreach ($groupes as $group) { ?>
                                            <div class="person-card" style="display: flex; align-items: center; gap: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                                <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" height="50" width="50" style="border-radius: 50%;">
                                                <div style="flex-grow: 1; display: flex; flex-direction: column; align-items: flex-start;">
                                                    <h6 style="font-weight: 600; margin: 0;"><?php echo $group['name_group']; ?></h6>
                                                    <small style="font-size: small; color: #777;"><?php echo $group['description_group']; ?></small>
                                                </div>
                                                <button class="btn btn-primary rejoindre-btn" style="border-color: #2B2757;">Rejoindre</button>
                                            </div>
                                        <?php  }
                                        } else{
                                            echo "<h3 align='center'>0 Resultats</h3>";}
                                         ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <!-- Section Personnes -->
                        <div class="profile-pic" style="width: 100%; display: flex; gap: 10px;">
                            <div class="name1" style="padding: 0 2%; width: 100%;">
                                <h4 class="mb-4" style="font-weight: bold;">Personnes</h4>
                                <div class="group-rejoindre" style="display: flex; flex-direction: column; gap: 20px; width: 100%;">
                                <?php if ($afficher && !empty($users)) {
                                        foreach ($users as $user) { ?>
                                        <div class="person-card" style="display: flex; align-items: center; gap: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                            <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" height="50" width="50" style="border-radius: 50%;">
                                            <div style="flex-grow: 1; display: flex; flex-direction: column; align-items: flex-start;">
                                                <h6 style="font-weight: 600; margin: 0;"><?php echo $user['nom'] . ' ' . $user['prenom']; ?></h6>
                                            </div>
                                            <button class="btn btn-primary rejoindre-btn" style="border-color: #2B2757;">Ajouter</button>
                                        </div>
                                        <?php  }
                                    } else{
                                        echo "<h3 align='center'>0 Resultats</h3>";}
                                 ?>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <br><br>
        </main> 
    </div>
</body>
</html>