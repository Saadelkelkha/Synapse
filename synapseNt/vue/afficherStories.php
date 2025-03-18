<?php 
$pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");

// Récupérer les stories depuis la base de données
$sqlState = $pdo->query('SELECT * FROM story ORDER BY date_story DESC');
$stories = $sqlState->fetchAll(PDO::FETCH_OBJ);
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
    </style>
</head>
<body>

    <div class="stories_body">
        <div class="stories-container" id="stories">
        <div class="home_stories">
                          <div class="home_make_story">
                              <img  src="img/Profile/Julia Clarke.png">
                              <b>+</b>
                             
                              
                          </div>
                        
                         
                      </div>
       
            
            <?php foreach($stories as $story) { ?>
                <div class="story" onclick="viewStory('<?php echo $story->image_path; ?>')">
                    
                   
                   
                      <img src="<?php echo $story->image_path; ?>" alt="Story">
                      
                    
                    
                </div>
            <?php } ?>
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

</body>
</html>
