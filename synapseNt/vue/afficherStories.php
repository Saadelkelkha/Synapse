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
            /* width: 100%; */
            
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
        .home_stories{
            z-index: 798;
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

<?php   $now = time();
$groupedStories = [];

foreach ($stories as $story) {
    $userId = $story->id_user;
    if (!isset($groupedStories[$userId])) {
        $groupedStories[$userId] = [
            'prenom' => $story->prenom,
            'nom' => $story->nom,
            'photo_profil' => $story->photo_profil,
            'stories' => []
        ];
    }
    $groupedStories[$userId]['stories'][] = $story;
}


// Vérifie si des stories sont disponibles
if (!isset($stories) || empty($stories)) {
    echo "Aucune story disponible.";
} else {
?>
    <div class="stories_body">
        <div class="stories-container" id="stories">
            <div class="home_stories">
                <div class="home_make_story">
                    <img src="<?php echo $user['photo_profil']; ?>">
                    <b><button class="btn-story1" id="openStoryPopup">+</button></b>
                </div>
            </div>

            <?php foreach ($stories as $story): 
            
                $storyTime = strtotime($story->date_story);
             
                $timeDiff = $now - $storyTime;
              
                if ($timeDiff < 60) {
                  $remainingTime = 60 - $timeDiff;
                  
                
                ?>
                <div class="story" onclick="viewStory('<?php echo $story->image_path; ?>')">
                    <img src="<?php echo $story->image_path; ?>" alt="Story">
                </div>
            <?php }  endforeach; ?>
        </div>
    </div>

    <div class="story-overlay" id="storyOverlay">
        <span class="close-btn" onclick="closeStoryOverlay()">&times;</span>
        <img id="storyImage" src="" alt="Story en grand">
    </div>

    <script>
        function viewStory(image) {
            document.getElementById('storyImage').src = image;
            document.getElementById('storyOverlay').style.display = 'flex';
        }

        function closeStoryOverlay() {
            document.getElementById('storyOverlay').style.display = 'none';
        }
    </script>
<?php } ?>


</body>
</html>
