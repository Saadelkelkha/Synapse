<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <style>
        .chatbot {
            position: fixed;
            bottom: 20px;
            right: 20px;
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

        .chatbot-header {
            background-color: #2B2757;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .chatbot-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px;
        }

        .chatbot-footer {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .chatbot-footer input {
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

        .bot-message {
            background-color: #e2e2e2;
            align-self: flex-start;
        }

        /* Bouton pour afficher/masquer le chatbot */
        #toggleChatbot {
            position: fixed;
            bottom: 20px;
            right: 330px;
            padding: 10px 15px;
            background-color: #2B2757;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #toggleChatbot:hover {
            background-color: #1F1B4D;
        }
    </style>
</head>
<body>

<!-- Bouton pour afficher/masquer le chatbot -->
<button id="toggleChatbot">Ouvrir le Chatbot</button>

<!-- Chatbot intégré -->
<div id="chatbot" class="chatbot">
    <div class="chatbot-header">
        <h5>Chatbot</h5>
    </div>
    <div class="chatbot-body">
        <div id="chatMessages" class="chat-messages"></div>
    </div>
    <div class="chatbot-footer">
        <input type="text" id="userMessage" placeholder="Écrivez un message..." onkeypress="handleKeyPress(event)">
        <button id="sendMessage" onclick="sendMessage()">Envoyer</button>
    </div>
</div>

<script>
document.getElementById('toggleChatbot').addEventListener('click', function() {
    var chatbot = document.getElementById('chatbot');
    chatbot.style.display = (chatbot.style.display === 'none' || chatbot.style.display === '') ? 'flex' : 'none';
});

function sendMessage() {
    var userMessage = document.getElementById('userMessage').value;
    if (userMessage.trim() !== '') {
        addMessage('user', userMessage);
        document.getElementById('userMessage').value = '';

        // Envoi du message au serveur via AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'vue/chatbot.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    addMessage('bot', response.response);
                } catch (e) {
                    addMessage('bot', "Erreur de réponse du serveur.");
                }
            } else {
                addMessage('bot', "Erreur de communication avec le serveur.");
            }
        };
        xhr.onerror = function() {
            addMessage('bot', "Problème de connexion !");
        };
        xhr.send('userMessage=' + encodeURIComponent(userMessage));
    }
}

function addMessage(sender, message) {
    var messageContainer = document.createElement('div');
    messageContainer.classList.add(sender === 'user' ? 'user-message' : 'bot-message');
    messageContainer.innerText = message;
    document.getElementById('chatMessages').appendChild(messageContainer);
    document.getElementById('chatMessages').scrollTop = document.getElementById('chatMessages').scrollHeight;
}

function handleKeyPress(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
}
</script>

</body>
</html>
