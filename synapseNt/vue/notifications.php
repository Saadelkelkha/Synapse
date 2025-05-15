<?php
ob_start();
$host = 'localhost';
$dbname = 'synapse';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion: " . $e->getMessage());
}

// Vérification de connexion
if (!isset($_SESSION['id_user'])) {
    die("Veuillez vous connecter !");
}

$id_user = $_SESSION['id_user'];

// Suppression d'une notification si demandé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_notification_id'])) {
    $notif_id = $_POST['delete_notification_id'];
    $sql = "DELETE FROM notification WHERE id_notification = ? AND id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$notif_id, $id_user]);
    echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "';</script>";
    exit;
}

// Récupérer les notifications avec les informations utilisateur
$sql = "
SELECT n.id_notification, n.message, n.date_notification, u.prenom, u.nom, u.photo_profil 
FROM notification n 
JOIN user u ON n.id_envoyeur = u.id_user 
WHERE n.id_user = ? 
ORDER BY n.date_notification DESC
";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_user]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <style>
        .btn12 {
            position: relative;
            background-color: white;
            color: white;
            font-size: 15px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            outline: none;
            padding: 0;
           
            display: flex;
            align-items: center;
        }

        /* Ajoutez cette règle pour le survol du bouton */
/* Changer la couleur du texte et de l'icône */
/* Effet sur le bouton */
button.btn12:hover {
    background-color: white; /* Changer la couleur de fond */
}

/* Changer la couleur du texte du h3 */
button.btn12:hover h3 {
    color:  #102770 !important; /* Couleur du texte du h3 au survol */
}

/* Changer la couleur de l'icône */
button.btn12:hover i {
    color: #102770 !important; /* Couleur de l'icône au survol */
}





        .btn-content {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .btn12 h3 {
            margin: 0;
            font-size: 15px;
        }

        .notification-count {
            background-color: red;
            color: white;
            font-size: 14px;
            padding: 3px 8px;
            border-radius: 50%;
            position: absolute;
            top: -5px;
            right: -25px;
        }

       #notificationList {
    display: none;
    border: 1px solid #ccc;
    padding: 10px;
    width: 300px;
    max-height: 300px; /* Hauteur max visible */
    overflow-y: auto;  /* Barre de défilement verticale si nécessaire */
    background: white;
    position: absolute;
    z-index: 999;
    scrollbar-width: none; /* For Firefox */
            -ms-overflow-style: none; /* For Internet Explorer and Edge */
}


        .notif-item {
            border-bottom: 1px solid #eee;
            padding: 5px;
            
        }

        .notif-item form {
            display: inline;
        }

        .notif-item button {
            background: red;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 2px 6px;
            cursor: pointer;
            font-size: 12px;
        }

        .notif-item button:hover {
            background: darkred;
        }

        .notif-user-photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        @media (max-width: 900px) {
    .btn12 h3 {
        display: none; /* Masquer le texte */
    }


}
    </style>
</head>

<!-- Bouton Notifications -->
<button class="btn12" id="notificationButton" onclick="toggleNotifications()">
    <div class="btn-content">
        <i class="navhome2_sidebar_logo uil uil-bell"></i>
        <h3>Notifications</h3>
    </div>
</button>

<!-- Liste des Notifications -->
<div id="notificationList">
    <?php if (count($notifications) > 0): ?>
        <?php foreach ($notifications as $notif): ?>
            <div class="notif-item">
                <h2>Notification</h2>
                <div class="notif-user d-flex">
                    <img src="<?php echo $notif['photo_profil'] ; ?>" alt="User Photo" class="notif-user-photo">
                    <div class="ms-2">
                        <span style="color: black;"><?php echo htmlspecialchars($notif['prenom']) . ' ' . htmlspecialchars($notif['nom']); ?></span>
                        <strong style="color: black;"><?php echo htmlspecialchars($notif['message']); ?></strong><br>
                        <?php
                            $notifDate = strtotime($notif['date_notification']);
                            $currentDate = time();
                            $diff = $currentDate - $notifDate;

                            if ($diff > 2592000) { // More than 1 month (30 days)
                                echo '<small>' . date('d/m/Y H:i', $notifDate) . '</small><br>';
                            } elseif ($diff > 604800) { // More than 1 week (7 days)
                                echo '<small>' . floor($diff / 604800) . 'w</small><br>';
                            } elseif ($diff > 86400) { // More than 1 day
                                echo '<small>' . floor($diff / 86400) . 'd</small><br>';
                            } elseif ($diff > 3600) { // More than 1 hour
                                echo '<small>' . floor($diff / 3600) . 'h</small><br>';
                            } elseif ($diff > 60) { // More than 1 minute
                                echo '<small>' . floor($diff / 60) . 'm</small><br>';
                            } else { // Less than 1 minute
                                echo '<small>' . $diff . 's</small><br>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune notification.</p>
    <?php endif; ?>
</div>

<?php ob_end_flush(); ?>

<script>
// Javascript pour afficher/cacher les notifications
function toggleNotifications() {
    var notifDiv = document.getElementById('notificationList');
    notifDiv.style.display = (notifDiv.style.display === 'none' || notifDiv.style.display === '') ? 'block' : 'none';
}
</script>
