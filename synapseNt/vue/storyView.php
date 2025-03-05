<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stories</title>
    <link rel="stylesheet" href="../assets/css/story.css">
</head>
<body>
    <h2>Stories</h2>
    <div class="story-container">
        <?php if (!empty($stories)): ?>
            <?php foreach ($stories as $story): ?>
                <div class="story-item">
                    <img src="../<?php echo $story->image_path; ?>" alt="Story Image">
                    <p>Posté le : <?php echo $story->date_story; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune story disponible.</p>
        <?php endif; ?>
    </div>
    
    <form action="index.php?action=ajouterStory" method="post" enctype="multipart/form-data">

        <input type="file" name="image" required>
        <button type="submit">Ajouter une Story</button>
    </form>
</body>
</html>
