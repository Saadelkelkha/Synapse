<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste d'amis</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .fixed-profile {
        position: sticky;
        top: 100px;
        height: fit-content;
        max-height: 90vh;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        text-align: center;
    }

    .close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 20px;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .card1 {
        display: flex;
        flex-direction: row;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        padding: 0;
    }

    .container {
        margin: auto;
    }

    .card {
        padding: 10px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    button {
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }

    .btn-send {
        background-color: blue;
        color: white;
    }

    .btn-accept {
        background-color: green;
        color: white;
    }

    .btn-delete {
        background-color: red;
        color: white;
    }

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
        display: block;
        margin-top: 60px;
        padding: 0;
    }

    .profile-container {
        position: relative;
        margin-top: -60px;
        text-align: center;
        display: flex;
        flex-direction: column;
        width: 100%;
        padding: 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .profile-img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        border: 4px solid white;
        background-color: white;
        object-fit: cover;
        margin-left: 20px;
        padding: 0;
    }

    .text-profil-after-pic {
        margin-left: 50px;
    }

    .profile-info {
        margin: 0;
        padding: 0;
    }

    .profile-info h3 {
        font-size: 20px;
        font-weight: bold;
        margin-top: 5px;
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

    .image-phpstyle {
        background-color: red;
        display: flex;
        flex-direction: row;
    }

    .navhome1 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0;
    }

    .search-bar {
        border: 1px solid #ccc;
        border-radius: 20px;
        padding: 8px 12px;
        outline: none;
        width: 40vw;
    }

    .rechercher-nom {
        background-color: #2B2757;
        border: none;
        border-radius: 8px;
        padding: 8px 12px;
        color: #fff;
    }

    .navhome1_right {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cyndy {
        font-weight: bold;
        color: #000;
    }

    .navhome1_profile {
        height: 40px;
        width: 40px;
        border-radius: 50%;
        object-fit: cover;
    }
    .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 3%;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
}

.navbar-left .logo {
    height: 50px;
}

.search-form {
    display: flex;
    flex: 1;
    max-width: 500px;
    margin: 0 20px;
}

.search-input {
    width: 100%;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 16px;
}

.search-button {
    background-color: #2B2757;
    border: none;
    width: 40px;
    height: 40px;
    margin-left: 10px;
    border-radius: 8px;
    background-image: url('search-icon.svg'); /* ou une icône */
    background-size: 20px;
    background-repeat: no-repeat;
    background-position: center;
    cursor: pointer;
}

.navbar-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-name {
    font-weight: bold;
    color: #000;
}

.profile-pic {
    height: 40px;
    width: 40px;
    border-radius: 50%;
    object-fit: cover;
}

</style>

</head>
<body>



</body>
</html>



<?php


$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// ID de l'utilisateur connecté
$id_user = $_SESSION['id_user'] ?? 1;

// Fonction pour vérifier si deux utilisateurs sont amis
function isFriend($pdo, $id_user, $receiver_id) {
    $stmt = $pdo->prepare("SELECT * FROM followers WHERE (id_user = ? AND id_amie = ?)");
    $stmt->execute([$id_user, $receiver_id]);
    return $stmt->rowCount() > 0;
}

// Fonction pour envoyer une notification
function sendNotification($pdo, $receiver_id, $sender_id, $message) {
    $stmt = $pdo->prepare("INSERT INTO notification (id_user, id_envoyeur, message, est_lu, date_notification) VALUES (?, ?, ?, 0, NOW())");
    $stmt->execute([$receiver_id, $sender_id, $message]);
}

// Envoi d'une invitation
if (isset($_POST['send_request'])) {
    $receiver_id = $_POST['receiver_id'];

    // Vérifier si l'utilisateur est déjà un ami
    if (isFriend($pdo, $id_user, $receiver_id)) {
        echo json_encode(["status" => "error", "message" => "Vous êtes déjà amis avec cet utilisateur."]);
        exit;
    }

    // Vérifier si une invitation existe déjà
    $stmt = $pdo->prepare("SELECT * FROM friend_requests WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)");
    $stmt->execute([$id_user, $receiver_id, $receiver_id, $id_user]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "Une demande d'ami est déjà en attente."]);
        exit;
    }

    // Envoyer la demande d'ami
    $stmt = $pdo->prepare("INSERT INTO friend_requests (sender_id, receiver_id) VALUES (?, ?)");
    $stmt->execute([$id_user, $receiver_id]);

    // Envoyer une notification au destinataire
    sendNotification($pdo, $receiver_id, $id_user, "Vous avez reçu une nouvelle demande d'ami.");

    $user = $pdo->prepare("SELECT prenom, nom FROM user WHERE id_user = ?");
    $user->execute([$id_user]);
    $userInfo = $user->fetch(PDO::FETCH_ASSOC);

    echo json_encode(["status" => "success", "id" => $pdo->lastInsertId(), "prenom" => $userInfo['prenom'], "nom" => $userInfo['nom']]);
    exit;
}

// Accepter une invitation
if (isset($_POST['accept_request'])) {
    header('Content-Type: application/json'); // Forcer la réponse JSON
    $request_id = $_POST['request_id'];
    
    try {
        // Vérifier si la demande existe
        $stmt = $pdo->prepare("SELECT sender_id FROM friend_requests WHERE id = ?");
        $stmt->execute([$request_id]);
        $sender = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($sender) {
            $sender_id = $sender['sender_id'];

            // Ajouter l'amitié
            $stmt = $pdo->prepare("INSERT INTO friends (user_id_1, user_id_2) VALUES (?, ?)");
            $stmt->execute([$id_user, $sender_id]);

            // Supprimer la demande
            $stmt = $pdo->prepare("DELETE FROM friend_requests WHERE id = ?");
            $stmt->execute([$request_id]);

            // Envoyer une notification aux deux utilisateurs
            sendNotification($pdo, $sender_id, $id_user, "Votre demande d'ami a été acceptée !");
            sendNotification($pdo, $id_user, $sender_id, "Vous êtes maintenant amis avec un nouvel utilisateur.");

            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Demande introuvable"]);
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
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

?>



<body>


<div class="container">
<?php require_once 'vue/layout/navhome1.php'; ?>

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
             
            
              <p align="start"><?php echo htmlspecialchars($user['bio']); ?></p>
            <?php  
                  // Récupérer le nombre d'amis
                    $stmt = $pdo->prepare("SELECT COUNT(*)   AS friend_count FROM followers WHERE id_user = ?");
                    $stmt->execute([$id_user]);
                    $friendCount = $stmt->fetch(PDO::FETCH_ASSOC)['friend_count'];
            ?>
              <p align="start"><?=  $friendCount ?> ami(s)</p>
              </div>
               
            </div>
          
      
      
        
                  
<div class="container mt-2">
<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
        <ul class="navbar-nav flex-row gap-3">
            <li class="nav-item">
                <a class="nav-link active" href="index.php?action=afficherProfil">Publications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=afficherAmies">Ami(e)s</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=afficherPhotos">Multimédia</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container mt-4">
    

    <!-- Barre de recherche et options -->
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold" align="start">Ami(e)s</h4>
        <input type="text" class="form-control w-25" placeholder="🔍 Rechercher">
       
    </div>

    <!-- Onglets -->
    <!-- <div class="d-flex border-bottom mb-3"> -->
        <!-- <a href="#" class="me-3 pb-2 active-tab text-decoration-none text-dark">Tous les amis</a> -->
    <!-- </div> -->

    <!-- Liste d'amis -->
    <div class="friend-card">
        
    <?php
$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");

// Récupérer l'ID de l'utilisateur connecté
$id_user = $_SESSION['id_user']; 

// Préparer la requête SQL pour récupérer les amis
$sql = "SELECT user.*
        FROM friends
        JOIN user ON user.id_user = 
            CASE 
                WHEN friends.user_id_1 = :id_user THEN friends.user_id_2 
                ELSE friends.user_id_1 
            END
        WHERE :id_user IN (friends.user_id_1, friends.user_id_2)";

$sqlState = $pdo->prepare($sql);
$sqlState->execute(['id_user' => $id_user]);
$amis = $sqlState->fetchAll(PDO::FETCH_OBJ);


foreach($amis as $ami){ ?> 
    <form method="POST" action="index.php?action=utilisateurs">
        <input type="hidden" name="id_user" value="<?php echo $ami->id_user; ?>">
        <button type="submit" class="btn p-0">
            <p><?php echo htmlspecialchars($ami->prenom) . " " . htmlspecialchars($ami->nom); ?></p>
        </button>
    </form>
    <?php } ?>
            
            </h6>
            <!-- <small class="text-muted">Marrakech</small> -->
        </div>
        <div class="ellipsis">⋯</div>
    </div>
</div>
<br><br> <br>
<!-- Invitations reçues -->
<!-- <h2 class="fw-bold" align="start">Liste des utilisateurs</h2>
<?php foreach ($users as $user): ?>
    <?php if (!isFriend($pdo, $id_user, $user['id_user'])): ?>
        <div class="card card1">
            <div class="h">
                <img height="50px" src="<?php echo $user['photo_profil']; ?>" alt="Profile Picture">
                <input type="text" name="" id="" value="<?php echo $user['id_user']; ?>">
                <span><a href="index.php?action=utilisateurs&id_user=<?php echo $user['id_user']; ?>"><?= htmlspecialchars($user['nom']. " " . $user['prenom']) ?></a></span>
            </div>
            <div class="k">
                <button class="btn-send" onclick="sendRequest(<?= $user['id_user'] ?>)">Ajouter</button>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?> -->

<!-- Invitations reçues -->
<h2 class="fw-bold" align="start">Invitations reçues</h2>
<div id="requests">
    <?php foreach ($requests as $request): ?>
        <div class="card card1" id="request-<?= $request['id'] ?>">
            <div class="nom-prenom-photo1">
                <img id="yarbiikhdm" height="50px" src="<?php echo $user['photo_profil']; ?>" alt="Profile Picture">       
                <span><?= htmlspecialchars($request['prenom'] . " " . $request['nom']) ?></span>
            </div>
            <div class="btn-ajouter-supprimer">
                <button class="btn-accept" onclick="acceptRequest(<?= $request['id'] ?>)">Accepter</button>
                <button class="btn-delete" onclick="deleteRequest(<?= $request['id'] ?>)">Supprimer</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<br><br>

<!-- Modale de succès -->
<div id="successModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h2>Invitation acceptée avec succès !</h2>
        <button onclick=closeModal()>jj</button>
    </div>
</div>
<div id="supprimersuccessModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h2>Invitation supprimer avec succès !</h2>
        <button onclick=closeModal()>jj</button>
    </div>
</div>


<script>
function sendRequest(receiver_id) {
    $.post("", { send_request: true, receiver_id: receiver_id }, function(response) {
        console.log(response);
        if (response.status === "success") {
            alert("Invitation envoyée !");
        } else {
            alert(response.message); // Afficher le message d'erreur
        }
    }, "json");
}

let requestIdToRemove = null;  // Variable globale pour garder l'ID de la demande à supprimer

// Fonction pour accepter une demande d'ami
// Exemple pour réafficher l'image après une action
function acceptRequest(request_id) {
    $.ajax({
        url: "", // L'URL où vous envoyez la requête (généralement le même fichier PHP)
        type: "POST",
        data: { accept_request: true, request_id: request_id },
        dataType: "json", // Important pour forcer JSON
        success: function(response) {
            if (response.status === "success") {
                // Réafficher l'image
                var imageElement = document.getElementById("yarbiikhdm");
                if (imageElement) {
                    imageElement.style.display = "block"; // Réafficher l'image
                }
                // Afficher la modale de succès
                showModal();
            } else {
                // Si l'acceptation échoue, afficher un message d'erreur dans la modale
                showModal();
            }
        },
        error: function() {
            // En cas d'erreur, afficher la modale également
            showModal();
        }
    });
}


// Affiche la modale
function showModal() {
    document.getElementById("successModal").style.display = "block";
}
function showModalsupprimer() {
    document.getElementById("supprimersuccessModal").style.display = "block";
}







// Fonction pour supprimer une demande d'ami
function deleteRequest(request_id) {
    $.ajax({
        url: "", // L'URL où vous envoyez la requête de suppression
        type: "POST",
        data: { delete_request: true, request_id: request_id },
        dataType: "json",
        success: function(response) {
            if (response.status === "success") {
                // Supprimer la demande de l'affichage
                showModalsupprimer();
            } else {
                // Si l'acceptation échoue, afficher un message d'erreur dans la modale
                showModalsupprimer();
            }
        },
        error: function() {
            // En cas d'erreur, afficher la modale également
            showModalsupprimer();
        }
    });
}



// Ferme la modale
function closeModal() {
    document.getElementById("successModal").style.display = "none";
    location.reload();
   
}
</script>

</body>
</html>
