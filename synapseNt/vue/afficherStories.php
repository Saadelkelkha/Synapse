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
        .custom-progress-bar {
            height: 5px;
            background-color: #2B2757;
            width: 0%;
            transition: width 15s linear;
        }
        .progress {
            height: 5px;
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
        .progress {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background-color: rgba(255, 255, 255, 0.1); /* Fond léger */
            z-index: 1050; /* supérieur à Bootstrap modal content */
        }


        .custom-progress-bar {
            height: 5px;
            background-color: #2B2757;
            width: 0%;
            transition: width 15s linear;
        }

        .progress {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background-color: rgba(255, 255, 255, 0.1);
    z-index: 1050;
    overflow: hidden;
}

#storyProgress {
    height: 100%;
    background-color: #00ccff;
    width: 0%;
    transition: width 15s linear;
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
    <div style="position: relative; display: inline-block; text-align: center;">
        <!-- Story Thumbnail -->
        <img src="<?= htmlspecialchars($firstStory->image_path) ?>" 
             class="story-thumbnail" 
             onclick='playStories(<?= json_encode($userStories) ?>)' 
             alt="Story">

        <!-- Profile Image on Top Left -->
        <img src="<?= htmlspecialchars($firstStory->photo_profil) ?>" 
             alt="Profil" 
             style="
                position: absolute;
                top: 5px;
                left: 5px;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                border: 2px solid white;
                object-fit: cover;
            ">
    </div>
<?php endforeach; ?>

    </div>
</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="storyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content bg-dark text-white text-center position-relative">
            <!-- Barre de progression -->
            <div class="progress">
              <div id="storyProgress"></div>
            </div>

            <!-- User Info -->
            <div id="storyUserInfo" class="d-flex align-items-center text-start px-3 py-2"
                 style="position: absolute; top: 5px; left: 5px; z-index: 1051;">
                <img id="storyUserPhoto" src="" alt="User"
                     style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid white; margin-right: 10px;">
                <span id="storyUserName" style="font-weight: bold; color: white;"></span>
            </div>


            <!-- Navigation & fermeture -->
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" 
                    data-bs-dismiss="modal" aria-label="Close" style="z-index: 1061;"></button>
                    
            <button class="btn btn-dark position-absolute top-50 start-0 translate-middle-y" 
                    onclick="showPrevious()" style="z-index: 1060;">&#10094;</button>
                    
            <button class="btn btn-light position-absolute top-50 end-0 translate-middle-y" 
                    onclick="showNext()" style="z-index: 1060;">&#10095;</button>


            <!-- Affichage de l'image -->
            <div class="position-relative d-flex justify-content-center align-items-center my-5" style="min-height: 90vh;">
                <img id="storyImage" src="" class="img-fluid" style="max-height: 90vh;" alt="Story">
            </div>

        </div>
    </div>
</div>

<<<<<<< HEAD
=======
<!-- Bootstrap JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
>>>>>>> ef003e3270f937cedebe834f1adb057e3aa8b0f3

<script>
    let groupedStories = <?php echo json_encode($groupedStories); ?>;
    let currentIndex = -1;
    let currentStories = [];
    let timer;
    const storyModal = new bootstrap.Modal(document.getElementById('storyModal'));

    function playStories(stories) {
        currentStories = stories;
        currentIndex = stories.length - 1;
        storyModal.show();
        
        // Wait for modal to fully show before starting story
        setTimeout(() => {
            showStory(currentIndex);
        }, 300); // delay helps DOM fully render
    }

    function showStory(index) {
        if (index < 0 || index >= currentStories.length) {
            storyModal.hide();
            return;
        }

        clearTimeout(timer);

        const story = currentStories[index];

        const img = document.getElementById('storyImage');
        const progressBar = document.getElementById('storyProgress');
        const userPhoto = document.getElementById('storyUserPhoto');
        const userName = document.getElementById('storyUserName');


        // Set story image
        img.src = story.image_path;

        // Set user info
        userPhoto.src = story.photo_profil;
        userName.textContent = story.prenom + ' ' + story.nom;

        // Reset and animate progress bar
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
        // If we're at the last story of the current user, move to the next user's first story

        if (currentIndex == 0) {
            let currentUserId = currentStories[currentIndex].id_user;

            // Find the next user's stories based on the current user's ID
            let nextUserId = getNextUserId(currentUserId);

            // If there is a next user, show their first story
            if (nextUserId !== null) {
                let nextUserStories = groupedStories[nextUserId];
                currentStories = nextUserStories;
                currentIndex = nextUserStories.length - 1;  // Start from the first story of the next user
                showStory(currentIndex);
            } else {
                // If there's no next user (last user), close the modal
                storyModal.hide();
            }
        } else {
            // Otherwise, just move to the next story for the current user
            currentIndex--;
            showStory(currentIndex);
        }
    }

    function getNextUserId(currentUserId) {
        // Check if there is a next user after the current one in the groupedStories
        let userIds = Object.keys(groupedStories); // Get user IDs
        let currentIndexInList = userIds.indexOf(String(currentUserId)); // Find current user's index

        if (currentIndexInList <= userIds.length - 1 && currentIndexInList > 0) {
            // Return the next user's ID
            return userIds[currentIndexInList - 1];
        }

        return null; // No next user
    }


    function showPrevious() {
        if (currentIndex == currentStories.length - 1) {
            let currentUserId = currentStories[currentIndex].id_user;
        
            // Find the next user's stories based on the current user's ID
            let nextUserId = getPreviousUserId(currentUserId);
        
            // If there is a next user, show their first story
            if (nextUserId !== null) {
                let nextUserStories = groupedStories[nextUserId];
                currentStories = nextUserStories;
                currentIndex = 0;  // Start from the first story of the next user
                showStory(currentIndex);
            } else {
                // If there's no next user (last user), close the modal
                storyModal.hide();
            }
        } else {
            // Otherwise, just move to the next story for the current user
            currentIndex++;
            showStory(currentIndex);
        }

    }

    function getPreviousUserId(currentUserId) {
        // Check if there is a next user after the current one in the groupedStories
        let userIds = Object.keys(groupedStories); // Get user IDs
        let currentIndexInList = userIds.indexOf(String(currentUserId)); // Find current user's index

        if (currentIndexInList < userIds.length - 1) {
            // Return the next user's ID
            return userIds[currentIndexInList + 1];
        }

        return null; // No next user
    }
</script>

