<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des postes | SynapseNt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/home.css" />
    <link rel="shortcut icon" href="img/logop11.png" type="image/png">
    <style>
      #Users i{
        color: #102770;
      }
      .btn12{
        background-color: #102770;
      }

      #Users h3{
        color: #102770;
      }
      td a{
        margin-right: 10px;
      }
      .div-post1{
        display:flex;
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

<div class="div-post1">
  <form action="" method="post">
<input type="text" name="search" placeholder="Rechercher un post" class="form-control search-bar" value="<?= isset($_POST['search']) ? htmlspecialchars($_POST['search']) : '' ?>">
<select name="search_by" class="form-select">
      <option value="text_content" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'text_content') ? 'selected' : '' ?>>Texte du post</option>
      <option value="date_post" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'date_post') ? 'selected' : '' ?>>Date de publication</option>
      <option value="prenom" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'prenom') ? 'selected' : '' ?>>Prénom</option>
      <option value="nom" <?= (isset($_POST['search_by']) && $_POST['search_by'] == 'nom') ? 'selected' : '' ?>>Nom</option>
    </select>
    <button type="submit" name="submit_search" class="btn" style="background-color: #2B2757;color:white;"><i class="bi bi-search"></i></button>
                    </form>
                    <form class="gusersall" action="" method="post">
                    <button type="submit" name="submit_all" class="btn" style="background-color: #2B2757;color:white;">Tous les Posts</button>
                    </form>
</div>
                    

                    

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
  foreach ($posts as $post):
?>
  <tr>
    <td><?= htmlspecialchars($post['nom']) . ' ' . htmlspecialchars($post['prenom']) ?></td>
    <td><?= htmlspecialchars($post['text_content']) ?></td>
    <td>
      <?php if (!empty($post['photo'])): ?>
        <img src="uploads/<?= htmlspecialchars($post['photo']) ?>" alt="Photo" width="100">
      <?php else: ?>
        Pas de photo
      <?php endif; ?>
    </td>
    <td><?= htmlspecialchars($post['date_post']) ?></td>
    <td>
      <form method="post" onsubmit="return confirm('Supprimer ce post ?');">
        <input type="hidden" name="id_post" value="<?= $post['id_post'] ?>">
        <button type="submit" name="delete" class="btn btn-danger btn-sm"><i class='uil uil-trash-alt'></i></button>
      </form>
    </td>
  </tr>
<?php endforeach; ?>
</tbody>

                          
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>