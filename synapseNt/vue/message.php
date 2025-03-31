<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Chatbot</title>
    <style>
        .chat {
            position: fixed;
            bottom: 20px;
            right: 80px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            display: none; /* Caché par défaut */
            flex-direction: column;
            height: 400px;
            font-family: Arial, sans-serif;
            z-index: 400;
        }

        .chat-header {
            background-color: #2B2757;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .chat-body {
            flex-grow: 1;
            padding: 10px;
            overflow-y: auto;  /* ✅ Allows scrolling */
            max-height: 300px; /* ✅ Adjust as needed */
            display: flex;
            flex-direction: column;
        }


        .chat-footer {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .chat-footer input {
            flex-grow: 1;
            margin-right: 10px;
            padding: 5px;
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            padding: 10px;
        }

        .user-message, .bot-message {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            max-width: 80%;
        }

        .user-message {
            background-color: #f1f1f1;
            align-self: flex-end;
        }

        .chat-message {
            align-self: flex-start;
            cursor: pointer;
        }

        .chat-message div {
            width: 240px;
        }

        .chat-message:hover{
            background-color: #e2e2e2;
        }

        .chat-name {
            display: block;
            width: 140px; 
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-msg{
            display: block;
            width: 190px; 
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Bouton pour afficher/masquer le chatbot */
        #toggleChat {
            position: fixed;
            bottom: 75px;
            right: 20px;
            padding: 10px 15px;
            background-color: #2B2757;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #toggleChat:hover {
            background-color: #1F1B4D;
        }

        @media screen and (max-width: 550px){
            .chat{
                width:250px;
            }

            .chat-name {
                display: block;
                width: 90px; 
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .chat-msg{
                display: block;
                width: 140px; 
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }

        .chat-div {
            border-radius: 7px;
            flex-grow: 1;
            padding: 10px;
            overflow-y: auto;
            background: #eee;
            height: 220px;
            display: flex;
            flex-direction: column;
            scrollbar-width: none; /* For Firefox */
            -ms-overflow-style: none; /* For Internet Explorer and Edge */
        }

        .chat-div::-webkit-scrollbar {
            display: none; /* For Chrome, Safari, and Opera */
        }

        .message {
            max-width: 70%;
            padding: 8px 12px;
            border-radius: 20px;
            margin-bottom: 8px;
            font-size: 14px;
            display: inline-block;
        }

        .sent {
            background: black;
            color: white;
            align-self: flex-end;
            text-align: right;
            border-radius: 15px 15px 0 15px;
            padding: 10px;
        }

        .received {
            background: white;
            color: black;
            align-self: flex-start;
            text-align: left;
            border-radius: 15px 15px 15px 0;
            padding: 10px;
        }

        .no-messages {
            text-align: center;
            color: gray;
            font-size: 14px;
            margin-top: 20px;
        }

    </style>
</head>
<body>

<!-- Bouton pour afficher/masquer le chatbot -->
<button id="toggleChat" style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px;"><i class="fas fa-comments"></i></button>

<!-- Chatbot intégré -->
<div id="chat" class="chat">
    <div class="chat-header">
        <h5>Chat</h5>
    </div>
    <div class="chat-body">
        
    </div>
    <div class="chat-footer d-flex">
        
    </div>
</div>

<script>
document.getElementById('toggleChat').addEventListener('click', function () {
    var chat = document.getElementById('chat');

    $.ajax({
        url: 'index.php?action=selectmessages',
        type: 'POST',
        data: {
            id_user: <?= $id ?>
        },
        success: function (res) {
            var chatBody = document.querySelector('.chat-body');
            chatBody.innerHTML = '';
            if (res.data && res.data.length > 0) {
                res.data.forEach(function (message) {
                    var messageElement = document.createElement('div');
                    messageElement.onclick = function() {
                        show_chat(message.id_amie);
                    };
                    messageElement.style.width = '100%';
                    messageElement.classList.add('chat-message');
                    messageElement.classList.add('d-flex')
                    messageElement.classList.add('p-2')
                    

                    var profileImage = document.createElement('img');
                    profileImage.src = message.photo_profil || 'default-profile.png'; // Default image if null
                    profileImage.alt = 'Profile';
                    profileImage.style.width = '50px';
                    profileImage.style.height = '50px';
                    profileImage.style.borderRadius = '50%';
                    profileImage.style.marginRight = '10px';

                    var messageContent = document.createElement('div');
                    var messageDate = new Date(message.date_envoi);
                    var now = new Date();
                    var timeDifference = now - messageDate;
                    var oneDay = 24 * 60 * 60 * 1000;

                    var displayDate;
                    if (timeDifference < oneDay && messageDate.getDate() === now.getDate()) {
                        displayDate = messageDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    } else if (timeDifference < 2 * oneDay && messageDate.getDate() === now.getDate() - 1) {
                        displayDate = "Yesterday";
                    } else {
                        displayDate = messageDate.toLocaleDateString();
                    }

                    messageContent.innerHTML = `
                        <div class='d-flex justify-content-between w-100'>
                            <strong class='chat-name'>${message.prenom} ${message.nom}</strong>
                            ${message.message ? `<small style="align-self: center;">${displayDate}</small>` : ""}
                        </div>
                        <p class='chat-msg'>${message.message ? message.message : "No messages yet"}</p>
                    `;

                    messageElement.appendChild(profileImage);
                    messageElement.appendChild(messageContent);
                    chatBody.appendChild(messageElement);
                });
            }
        }
    });

    var chatbot = document.getElementById('chatbot');
    if (chatbot.style.display === 'flex') {
        chatbot.style.display = 'none';
    }
    chat.style.display = (chat.style.display === 'none' || chat.style.display === '') ? 'flex' : 'none';
});

function toggleChat(){
    var chat = document.getElementById('chat');

    $.ajax({
        url: 'index.php?action=selectmessages',
        type: 'POST',
        data: {
            id_user: <?= $id ?>
        },
        success: function (res) {
            var chatBody = document.querySelector('.chat-body');
            chatBody.innerHTML = '';
            if (res.data && res.data.length > 0) {
                res.data.forEach(function (message) {
                    var messageElement = document.createElement('div');
                    messageElement.onclick = function() {
                        show_chat(message.id_amie);
                    };
                    messageElement.style.width = '100%';
                    messageElement.classList.add('chat-message');
                    messageElement.classList.add('d-flex')
                    messageElement.classList.add('p-2')
                    

                    var profileImage = document.createElement('img');
                    profileImage.src = message.photo_profil || 'default-profile.png'; // Default image if null
                    profileImage.alt = 'Profile';
                    profileImage.style.width = '50px';
                    profileImage.style.height = '50px';
                    profileImage.style.borderRadius = '50%';
                    profileImage.style.marginRight = '10px';

                    var messageContent = document.createElement('div');
                    var messageDate = new Date(message.date_envoi);
                    var now = new Date();
                    var timeDifference = now - messageDate;
                    var oneDay = 24 * 60 * 60 * 1000;

                    var displayDate;
                    if (timeDifference < oneDay && messageDate.getDate() === now.getDate()) {
                        displayDate = messageDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    } else if (timeDifference < 2 * oneDay && messageDate.getDate() === now.getDate() - 1) {
                        displayDate = "Yesterday";
                    } else {
                        displayDate = messageDate.toLocaleDateString();
                    }

                    messageContent.innerHTML = `
                        <div class='d-flex justify-content-between w-100'>
                            <strong class='chat-name'>${message.prenom} ${message.nom}</strong>
                            ${message.message ? `<small style="align-self: center;">${displayDate}</small>` : ""}
                        </div>
                        <p class='chat-msg'>${message.message ? message.message : "No messages yet"}</p>
                    `;

                    messageElement.appendChild(profileImage);
                    messageElement.appendChild(messageContent);
                    chatBody.appendChild(messageElement);
                });
            }
        }
    });

    var footer = document.querySelector('.chat-footer');
    footer.innerHTML = ``;
}

function show_chat(id_amie) {
    $.ajax({
        url: 'index.php?action=selectmessagesamie',
        type: 'POST',
        data: {
            id_user: <?= $id ?>,
            id_amie: id_amie
        },
        success: function (res) {
            var chatBody = document.querySelector('.chat-body');
            chatBody.innerHTML = ''; // Clear previous messages

            if (res.data && res.data.length > 0) {
                // Add a div at the top with photo_profil, prenom, and nom
                var chat_div = document.createElement('div');
                chat_div.classList.add('chat-div');

                var userInfo = document.createElement('div');

                var profileImage = document.createElement('img');
                profileImage.src = res.amieinfo.photo_profil || 'default-profile.png'; // Default image if null
                profileImage.alt = 'Profile';
                profileImage.style.width = '40px';
                profileImage.style.height = '40px';
                profileImage.style.borderRadius = '50%';
                profileImage.style.marginRight = '10px';

                var userName = document.createElement('div');
                
                userInfo.style.display = 'flex';
                userInfo.style.alignItems = 'center';
                userInfo.style.marginBottom = '10px';
                userInfo.style.backgroundColor = 'white';
                userName.innerHTML = `<strong>${res.amieinfo.prenom} ${res.amieinfo.nom}</strong>`;
                
                var backbtn = document.createElement('i');
                backbtn.className = "fas fa-arrow-left";
                backbtn.style.cursor = 'pointer';
                backbtn.style.display = 'flex';
                backbtn.style.alignItems = 'center';
                backbtn.style.justifyContent = 'center'; // Center horizontally
                backbtn.style.height = '100%'; // Ensure it takes full height
                backbtn.onclick = function() {
                    toggleChat(); // Simulate toggle to go back
                };

                userInfo.appendChild(backbtn);
                userInfo.appendChild(profileImage);
                userInfo.appendChild(userName);

                chatBody.appendChild(userInfo);
                
                let lastMessageDate = null;

                res.data.forEach(function (message) {
                    var messageDate = new Date(message.date_envoi);
                    var formattedDate = messageDate.toLocaleDateString();
                    
                    // Add date separator if the message is from a new day
                    if (!lastMessageDate || lastMessageDate !== formattedDate) {
                        var dateSeparator = document.createElement('div');
                        dateSeparator.style.textAlign = 'center';
                        dateSeparator.style.margin = '10px 0';
                        dateSeparator.style.color = 'gray';
                        dateSeparator.style.fontSize = '12px';
                        dateSeparator.textContent = formattedDate;
                        chat_div.appendChild(dateSeparator);
                        lastMessageDate = formattedDate;
                    }

                    var messageElement = document.createElement('div');
                    messageElement.classList.add('message');

                    // Check if the user sent or received the message
                    if (message.id_expediteur == <?= $id ?>) {
                        messageElement.classList.add('sent'); // Sent messages
                    } else {
                        messageElement.classList.add('received'); // Received messages
                    }

                    // Format the message time
                    var formattedTime = messageDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                    // Display message content with time on the same line
                    messageElement.innerHTML = `
                        <span style="word-wrap: break-word;overflow-wrap: break-word;word-break: break-word;white-space: normal"> ${message.message}</span>
                        <small style="font-size: 10px; color: gray; margin-left: 10px;">${formattedTime}</small>
                    `;

                    chat_div.appendChild(messageElement);
                    chatBody.appendChild(chat_div);
                });

                chat_div.scrollTop = chat_div.scrollHeight;

                var footer = document.querySelector('.chat-footer');
                footer.innerHTML = `
                    <input type="text" id="userMessage" class="form-control me-2" placeholder="Écrivez un message..." style="width: 100%;">
                    <button id="sendMessage" class="btn btn-primary" onclick="sendMessage(${id_amie})"><i class="fas fa-paper-plane"></i></button>
                `;
            }
        }
    });
};

function sendMessage(id_amie) {
    // Dynamically fetch the input field to ensure it exists
    var messageInput = document.querySelector('.chat-footer #userMessage');
    var message = messageInput ? messageInput.value.trim() : '';

    if (message) {
        $.ajax({
            url: 'index.php?action=sendMessage',
            type: 'POST',
            data: {
                id_destinataire: id_amie,
                message: message
            },
            success: function (res) {
                if (res.status === 'success') {
                    // Clear the input field after sending the message
                    messageInput.value = '';

                    // Optionally, refresh the chat to show the new message
                    show_chat(id_amie);
                } else {
                    alert('Erreur lors de l\'envoi du message.');
                }
            }
        });
    } else {
        alert("Le champ de message est vide.");
    }
}

</script>
</body>
</html>