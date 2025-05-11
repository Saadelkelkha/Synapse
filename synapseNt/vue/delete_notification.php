<?php

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

if (!isset($_SESSION['id_user'])) {
    die("Non autorisé !");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_notification_id'])) {
    $id_user = $_SESSION['id_user'];
    $notif_id = $_POST['delete_notification_id'];
    $stmt = $conn->prepare("DELETE FROM notification WHERE id_notification = ? AND id_user = ?");
    $stmt->execute([$notif_id, $id_user]);
}

// Rediriger vers la page d'origine avec indication de suppression
header("Location: home.php?deleted=1");
exit;
