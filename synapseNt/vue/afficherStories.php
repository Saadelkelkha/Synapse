<?php
$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");

// Récupérer les stories depuis la base de données
$sql = "SELECT s.*, u.prenom, u.nom, u.photo_profil 
        FROM story s
        JOIN user u ON s.id_user = u.id_user
        ORDER BY s.date_story DESC";
$stories = $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);

$groupedStories = [];
foreach ($stories as $story) {
    $timestamp = strtotime($story->date_story);
    $remaining = 86400 - (time() - $timestamp);
    if ($remaining > 0) {
        $groupedStories[$story->id_user][] = $story;
    } else {
        $pdo->query("DELETE FROM story WHERE id_story = $story->id_story");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Stories Bootstrap</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
        }
        #openStoryPopup {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        font-size: 20px;
        font-weight: bold;
        color: white;
        background-color: #2B2757;
        border: none;
        position: absolute;
        
        right: -5px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        transition: transform 0.2s ease;
    }
        .stories-container {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 10px;
        }
        .story-thumbnail {
            width: 100px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .story-thumbnail:hover {
            transform: scale(1.1);
        }
        .progress-bar-story {
            height: 5px;
            background-color: #2B2757;
            width: 0%;
            transition: width 15s linear;
        }
        .home_make_story {
        display: flex;
        flex-direction: column-reverse;
        align-items: center;
        justify-content: center;
        width: 100px;
        height: 160px;
        position: relative;
    }

    .home_make_story img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #2B2757;
        margin-top: 10px;
    }
        .home_make_story button {
            font-size: 20px;
            color: #00ccff;
            background: none;
            border: none;
        }
        .home_make_story button:hover {
            color: #005f73;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="stories-container">
        <!-- Bouton pour ajouter une story -->
        <div class="home_make_story">
            <img src="<?php echo $user['photo_profil']; ?>" alt="Votre photo">
            <button id="openStoryPopup">+</button>
        </div>

        <!-- Affichage des stories -->
        <?php foreach ($groupedStories as $userId => $userStories): 
            $firstStory = end($userStories);
        ?>
            <img src="<?= htmlspecialchars($firstStory->image_path) ?>" 
                 class="story-thumbnail" 
                 onclick='playStories(<?= json_encode($userStories) ?>)' 
                 alt="Story">
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="storyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content bg-dark text-white text-center position-relative">
            <!-- Barre de progression -->
            <div class="progress">
                <div class="progress-bar progress-bar-story" id="storyProgress"></div>
            </div>

            <!-- Navigation & fermeture -->
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <button class="btn btn-dark position-absolute top-50 start-0 translate-middle-y" onclick="showPrevious()">&#10094;</button>
            <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y" onclick="showNext()">&#10095;</button>

            <!-- Affichage de l'image -->
            <img id="storyImage" src="" class="img-fluid mx-auto d-block my-5" style="max-height: 90vh;" alt="Story">
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let currentIndex = -1;
    let currentStories = [];
    let timer;
    const storyModal = new bootstrap.Modal(document.getElementById('storyModal'));

    function playStories(stories) {
        currentStories = stories;
        currentIndex = stories.length - 1;
        storyModal.show();
        showStory(currentIndex);
    }

    function showStory(index) {
        if (index < 0 || index >= currentStories.length) {
            storyModal.hide();
            return;
        }

        clearTimeout(timer);

        const img = document.getElementById('storyImage');
        const progressBar = document.getElementById('storyProgress');
        img.src = currentStories[index].image_path;

        // Reset & start progress bar
        progressBar.style.transition = 'none';
        progressBar.style.width = '0%';
        void progressBar.offsetWidth;
        setTimeout(() => {
            progressBar.style.transition = 'width 15s linear';
            progressBar.style.width = '100%';
        }, 50);

        timer = setTimeout(() => {
            showNext();
        }, 15000);
    }

    function showNext() {
        if (currentIndex > 0) {
            currentIndex--;
            showStory(currentIndex);
        } else {
            storyModal.hide();
        }
    }

    function showPrevious() {
        if (currentIndex < currentStories.length - 1) {
            currentIndex++;
            showStory(currentIndex);
        }
    }
</script>

</body>
</html>