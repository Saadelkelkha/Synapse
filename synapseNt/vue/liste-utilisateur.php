<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste d'amis</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { margin: auto; }
        .card { padding: 10px; border: 1px solid #ddd; margin-bottom: 10px; border-radius: 5px; display: flex; justify-content: space-between; align-items: center; }
        button { padding: 5px 10px; border: none; cursor: pointer; }
        .btn-send { background-color: blue; color: white; }
        .btn-accept { background-color: green; color: white; }
        .btn-delete { background-color: red; color: white; }
        
        .active-tab {
            border-bottom: 2px solid blue;
            font-weight: bold;
        }
        .friend-card {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 10px;
            width: 300px;
        }
        .friend-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .friend-card .ellipsis {
            margin-left: auto;
            cursor: pointer;
        }
        .profile-banner {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 10px;
    display: block; /* Supprime les marges automatiques */
    margin-top: 60px; /* Enlève toute marge */
    padding: 0; /* Enlève tout padding */
}

.profile-container {
    position: relative;
    margin-top: -60px;
    text-align: center;
    display: flex;
    flex-direction: column;
    /* align-items: center; Centrage sans décalage */
   
    width: 100%; /* Pour s'assurer que tout est bien aligné */
    padding: 0;
  
   
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Enlève tout padding */
}


.profile-img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    border: 4px solid white;
    background-color: white;
    object-fit: cover;
    margin-left: 20px;
    padding: 0; /* Supprime tout padding */
}
.text-profil-after-pic{
    margin-left: 50px;
}

.profile-info {
   
    margin: 0; /* Enlève les marges */
    padding: 0; /* Supprime les espaces inutiles */
}

.profile-info h3 {
    font-size: 20px;
    font-weight: bold;
    margin-top: 5px; /* Ajustement pour éviter le décalage */
}

.btn-edit {
    margin-top: 10px;
    padding: 8px 16px;
    font-size: 14px;
    border-radius: 20px;
}
.navbar-nav .nav-link {
            color: #333;
            font-weight: bold;
        }
        .profile-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .btn-light {
            width: 100%;
            text-align: left;
        }
        .post-box {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .post-options button {
            background: none;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .filter-buttons button {
            border: none;
            padding: 5px 10px;
            font-weight: bold;
        }
        .image-phpstyle{
            background-color: red;
            display:flex;
            flex-direction:row;
        }
    </style>
</head>
<body>



</body>
</html>



<?php
$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");

// ID de l'utilisateur connecté
$id_user = $_SESSION['id_user'] ?? 1;

// Envoi d'une invitation
if (isset($_POST['send_request'])) {
    $receiver_id = $_POST['receiver_id'];
    $stmt = $pdo->prepare("INSERT INTO friend_requests (sender_id, receiver_id) VALUES (?, ?)");
    $stmt->execute([$id_user, $receiver_id]);

    // Récupérer les infos de l'utilisateur invité
    $user = $pdo->prepare("SELECT prenom, nom FROM user WHERE id_user = ?");
    $user->execute([$id_user]);
    $userInfo = $user->fetch(PDO::FETCH_ASSOC);

    echo json_encode(["status" => "success", "id" => $pdo->lastInsertId(), "prenom" => $userInfo['prenom'], "nom" => $userInfo['nom']]);
    exit;
}
if (isset($_POST['accept_request'])) {
    $request_id = $_POST['request_id'];
    
    // Mettre à jour le statut de la demande à "accepted"
    $stmt = $pdo->prepare("UPDATE friend_requests SET status = 'accepted' WHERE id = ?");
    $stmt->execute([$request_id]);

    echo json_encode(["status" => "success"]);
    exit;
}
// Refuser une invitation (mettre à jour le statut à "declined")
if (isset($_POST['decline_request'])) {
    $request_id = $_POST['request_id'];

    // Mettre à jour le statut de la demande à "declined"
    $stmt = $pdo->prepare("UPDATE friend_requests SET status = 'declined' WHERE id = ?");
    $stmt->execute([$request_id]);

    echo json_encode(["status" => "success"]);
    exit;
}


// Accepter une invitation
if (isset($_POST['accept_request'])) {
    $request_id = $_POST['request_id'];
    $stmt = $pdo->prepare("DELETE FROM friend_requests WHERE id = ?");
    $stmt->execute([$request_id]);

    echo json_encode(["status" => "success"]);
    exit;
}

// Supprimer une invitation
if (isset($_POST['delete_request'])) {
    $request_id = $_POST['request_id'];
    $stmt = $pdo->prepare("DELETE FROM friend_requests WHERE id = ?");
    $stmt->execute([$request_id]);

    echo json_encode(["status" => "success"]);
    exit;
}

// Récupérer les utilisateurs sauf l'utilisateur connecté
$users = $pdo->query("SELECT * FROM user WHERE id_user != $id_user")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les invitations reçues
$requests = $pdo->query("SELECT friend_requests.id, user.prenom, user.nom 
                         FROM friend_requests 
                         JOIN user ON user.id_user = friend_requests.sender_id 
                         WHERE receiver_id = $id_user")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les invitations reçues via GET
if (isset($_GET['get_received_requests'])) {
    $requests = $pdo->query("SELECT friend_requests.id, user.prenom, user.nom 
                             FROM friend_requests 
                             JOIN user ON user.id_user = friend_requests.sender_id 
                             WHERE receiver_id = $id_user")->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(["status" => "success", "requests" => $requests]);
    exit;
}

// Récupérer le nombre d'amis de l'utilisateur connecté
$stmt = $pdo->prepare("SELECT COUNT(*) - 1 AS friend_count FROM friends WHERE user_id_1 = ? OR user_id_2 = ?");
$stmt->execute([$id_user, $id_user]);
$friendCount = $stmt->fetch(PDO::FETCH_ASSOC)['friend_count'];

?>


<body>

<div class="container">
<main class="mt-1 d-flex">
            <!-- Sidebar -->
            
            <!-- Formulaire de création de post -->
            <div class="container mt-4">
        <!-- Profile Banner -->
        <img src="<?php echo $user['banner']; ?>" alt="Banner" class="profile-banner">
        
        <!-- Profile Info -->
        <div class="profile-container">
            <img src="<?php echo $user['photo_profil']; ?>" alt="Profile Picture" class="profile-img">
            <div class="profil-pic-button">
                
              <div class="text-profil-after-pic">
              <h3 align="start"><?php if(isset($fullname)){echo $fullname;} ?></h3>
             
            
              <p align="start">Lead Product Designer at Apple</p>
              <p align="start">Followers</p>
              </div>
              <button class="btn btn-primary btn-edit">Modifier Profil</button>
               
            </div>
          
         <br><br>
        
                  
<div class="container mt-2">
<nav class=" navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">Réseau Social</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php?action=afficherProfil">Publications</a></li>
                <li class="nav-item"><a class="nav-link" href="#">À propos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Ami(e)s</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?action=afficherPhotos">Photos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Vidéos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Plus</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <h4 class="fw-bold">Ami(e)s</h4>

    <!-- Barre de recherche et options -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <input type="text" class="form-control w-25" placeholder="🔍 Rechercher">
        <div>
            <a href="#" class="me-3 text-decoration-none text-primary">Invitations</a>
            <a href="index.php?action=listeUtilisateur" class="me-3 text-decoration-none text-primary">Retrouver des ami(e)s</a>
            <a href="#" class="text-decoration-none text-primary">Inviter des ami(e)s</a>
        </div>
    </div>

    <!-- Onglets -->
    <div class="d-flex border-bottom mb-3">
        <a href="#" class="me-3 pb-2 active-tab text-decoration-none text-dark">Tous les amis</a>
        <a href="#" class="pb-2 text-decoration-none text-dark">Ajouts récents</a>
    </div>

    <!-- Liste d'amis -->
    <div class="friend-card">
        <img src="https://via.placeholder.com/50" alt="Photo de profil">
        <div>
            <h6 class="mb-0">Nuestro Verdigo</h6>
            <small class="text-muted">Marrakech</small>
        </div>
        <div class="ellipsis">⋯</div>
    </div>
</div>

    <h2>Liste des utilisateurs</h2>
    <?php foreach ($users as $user): ?>
        <div class="card">
            <span><?= htmlspecialchars($user['nom']. " " . $user['prenom']) ?></span>
            <button class="btn-send" onclick="sendRequest(<?= $user['id_user'] ?>)">Ajouter</button>
            
        </div>
    <?php endforeach; ?>

    <h2>Invitations reçues</h2>
    <div id="requests">
        <?php foreach ($requests as $request): ?>
            <div class="card" id="request-<?= $request['id'] ?>">
                <span><?= htmlspecialchars($request['prenom'] . " " . $request['nom']) ?></span>
                <button class="btn-accept" onclick="acceptRequest(<?= $request['id'] ?>)">Accepter</button>
                <button class="btn-delete" onclick="deleteRequest(<?= $request['id'] ?>)">Supprimer</button>
            </div>
        <?php endforeach; ?>
        <p>Vous avez <?= $friendCount ?> ami(s).</p>

    </div>
</div>

<script>
function sendRequest(receiver_id) {
    $.post("", { send_request: true, receiver_id: receiver_id }, function(response) {
        if (response.status === "success") {
            // Ajouter l'invitation dynamiquement pour l'utilisateur qui a envoyé
            $("#requests").append(`
                <div class="card" id="request-${response.id}">
                    <span>${response.prenom} ${response.nom}</span>
                    <button class="btn-accept" onclick="acceptRequest(${response.id})">Accepter</button>
                    <button class="btn-delete" onclick="deleteRequest(${response.id})">Supprimer</button>
                </div>
            `);
            alert("Invitation envoyée !");
            
            // Mettre à jour les invitations de l'utilisateur cible (récepteur)
            updateReceivedRequests();
        }
    }, "json");
}

function updateReceivedRequests() {
    $.get("", { get_received_requests: true }, function(response) {
        if (response.status === "success") {
            $("#requests").html('');
            response.requests.forEach(request => {
                $("#requests").append(`
                    <div class="card" id="request-${request.id}">
                        <span>${request.prenom} ${request.nom}</span>
                        <button class="btn-accept" onclick="acceptRequest(${request.id})">Accepter</button>
                        <button class="btn-delete" onclick="deleteRequest(${request.id})">Supprimer</button>
                    </div>
                `);
            });
        }
    }, "json");
}

function acceptRequest(request_id) {
    $.post("", { accept_request: true, request_id: request_id }, function(response) {
        if (response.status === "success") {
            $("#request-" + request_id).remove();
            alert("Invitation acceptée !");
        }
    }, "json");
}

function deleteRequest(request_id) {
    $.post("", { delete_request: true, request_id: request_id }, function(response) {
        if (response.status === "success") {
            $("#request-" + request_id).remove();
            alert("Invitation supprimée !");
        }
    }, "json");
}
</script>

</body>
</html>
