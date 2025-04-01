<?php
require_once 'model/admin.php';
require_once 'model/users.php';
require_once 'model/group.php';
require_once 'model/home.php';
require_once 'model/message.php';

function selectmessages($id_user) {
    $amiemsg = select_messages($id_user); // Fetch messages

    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'data' => $amiemsg  // Include messages in JSON response
    ]);
}

function selectmessagesamie($id_amie,$id_user) {
    $amiemsg = select_messagesamie($id_amie,$id_user); // Fetch messages
    $amieinfo = select_amieinfo($id_amie);

    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'data' => $amiemsg ,
        'amieinfo' => $amieinfo
    ]);
}

function sendMessage($id_amie,$message){
    $id_user = $_SESSION['id_user'];
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); // Sanitize message input

    send_message($id_user,$id_amie,$message);
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => 'Message sent successfully'
    ]);

}

function sendAudio($id_amie, $finalTime){
    $id_user = $_SESSION['id_user'];

    $groupDir = $_SERVER['DOCUMENT_ROOT'] . '/Synapse/synapseNt/img/messages/' . $id_user . '/'. $id_amie . '/';
    
    if (!is_dir($groupDir)) {
        mkdir($groupDir, 0777, true);
    }
    // Traitement de l'image
    $files = glob($groupDir . '/*'); 
    $countpostgroupe = count($files) + 1; 
    //$_SERVER['DOCUMENT_ROOT'] houwa repertoire racine
    $file_name = $countpostgroupe . "_" . basename($_FILES["audio"]["name"]);
    $target_file  = $groupDir . $file_name;
    //kat7t f database
    $imageUrl = 'img/messages/' . $id_user . '/'. $id_amie . '/'. $file_name;
    // Déplacer l'image dans le répertoire "uploads"
    move_uploaded_file($_FILES["audio"]["tmp_name"], $target_file);

    send_audio($id_user,$id_amie,$imageUrl,$finalTime);
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => 'Message sent successfully'
    ]);

}

function vue($id_message){
    vue_message($id_message);
    
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => 'Message marked as read'
    ]);
}

?>