<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Story</title>
    <link rel="stylesheet" href="../assets/css/story.css">
</head>
<body>

    <!-- Bouton pour ouvrir la popup -->
  

    <!-- Overlay et popup -->
    <div class="overlay" id="storyOverlay"></div>
    <div class="popup" id="storyPopup">
        <div class="creer-poste">
            <div class="container_creer">
                <div class="wrapper">
                    <section class="story-post">
                        <header>Ajouter une Story</header>
                        <form method="post" enctype="multipart/form-data" action="index.php?action=ajouterStory">
                            <div>
                                <label for="storyImageInput">Choisir une image pour votre story</label>
                                <input type="file" id="storyImageInput" accept="image/*" name="image" required>
                            </div>
                            <div id="storyUploadedImageContainer"></div>
                            <div class="options">
                                <input type="submit" value="Ajouter la Story" name="submit">
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styles pour le popup */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .popup header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .popup form {
            display: flex;
            flex-direction: column;
        }

        .popup input[type="file"] {
            margin-bottom: 10px;
        }

        .popup button {
            background: blue;
            color: white;
            padding: 8px;
            border: none;
            cursor: pointer;
        }

        #storyUploadedImageContainer img {
            max-width: 100%;
            margin-top: 10px;
        }
    </style>

    <script>
        // Afficher l'image pré-visualisée dans la popup
        document.getElementById("storyImageInput").addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const uploadedImageContainer = document.getElementById("storyUploadedImageContainer");
                    uploadedImageContainer.innerHTML = '<img src="' + e.target.result + '" alt="Image téléchargée" />';
                };
                reader.readAsDataURL(file);
            }
        });

        // Obtenez les éléments pour ouvrir et fermer la popup
        const openStoryPopupButton = document.getElementById('openStoryPopup');
        const storyPopup = document.getElementById('storyPopup');
        const storyOverlay = document.getElementById('storyOverlay');

        // Ouvrir la popup en cliquant sur le bouton
        openStoryPopupButton.addEventListener('click', (e) => {
            e.preventDefault();
            storyPopup.style.display = 'block';
            storyOverlay.style.display = 'block';
        });

        // Fermer la popup en cliquant sur l'overlay
        storyOverlay.addEventListener('click', () => {
            storyPopup.style.display = 'none';
            storyOverlay.style.display = 'none';
        });
    </script>

</body>
</html>
