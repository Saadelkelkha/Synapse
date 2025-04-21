<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "synapse");

// Upload de la story
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["story_image"])) {
    $filename = time() . "_" . basename($_FILES["story_image"]["name"]);
    $target = "uploads/" . $filename;

    if (move_uploaded_file($_FILES["story_image"]["tmp_name"], $target)) {
        $stmt = $conn->prepare("INSERT INTO stories (image, created_at) VALUES (?, NOW())");
        $stmt->bind_param("s", $filename);
        $stmt->execute();
    }

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Stories - Synapse</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      margin: 0;
      padding: 20px;
    }

    .story-container {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    #stories {
      display: flex;
      gap: 10px;
      overflow-x: auto;
      margin-top: 20px;
    }

    .story {
      width: 120px;
      height: 200px;
      background: #ccc;
      border-radius: 10px;
      position: relative;
      overflow: hidden;
      cursor: pointer;
    }

    .story img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .popup {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.8);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .popup img {
      width: 60%;
      max-height: 80%;
      border-radius: 10px;
    }

    .hidden {
      display: none;
    }

    .close-btn {
      position: absolute;
      top: 20px;
      right: 40px;
      color: white;
      font-size: 30px;
      cursor: pointer;
    }

    button {
      padding: 6px 12px;
      background: #1877f2;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="file"] {
      padding: 5px;
    }
  </style>
</head>
<body>

  <h2>Créer une Story</h2>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="story_image" required>
    <button type="submit">+ Créer une story</button>
  </form>

  <h3>Stories</h3>
  <div class="story-container" id="stories">
    <?php
    $storiesByUser = [];
    $result = $conn->query("SELECT * FROM stories ORDER BY created_at ASC");
    
    while ($row = $result->fetch_assoc()) {
        $timeDiff = time() - strtotime($row['created_at']);
        if ($timeDiff >= 86400) {
            $conn->query("DELETE FROM stories WHERE id = " . $row['id']);
            continue;
        }
    
        $storiesByUser[$row['user_id']][] = $row;
    }

    while ($row = $result->fetch_assoc()) {
      $storyTime = strtotime($row['created_at']);
      $storyId = $row['id'];
      $image = $row['image'];
      $timeDiff = $now - $storyTime;

      if ($timeDiff < 86400) {
        $remainingTime =  86400 - $timeDiff;
        echo "<div class='story' data-id='$storyId' data-remaining='$remainingTime' onclick=\"showStory('$image')\">";
        echo "<img src='uploads/$image' alt='Story'>";
        echo "</div>";
      } else {
        // Supprimer automatiquement côté serveur
        $conn->query("DELETE FROM stories WHERE id = $storyId");
      }
    }

    foreach ($storiesByUser as $userId => $stories) {
      $firstStory = $stories[0];
      echo "<div class='story' onclick='startStorySequence(" . json_encode($stories) . ")'>";
      echo "<img src='uploads/{$firstStory['image']}' alt='Story'>";
      echo "</div>";
    }
   
    ?>
  </div>

  <!-- Popup story -->
  <div id="storyPopup" class="popup hidden">
    <span class="close-btn" onclick="closeStoryPopup()">&times;</span>
    <img id="storyImage" src="" alt="Story Image">
  </div>

  <script>
    // Popup story
    function showStory(imagePath) {
      document.getElementById("storyImage").src = "uploads/" + imagePath;
      document.getElementById("storyPopup").classList.remove("hidden");
      setTimeout(() => {
        closeStoryPopup();
      }, 60000); // Fermer après 60 secondes
    }

    function closeStoryPopup() {
      document.getElementById("storyPopup").classList.add("hidden");
    }

    // Masquer automatiquement les stories expirées côté client
    document.addEventListener("DOMContentLoaded", () => {
      const stories = document.querySelectorAll(".story");
      stories.forEach(story => {
        const remaining = parseInt(story.getAttribute("data-remaining"));
        if (remaining > 0) {
          setTimeout(() => {
            story.remove();
          }, remaining * 1000); // Supprimer quand expire
        }
      });
    });

  function startStorySequence(stories) {
    let index = 0;

    function showNextStory() {
      if (index >= stories.length) {
        closeStoryPopup();
        return;
      }

      const story = stories[index];
      document.getElementById("storyImage").src = "uploads/" + story.image;
      document.getElementById("storyPopup").classList.remove("hidden");

      index++;
      setTimeout(showNextStory, 60000); // Affiche suivante après 60 sec
    }

    showNextStory();
  }

  function closeStoryPopup() {
    document.getElementById("storyPopup").classList.add("hidden");
  }
</script>

</body>
</html>
