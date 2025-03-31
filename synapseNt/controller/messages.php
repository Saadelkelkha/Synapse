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

?>