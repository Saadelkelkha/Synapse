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
                            <div class="" style="width: 100%; display: flex; gap: 10px;">
                                <div class="name1" style="padding: 0 2%; width: 100%;">
                                    <h4 class="mb-4" style="font-weight: bold;">Groupes</h4>
                                    <div class="group-rejoindre" style="display: flex; flex-direction: column; gap: 20px; width: 100%;">
                                    <?php if ($afficher && !empty($groupes)) {
                                            foreach ($groupes as $group) { 
                                                $issendinvet = false;
                                                ?>
                                            <div class="person-card" style="display: flex; align-items: center; gap: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;height:60px">
                                                <img src="<?php echo $group['group_banner']; ?>" style="max-height: 50px;width: 30%;border-redius:0%">
                                                <div style="flex-grow: 1; display: flex; flex-direction: column; align-items: flex-start;max-height: 50px;max-width: 30%;white-space: nowrap;overflow: hidden;text-overflow: ellipsis">
                                                    <h6 style="font-weight: 600; margin: 0;"><?php echo $group['name_group']; ?></h6>
                                                    <small style="font-size: small; color: #777;"><?php echo $group['description_group']; ?></small>
                                                </div>
                                                <?php
                                                    foreach ($invitations as $invitation){
                                                        if($invitation->id_groupe == $group['id_group'] && $invitation->id_user == $id){
                                                            $issendinvet = true;
                                                            break;
                                                        }
                                                    }
                                                    if($issendinvet == true){
                                                        ?>
                                                        <button class="btn btn-primary rejoindre-btn" style="border-color: #2B2757;margin-left: auto;width:30%" id="join_groupe" onclick="join_groupe(<?php echo $group['id_group']; ?>,event)">Cancel request</button>
                                                    <?php }elseif($issendinvet == false){
                                                        $isingroup = false;
                                                        foreach($joingroupes as $joingroupe){
                                                            if($joingroupe->id_group == $group['id_group']){
                                                                $isingroup = true;
                                                                break;
                                                            }
                                                        }
                                                        if($isingroup == true){
                                                ?>      
                                                            <form class="" method="POST" action="index.php?action=exploregroup" style="margin-left: auto;width:30%">
                                                                <input type="hidden" value="<?php echo $group['id_group']; ?>" name="id_group">
                                                                <button class="btn btn-primary open-btn" style="border-color: #2B2757;">Open</button>
                                                            </form>
                                                    <?php }else{ ?>
                                                        <button class="btn btn-primary rejoindre-bt" style="border-color: #2B2757;margin-left: auto;width:30%" id="join_groupe" onclick="join_groupe(<?php echo $group['id_group']; ?>,event)">Rejoindre</button>
                                                    <?php }} ?>
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
                        <?php
// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
$id_user = $_SESSION['id_user'];

// Vérifier si l'invitation a été envoyée
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_friend_id'])) {
    $receiver_id = $_POST['add_friend_id'];

    // Vérifie si l'invitation existe déjà
    $checkStmt = $pdo->prepare("SELECT * FROM friend_requests 
        WHERE (sender_id = :sender AND receiver_id = :receiver)
        OR (sender_id = :receiver AND receiver_id = :sender)");
    $checkStmt->execute([
        'sender' => $id_user,
        'receiver' => $receiver_id
    ]);

    if ($checkStmt->rowCount() === 0) {
        // Insertion dans la table des invitations
        $insertStmt = $pdo->prepare("INSERT INTO friend_requests (sender_id, receiver_id, status, sent_at) 
            VALUES (:sender, :receiver, 'pending', NOW())");
        $insertStmt->execute([
            'sender' => $id_user,
            'receiver' => $receiver_id
        ]);
        $_SESSION['invitationEnvoyee'] = true;
    }
}

// Récupérer les utilisateurs qui ne sont pas amis
$sql = "
    SELECT * FROM user 
    WHERE id_user != :id_user 
    AND id_user NOT IN (
        SELECT user_id_2 FROM friends WHERE user_id_1 = :id_user
        UNION
        SELECT user_id_1 FROM friends WHERE user_id_2 = :id_user
    )
";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_user' => $id_user]);
$users = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_SESSION['invitationEnvoyee']) && $_SESSION['invitationEnvoyee']) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ Invitation envoyée avec succès !
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    unset($_SESSION['invitationEnvoyee']);
}
?>

<div class="profile-pic" style="width: 100%; display: flex; gap: 10px;">
    <div class="name1" style="padding: 0 2%; width: 100%;">
        <h4 class="mb-4" style="font-weight: bold;">Personnes</h4>
        <div class="group-rejoindre" style="display: flex; flex-direction: column; gap: 20px; width: 100%;">
            <?php if (!empty($users)) {
                foreach ($users as $user) { ?>
                    <div class="person-card" style="display: flex; align-items: center; gap: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                        <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" height="50" width="50" style="border-radius: 50%;">
                        <div style="flex-grow: 1; display: flex; flex-direction: column; align-items: flex-start;">
                            <h6 style="font-weight: 600; margin: 0;"><?php echo $user->nom . ' ' . $user->prenom; ?></h6>
                        </div>
                        <form method="post">
                            <input type="hidden" name="add_friend_id" value="<?= $user->id_user ?>">
                            <button type="submit" class="btn btn-primary rejoindre-btn" style="border-color: #2B2757;">Ajouter</button>
                        </form>
                    </div>
                <?php }
            } else {
                echo "<h3 align='center'>0 Résultats</h3>";
            } ?>
        </div>
    </div>
</div> 
                </div>
            </div>
            <br><br>
        </main> 
    </div>
    <script>
        $(document).ready(function () {
            window.join_groupe = function (id_groupe,event) {
                if (id_groupe) {
                    if (event.target.innerText === 'Rejoindre') {
                        $.ajax({
                            url: 'index.php?action=join_group',
                            method: 'POST',
                            data: {
                                id_groupe: id_groupe,
                            },
                            success: function () {
                                event.target.innerText = 'Cancel request';
                            },
                            error: function () {
                                event.target.innerText = 'Rejoindre';
                            },
                        });
                    }else{
                        if (event.target.innerText === 'Cancel request') {
                            $.ajax({
                                url: 'index.php?action=cancel_join_group',
                                method: 'POST',
                                data: {
                                    id_groupe: id_groupe,
                                },
                                success: function () {
                                    event.target.innerText = 'Rejoindre';
                                },
                                error: function () {
                                    event.target.innerText = 'Cancel request';
                                },
                            }); 
                        }
                    }
                    
                }
            }
        });
    </script>
</body>
</html>