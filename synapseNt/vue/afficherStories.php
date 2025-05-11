<?php 
$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");

// Récupérer les stories depuis la base de données
$sql = "SELECT s.*, u.prenom, u.nom, u.photo_profil 
        FROM story s
        JOIN user u ON s.id_user = u.id_user
        ORDER BY s.date_story DESC";
$stories = $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stories</title>
    <style>
        .stories_body {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2% 0;
            width: 100%;
            
        }
       
        .stories-container {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 10px;
            white-space: nowrap;
            width: 80%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .story {
            width: 100px;
            height: 150px;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .story:hover {
            transform: scale(1.1);
        }

        .story img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .story span {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-size: 12px;
        }

        .story-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
            z-index: 30;
        }

        .story-overlay img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
        }

        .story-overlay .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }
     
        .btn-story1{
            background-color: transparent;
            color:grey;
        }
        .btn-story1:hover{
            background-color: transparent;
            color:#2B2757;
            font-size:large;

        }
    </style>
</head>
<body>

<?php   $now = time();?>


<script>
    const allStories = {};
</script>

<?php
$groupedStories = [];

foreach ($stories as $story) {
    $timestamp = strtotime($story->date_story);
    $remaining = 86400 - (time() - $timestamp);

    if ($remaining > 0) {
        $groupedStories[$story->id_user][] = $story;
    } else {
        // Supprimer les anciennes stories
        $pdo->query("DELETE FROM story WHERE id_story = $story->id_story");
    }
}
?>
    <div class="stories_body">
        <div class="stories-container" id="stories">
            <div class="home_stories">
                <div class="home_make_story">
                    <img src="<?php echo $user['photo_profil']; ?>">
                    <b><button class="btn-story1" id="openStoryPopup">+</button></b>
                </div>
            </div>

            <div class="stories_body">
    <div class="stories-container" id="stories">
        <?php foreach ($groupedStories as $userId => $userStories):
            $firstStory = $userStories[count($userStories) - 1];
        ?>
            <div class="story" onclick='playUserStories(<?php echo json_encode($userStories); ?>)'>
                <img src="<?= $firstStory->image_path ?>" alt="Story">
            </div>
        <?php endforeach; ?>
    </div>
</div>        </div>
    </div>

    <div class="story-overlay" id="storyOerlay">
        <span class="close-btn" onclick="closeStoryOverlay()">&times;</span>
        <img id="storyImage" src="" alt="Story en grand">
    </div>

    <script>
        function viewStory(image) {
            document.getElementById('storyImage').src = image;
            document.getElementById('storyOerlay').style.display = 'flex';
        }

        function closeStoryOverlay() {
            document.getElementById('storyOerlay').style.display = 'none';
        }
    </script>
<script>
    let storyTimeout;
    function playUserStories(stories) {
        let index = stories.length - 1;

        function showPrevious() {
            if (index < 0) {
                closeStoryOverlay();
                return;
            }

            const story = stories[index];
            document.getElementById('storyImage').src = story.image_path;
            document.getElementById('storyOerlay').style.display = 'flex';

            index--;
            storyTimeout = setTimeout(showPrevious, 15000);
        }

        showPrevious();
    }

    function closeStoryOverlay() {
        document.getElementById('storyOerlay').style.display = 'none';
        if (storyTimeout) {
            clearTimeout(storyTimeout); // Stop the timeout for showing the next story
        }
    }
</script>


</body>
</html>