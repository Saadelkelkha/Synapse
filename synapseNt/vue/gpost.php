<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar and Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/home.css" />
    <style>
      #Users i{
        color: #102770;
      }

      #Users h3{
        color: #102770;
      }
      td a{
        margin-right: 10px;
      }
    </style>
</head>
<body>
    <div class="">
        <?php require_once 'vue/layout/navhome1admin.php'; ?>
        <main class="mt-1 d-flex">
            <?php require_once 'vue/layout/navhome2admin.php'; ?>
            <div class="gusers">
                <h1>Gestion des Posts</h1>
                <?php
  $conn = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
  $posts = [];

  if (isset($_POST['submit_search'])) {
    $searchValue = trim($_POST['search']);
    $searchBy = $_POST['search_by'];

    $allowedFields = ['id_post', 'text_content', 'date_post', 'nom', 'prenom'];
    if (in_array($searchBy, $allowedFields)) {
      if ($searchBy === 'id_post') {
        $stmt = $conn->prepare("SELECT p.*, u.nom, u.prenom FROM post p JOIN user u ON p.id_user = u.id_user WHERE p.id_post = ? ORDER BY date_post DESC");
        $stmt->execute([$searchValue]);
      } else {
        $queryField = in_array($searchBy, ['nom', 'prenom']) ? "u.$searchBy" : "p.$searchBy";
        $stmt = $conn->prepare("SELECT p.*, u.nom, u.prenom FROM post p JOIN user u ON p.id_user = u.id_user WHERE $queryField LIKE ? ORDER BY date_post DESC");
        $stmt->execute(["%$searchValue%"]);
      }
      $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  } else {
    $stmt = $conn->query("SELECT p.*, u.nom, u.prenom FROM post p JOIN user u ON p.id_user = u.id_user ORDER BY date_post DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
?>

<form action="" method="post">
<input type="text" name="search" placeholder="Rechercher un post" class="form-control search-bar" value="<?= isset($_POST['search']) ? htmlspecialchars($_POST['search']) : '' ?>">
<select name="search_by" class="form-select">
      <option value="text_content" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'text_content') ? 'selected' : '' ?>>Texte du post</option>
      <option value="date_post" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'date_post') ? 'selected' : '' ?>>Date de publication</option>
      <option value="prenom" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'prenom') ? 'selected' : '' ?>>Prénom</option>
      <option value="nom" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'nom') ? 'selected' : '' ?>>Nom</option>
    </select>
    <button type="submit" name="submit_search" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </form>
                    <form class="gusersall" action="" method="post">
                    <button type="submit" name="submit_all" class="btn btn-secondary">Tous les Posts</button>
                    </form>
                    

                    <form action="" method="post">
                    <input type="text" name="search" placeholder="Rechercher une story" class="form-control"
                   value="<?= isset($_POST['search']) ? htmlspecialchars($_POST['search']) : '' ?>">
            <select name="search_by" class="form-select">
              <option value="date_story" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'date_story') ? 'selected' : '' ?>>Date de publication</option>
              <option value="id_user" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'id_user') ? 'selected' : '' ?>>ID Utilisateur</option>
              <option value="prenom" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'prenom') ? 'selected' : '' ?>>Prénom</option>
              <option value="nom" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'nom') ? 'selected' : '' ?>>Nom</option>
            </select>
            <button type="submit" name="submit_search" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </form>
                    <form class="gusersall" action="" method="post">
                    <button type="submit" name="submit_all" class="btn btn-secondary">Toutes les Stories</button>
</form>
      </form>

<!-- Tableau d'affichage -->
<div class="table-responsive">
  <table class="table table-light table-striped table-md">
    <thead>
      <tr>
        <th>Nom & Prénom</th>
        <th>Texte du post</th>
        <th>Photo</th>
        <th>Date de publication</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php
                          $conn = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
                          
                          // Supprimer un post si une requête est envoyée
                          if (isset($_POST['delete']) && !empty($_POST['id_post'])) {
                            $id = $_POST['id_post'];
                             // Supprimer les enregistrements liés
                            $stmtEnr = $conn->prepare("DELETE FROM enregistrer_posts WHERE id_post = ?");
                            $stmtEnr->execute([$id]);
                        
                            // Supprimer les likes liés à ce post
                            $stmtLikes = $conn->prepare("DELETE FROM likes WHERE id_post = ?");
                            $stmtLikes->execute([$id]);
                        
                            // Ensuite supprimer le post
                            $stmt = $conn->prepare("DELETE FROM post WHERE id_post = ?");
                            $stmt->execute([$id]);
                        }
                        
                          
                          // Récupérer tous les posts
                          $stmt = $conn->query("
    SELECT p.*, u.nom, u.prenom 
    FROM post p 
    JOIN user u ON p.id_user = u.id_user 
    ORDER BY p.date_post DESC
");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                          
                           foreach ($posts as $post): ?>
      <tr>
      <td><?= htmlspecialchars($post['nom']) . ' ' . htmlspecialchars($post['prenom']) ?></td>
        <td><?= htmlspecialchars($post['text_content']) ?></td>
        <td>
          <?php if (!empty($post['image_path'])): ?>
            <img src="<?= htmlspecialchars($post['image_path']) ?>" style="width: 100px;" alt="Image du post">
          <?php else: ?>
            Aucune image
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($post['date_post']) ?></td>
        
        <td>
            <form method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer ce post ?');" style="display:inline;">
                <input type="hidden" name="id_post" value="<?= $post['id_post'] ?>">
                <button type="submit" name="delete" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Supprimer
                </button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>

                          
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>