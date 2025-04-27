<?php

// Connexion DB
$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");

// Récupération de l'id_user de la session
$id_user = $_SESSION['id_user'];

// Récupère uniquement les utilisateurs qui ne sont pas encore amis
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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Amis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .friend-card {
            width: 150px;
            background-color: #2a2a2a;
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }
        .friend-card img {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container mt-4">
        <h5 class="text-white mb-3">Vous connaissez peut-être</h5>

        <div class="d-flex flex-wrap gap-3">
            <?php foreach ($users as $user): ?>
                <div class="friend-card p-2 rounded">
                    <img src="<?= htmlspecialchars($user->photo_profil) ?>" alt="">
                    <h6 class="mt-2"><?= htmlspecialchars($user->prenom) ?></h6>
                    <form class="add-friend-form" data-user-id="<?= $user->id_user ?>">
                        <button type="button" class="btn btn-primary btn-sm mt-2 w-100">Ajouter ami(e)</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.add-friend-form');

        forms.forEach(form => {
            const button = form.querySelector('button');
            
            button.addEventListener('click', function () {
                const userId = form.getAttribute('data-user-id');

                const formData = new FormData();
                formData.append('add_friend_id', userId);

                fetch('add_friend.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        button.textContent = 'Invitation envoyée ✅';
                        button.disabled = true;
                        button.classList.remove('btn-primary');
                        button.classList.add('btn-success');
                    } else {
                        alert('Erreur : ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue.');
                });
            });
        });
    });
    </script>
</body>
</html>

