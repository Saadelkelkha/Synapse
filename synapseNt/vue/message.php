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
            align-items: center; 
            justify-content: space-between;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .chat-footer input {
            flex-grow: 1;
            margin-right: 10px;
            padding: 5px;
        }

        .chat-footer .btn {
            background-color: #2B2757;
            color: white;
            border: none;
            cursor: pointer;
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
            width: 150px; 
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
                width: 100px; 
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
            max-width: 85%;
            padding: 8px 12px;
            border-radius: 20px;
            margin-bottom: 8px;
            font-size: 14px;
            display: inline-block;
        }

        .sent {
            background: #2B2757;
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

        .visualizer {
          width: 200px;
          height: 40px;
          display: flex;
          justify-content: center;
          align-items: center;
          gap: 3px;
        }
        
        .bar {
          width: 6px;
          height: 10px;
          background: white;
          border-radius: 3px;
          animation: equalize 1.5s infinite alternate;
        }
        
        @keyframes equalize {
          0% { height: 10px; }
          100% { height: 40px; }
        }
        
        .bar:nth-child(1) { animation-delay: 0.1s; }
        .bar:nth-child(2) { animation-delay: 0.3s; }
        .bar:nth-child(3) { animation-delay: 0.5s; }
        .bar:nth-child(4) { animation-delay: 0.2s; }
        .bar:nth-child(5) { animation-delay: 0.4s; }

          
        .custom-audio-player {
          width: 200px;
          height: 40px;
          filter: invert(0);
        }
        
        
        @media (max-width: 550px) {
            .audio-player-container {
              padding: 0 15px;
            }
            
              .audio-player {
              padding: 15px;
            }
          
            .custom-audio-player {
                width: 150px;
            }
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
    let data1 = [];
    let data2 = [];
    let finalTime;
    let mediaRecorder;
    let audioChunks = [];

document.getElementById('toggleChat').addEventListener('click', function () {
    var chat = document.getElementById('chat');

    $.ajax({
        url: 'index.php?action=selectmessages',
        type: 'POST',
        data: {
            id_user: <?= $id ?>
        },
        success: function (res) {
            data1 = res.data;
            var chatBody = document.querySelector('.chat-body');
            chatBody.innerHTML = '';
            console.log(res);
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

                    if (message.message) {
                        messageContent.innerHTML = `
                            <div class='d-flex justify-content-between w-100'>
                                <strong class='chat-name'>${message.prenom} ${message.nom}</strong>
                                ${message.message ? `<small style="align-self: center;">${displayDate}</small>` : ""}
                            </div>
                            <p class='d-flex align-items-center justify-content-between' >
                                <span class="chat-msg">${message.message}</span>
                                ${message.id_destinataire == <?= $id ?> ? `<span>${message.vue == 0 ? '<i class="fa-solid fa-circle me-1" style="color:#440af7;font-size: 0.8em;"></i>' : ""}<i class="fa-solid fa-check" style='color: ${message.vue == 1 ? "blue" : "grey"};'></i></span>` : ""}
                            </p>
                        `;
                    }else{
                        if (message.audio) {
                            messageContent.innerHTML = `
                                <div class='d-flex justify-content-between w-100'>
                                    <strong class='chat-name'>${message.prenom} ${message.nom}</strong>
                                    ${message.audio ? `<small style="align-self: center;">${displayDate}</small>` : ""}
                                </div>
                                <p class='d-flex align-items-center justify-content-between'>
                                    <span class="chat-msg"><i class="fas fa-microphone pe-1" style="font-size: 1em;"></i>${message.audio_dure}</span>
                                    ${message.id_destinataire == <?= $id ?> ? `<span>${message.vue == 0 ? '<i class="fa-solid fa-circle me-1" style="color:#440af7;font-size: 0.8em;"></i>' : ""}<i class="fa-solid fa-check" style='color: ${message.vue == 1 ? "blue" : "grey"};'></i></span>` : ""}
                                </p>
                            `;
                        } else {
                            messageContent.innerHTML = `
                                <div class='d-flex justify-content-between w-100'>
                                    <strong class='chat-name'>${message.prenom} ${message.nom}</strong>
                                    ${message.message ? `<small style="align-self: center;">${displayDate}</small>` : ""}
                                </div>
                                <p class='chat-msg'>No messages yet</p>
                            `;
                        }
                    }

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
    var footer = document.querySelector('.chat-footer');
    footer.innerHTML = ``;
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
            data1 = res.data;
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

                    if (message.message) {
                        messageContent.innerHTML = `
                            <div class='d-flex justify-content-between w-100'>
                                <strong class='chat-name'>${message.prenom} ${message.nom}</strong>
                                ${message.message ? `<small style="align-self: center;">${displayDate}</small>` : ""}
                            </div>
                            <p class='d-flex align-items-center justify-content-between' >
                                <span class="chat-msg">${message.message}</span>
                                ${message.id_destinataire == <?= $id ?> ? `<span>${message.vue == 0 ? '<i class="fa-solid fa-circle me-1" style="color:#440af7;font-size: 0.8em;"></i>' : ""}<i class="fa-solid fa-check" style='color: ${message.vue == 1 ? "blue" : "grey"};'></i></span>` : ""}
                            </p>
                        `;
                    }else{
                        if (message.audio) {
                            messageContent.innerHTML = `
                                <div class='d-flex justify-content-between w-100'>
                                    <strong class='chat-name'>${message.prenom} ${message.nom}</strong>
                                    ${message.audio ? `<small style="align-self: center;">${displayDate}</small>` : ""}
                                </div>
                                <p class='d-flex align-items-center justify-content-between'>
                                    <span class="chat-msg"><i class="fas fa-microphone pe-1" style="font-size: 1em;"></i>${message.audio_dure}</span>
                                    ${message.id_destinataire == <?= $id ?> ? `<span>${message.vue == 0 ? '<i class="fa-solid fa-circle me-1" style="color:#440af7;font-size: 0.8em;"></i>' : ""}<i class="fa-solid fa-check" style='color: ${message.vue == 1 ? "blue" : "grey"};'></i></span>` : ""}
                                </p>
                            `;
                        } else {
                            messageContent.innerHTML = `
                                <div class='d-flex justify-content-between w-100'>
                                    <strong class='chat-name'>${message.prenom} ${message.nom}</strong>
                                    ${message.message ? `<small style="align-self: center;">${displayDate}</small>` : ""}
                                </div>
                                <p class='chat-msg'>No messages yet</p>
                            `;
                        }
                    }

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

setInterval(() => {
    if (document.getElementById('chat').style.display === 'flex') {
        var footer = document.querySelector('.chat-footer');
        if (footer.innerHTML === ``) {
            $.ajax({
                url: 'index.php?action=selectmessages',
                type: 'POST',
                data: {
                    id_user: <?= $id ?>
                },
                success: function (res) {
                    if(JSON.stringify(res.data) !== JSON.stringify(data2)){
                        toggleChat();
                        data1 = res.data;
                    }
                    
                }
            });
        }else{
            var id_amie = document.querySelector('#msg_amie').getAttribute('id_amie');
            $.ajax({
                    url: 'index.php?action=selectmessagesamie',
                    type: 'POST',
                    data: {
                        id_user: <?= $id ?>,
                        id_amie: id_amie
                    },
                    success: function (res) {
                        if (JSON.stringify(res.data) !== JSON.stringify(data2)) {
                            show_chat(id_amie);
                            data2 = res.data;
                        }
                    }
                });
        }
    }
}, 1000);


function show_chat(id_amie) {
    $.ajax({
        url: 'index.php?action=selectmessagesamie',
        type: 'POST',
        data: {
            id_user: <?= $id ?>,
            id_amie: id_amie
        },
        success: function (res) {
            console.log(res.data);
            console.log(res.amieinfo);
            data2 = res.data;
            var chatBody = document.querySelector('.chat-body');
            chatBody.innerHTML = ''; // Clear previous messages

            if (res.data && res.data.length >= 0) {
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
                userName.innerHTML = `<strong id="msg_amie" id_amie="${id_amie}">${res.amieinfo.prenom} ${res.amieinfo.nom}</strong>`;
                
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
                    if(message.id_expediteur != <?= $id ?>){
                        $.ajax({
                            url: 'index.php?action=vue',
                            type: 'POST',
                            data: {
                                id_message: message.id_message
                            },
                            success: function (res) {

                            }
                        });
                    }

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
                        <span style="word-wrap: break-word;overflow-wrap: break-word;word-break: break-word;white-space: normal">
                            ${message.message ? message.message : `<audio class="custom-audio-player" src="${message.audio}" controls></audio>`}
                        </span>
                        <small style="font-size: 10px; color: gray; margin-left: 10px;">${formattedTime}</small>
                    `;

                    chat_div.appendChild(messageElement);
                    chatBody.appendChild(chat_div);
                });

                chat_div.scrollTop = chat_div.scrollHeight;

                var footer = document.querySelector('.chat-footer');
                footer.innerHTML = `
                    <button id="sendMessage" class="btn" onclick="start_audio(${id_amie})"><i class="fas fa-microphone" style="font-size: 1.2em;"></i></button>
                    <input type="text" id="userMessage" class="form-control ms-1 me-1" placeholder="Écrivez un message..." style="width: 100%;">
                    <button id="sendMessage" class="btn" onclick="sendMessage(${id_amie})"><i class="fas fa-paper-plane" style="font-size: 1.2em;" ></i></button>
                `;
            }
        }
    });
};



let recordedAudioBlob = null;

async function start_audio(id_amie) {
    let stream = await navigator.mediaDevices.getUserMedia({ audio: true });
    let mediaRecorder = new MediaRecorder(stream);
    let audioChunks = [];
    
    mediaRecorder.ondataavailable = event => audioChunks.push(event.data);
    
    mediaRecorder.onstop = () => {
        recordedAudioBlob = new Blob(audioChunks, { type: "audio/wav" });
    };
    
    mediaRecorder.start();

    let timerElement = document.createElement('span');
    timerElement.id = 'timer';
    timerElement.style.backgroundColor = 'white';
    timerElement.style.padding = '5px';
    timerElement.style.borderRadius = '50px';
    timerElement.textContent = '0:00';

    let seconds = 0;
    let timerInterval = setInterval(() => {
        seconds++;
        let minutes = Math.floor(seconds / 60);
        let remainingSeconds = seconds % 60;
        timerElement.textContent = `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
    }, 1000);

    var footer = document.querySelector('.chat-footer');
    footer.innerHTML = `
        <button class="delete-btn btn" style="width: 20px; height: 20px; padding: 10px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.7em;" onclick="deleteAudio(${id_amie})">✖</button>
        <span style="background-color: #2B2757; max-height: 100%; width: 200px; padding: 10px; border-radius: 50px; display: flex; align-items: center; justify-content: space-between;">
            <button id="stopBtn" style="background-color: white; height: 80%; padding: 5px; border-radius: 50px; display: flex; align-items: center; justify-content: center; font-size: 1.1em;">
                <i class="fa-solid fa-square" style="color: #2B2757;"></i>
            </button>
            <div class="visualizer" id="visualizer">
                <div class="bar"></div>
                  <div class="bar"></div>
                  <div class="bar"></div>
                  <div class="bar"></div>
                  <div class="bar"></div>
                </div>
        </span>
        <button id="uploadBtn" class="btn"><i class="fas fa-paper-plane" style="font-size: 1.2em;"></i></button>
    `;
    footer.querySelector('span').appendChild(timerElement);

    document.getElementById("stopBtn").addEventListener("click", () => {
        
        mediaRecorder.stop();
        clearInterval(timerInterval);
        finalTime = timerElement.textContent; 
        timerElement.textContent = finalTime;
        const uploadBtn = document.getElementById("uploadBtn");
        uploadBtn.onclick = function() {
            sendAudio(id_amie, finalTime);
        };
        

        bars = document.querySelectorAll('.bar');
        bars.forEach(bar => {
            bar.style.animationPlayState = 'paused';
            bar.style.height = '10px';
        });
    });
}

function sendAudio(id_amie, finalTime) {
    console.log("Sending audio to: " + id_amie);
    console.log("Final time: " + finalTime);
    var uploadBtn = document.getElementById("uploadBtn");
    if (!recordedAudioBlob) {
        alert("Aucun enregistrement audio disponible.");
        return;
    }



        let audioBlob = recordedAudioBlob;


        var formData = new FormData();
        formData.append("id_destinataire", id_amie);
        formData.append("finalTime", finalTime);
        formData.append("audio", audioBlob, "audio_message.wav");

        $.ajax({
            url: 'index.php?action=sendAudio',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                show_chat(id_amie);
            },
            error: function (err,e,r) {
                console.error("Error sending audio:", err);
                console.error("Error details:", e, r);

                alert("Erreur lors de l'envoi de l'audio.");
            }
        });
}


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

function deleteAudio(id_amie){
    var footer = document.querySelector('.chat-footer');
    footer.innerHTML = `
        <button id="sendMessage" class="btn" onclick="start_audio(${id_amie})"><i class="fas fa-microphone" style="font-size: 1.2em;"></i></button>
        <input type="text" id="userMessage" class="form-control ms-1 me-1" placeholder="Écrivez un message..." style="width: 100%;">
        <button id="sendMessage" class="btn" onclick="sendMessage(${id_amie})"><i class="fas fa-paper-plane" style="font-size: 1.2em;" ></i></button>
    `;
}

</script>
</body>
</html>