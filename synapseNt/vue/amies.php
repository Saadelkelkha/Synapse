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
    <link rel="stylesheet" href="assets/home.css"/>
    <style>
        .friend-card {
            width: 150px;
            background-color: #2a2a2a;
            text-align: center;
            margin-bottom: 20px;
        }

        .friend-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .suggested-friends {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .friend-card img {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="mt-3">
        <!-- Navbar -->
        <?php require_once 'vue/layout/navhome1.php'; ?>
        <?php if ($invitationEnvoyee): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ Invitation envoyée avec succès !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <main class="mt-1 d-flex">
            <!-- Sidebar -->
            <?php require_once 'vue/layout/navhome2.php'; ?>

            <div class="content_chat">
                <div class="d-flex justify-content-center flex-wrap-2">
                    <!-- Feed -->
                    <?php
$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
$id_user = $_SESSION['id_user'];

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
        // Insertion dans la table invitations
        $insertStmt = $pdo->prepare("INSERT INTO friend_requests (sender_id, receiver_id, status, sent_at) 
            VALUES (:sender, :receiver, 'pending', NOW())");
        $insertStmt->execute([
            'sender' => $id_user,
            'receiver' => $receiver_id
        ]);
        $_SESSION['invitationEnvoyee'] = true;
      
    }
}

    

                        // Récupère uniquement les utilisateurs qui ne sont pas amis avec l'utilisateur actuel
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

                        if (count($users) > 0) {
                            echo '<h5 class="text-white mb-3">Vous connaissez peut-être</h5>';
                        }

                        foreach ($users as $user) {
                    ?>
                        <div class="friend-card text-white p-2 rounded">
                            <img src="<?php echo $user->photo_profil; ?>" alt="">
                            <h6 class="mb-0"><?php echo htmlspecialchars($user->prenom); ?></h6>
                            <form method="post">
            <input type="hidden" name="add_friend_id" value="<?= $user->id_user ?>">
            <button type="submit" class="btn btn-primary btn-sm mt-2 w-100" onclick="alert('Ajoutement avec succes')">Ajouter ami(e)</button>
        </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    
        // location.reload();
</script>

</body>
</html>
