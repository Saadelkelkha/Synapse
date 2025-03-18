<?php
// Vérifier si la requête est AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userMessage'])) {
    header('Content-Type: application/json'); // Indiquer que la réponse est en JSON
    $userMessage = trim($_POST['userMessage']);
    $botResponse = "Je ne comprends pas encore bien. Essayez autre chose !";

    // Réponses simples
    if (stripos($userMessage, 'bonjour') !== false || stripos($userMessage, 'salut') !== false) {
        $botResponse = "Bonjour ! Comment puis-je vous aider ?";
    } elseif (stripos($userMessage, 'aide') !== false || stripos($userMessage, 'help') !== false) {
        $botResponse = "Je peux vous aider avec la modification de votre post.";
    } elseif (stripos($userMessage, 'modifier') !== false || stripos($userMessage, 'changer') !== false) {
        $botResponse = "Pour modifier un post, changez le texte et cliquez sur 'Modifier'.";
    } elseif (stripos($userMessage, 'merci') !== false || stripos($userMessage, 'shokran') !== false) {
        $botResponse = "De rien ! N'hésitez pas si vous avez d'autres questions.";
    } elseif (stripos($userMessage, 'au revoir') !== false || stripos($userMessage, 'bye') !== false) {
        $botResponse = "Au revoir, à bientôt !";
    } elseif (stripos($userMessage, 'comment ça va') !== false || stripos($userMessage, 'kif dayr') !== false || stripos($userMessage, 'كيف حالك') !== false) {
        $botResponse = "Je vais bien, merci ! Et vous ?";
    } elseif (stripos($userMessage, 'oui') !== false || stripos($userMessage, 'na3am') !== false) {
        $botResponse = "D'accord ! Comment puis-je vous aider davantage ?";
    } elseif (stripos($userMessage, 'non') !== false || stripos($userMessage, 'la') !== false) {
        $botResponse = "D'accord, n'hésitez pas à poser une autre question.";
    } elseif (stripos($userMessage, 'quel est ton nom') !== false || stripos($userMessage, 'chno smitik') !== false || stripos($userMessage, 'ما اسمك') !== false) {
        $botResponse = "Je suis un bot, je n'ai pas de nom, mais vous pouvez m'appeler comme vous voulez.";
    } elseif (stripos($userMessage, 'quoi de neuf') !== false || stripos($userMessage, 'chno jdid') !== false || stripos($userMessage, 'ما الجديد') !== false) {
        $botResponse = "Rien de neuf pour le moment, mais je suis toujours là pour vous aider.";
    } elseif (stripos($userMessage, 'combien ça coûte') !== false || stripos($userMessage, 'ch7al tsawer') !== false || stripos($userMessage, 'كم الثمن') !== false) {
        $botResponse = "Cela dépend du service. Pouvez-vous préciser votre demande ?";
    } elseif (stripos($userMessage, 'oublier') !== false || stripos($userMessage, 'نسيت') !== false || stripos($userMessage, 'نسيت حاجة') !== false) {
        $botResponse = "D'accord, pas de problème. Si vous vous souvenez de quelque chose, faites-le moi savoir.";
    } elseif (stripos($userMessage, 'est-ce que tu sais') !== false || stripos($userMessage, 'wash 3rf') !== false || stripos($userMessage, 'هل تعرف') !== false) {
        $botResponse = "Je peux essayer de vous aider avec ça. De quoi s'agit-il ?";
    } elseif (stripos($userMessage, 'où') !== false || stripos($userMessage, 'fin') !== false || stripos($userMessage, 'فين') !== false) {
        $botResponse = "Pouvez-vous préciser l'endroit ? Je suis ici pour vous aider.";
    } elseif (stripos($userMessage, 'bonjour tout le monde') !== false || stripos($userMessage, 'salut tout le monde') !== false) {
        $botResponse = "Salut à tous ! Comment puis-je vous assister ?";
    }

    // Réponse par défaut si aucun cas n'est détecté
    echo json_encode(["response" => $botResponse]);
    exit;
}
?>
