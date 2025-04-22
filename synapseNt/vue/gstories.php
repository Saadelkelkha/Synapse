<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Stories</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <link rel="stylesheet" href="assets/home.css" />
  <style>
    #Users i, #Users h3 {
      color: #102770;
    }
    td a {
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
      <h1>Gestion des Stories</h1>

      <?php
        $conn = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
        $stories = [];

        if (isset($_POST['submit_search'])) {
          $search = trim($_POST['search']);
          $searchBy = $_POST['search_by'];
          $allowedFields = ['id_user', 'textes_complets', 'date_story', 'nom', 'prenom'];

          if (in_array($searchBy, $allowedFields)) {
            $queryField = in_array($searchBy, ['nom', 'prenom']) ? "u.$searchBy" : "s.$searchBy";
            $stmt = $conn->prepare("
              SELECT s.*, u.nom, u.prenom 
              FROM story s 
              JOIN user u ON s.id_user = u.id_user 
              WHERE $queryField LIKE ? 
              ORDER BY s.date_story DESC
            ");
            $stmt->execute(["%$search%"]);
            $stories = $stmt->fetchAll(PDO::FETCH_ASSOC);
          }
        } else {
          $stmt = $conn->query("
            SELECT s.*, u.nom, u.prenom 
            FROM story s 
            JOIN user u ON s.id_user = u.id_user 
            ORDER BY s.date_story DESC
          ");
          $stories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Supprimer une story si demandé
        if (isset($_POST['delete']) && !empty($_POST['id_story'])) {
          $id = $_POST['id_story'];
          $stmt = $conn->prepare("DELETE FROM story WHERE id_story = ?");
          $stmt->execute([$id]);
          header("Location: " . $_SERVER['PHP_SELF']); // Refresh pour éviter double suppression
          exit;
        }
      ?>

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
      <div class="table-responsive">
        <table class="table table-light table-striped table-md mt-2">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nom & Prénom</th>
             
              <th>Photo</th>
              <th>Date de publication</th>
              <th>Expiration</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($stories as $story): ?>
            <tr>
              <td><?= htmlspecialchars($story['id_story']) ?></td>
              <td><?= htmlspecialchars($story['nom']) . ' ' . htmlspecialchars($story['prenom']) ?></td>
              <td>
                <?php if (!empty($story['image_path'])): ?>
                  <img src="<?= htmlspecialchars($story['image_path']) ?>" alt="Story Image" style="width: 100px;">
                <?php else: ?>
                  Aucune image
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($story['date_story']) ?></td>
              <td><?= htmlspecialchars($story['expiration']) ?></td>
              <td>
                <form method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette story ?');" style="display:inline;">
                  <input type="hidden" name="id_story" value="<?= $story['id_story'] ?>">
                  <button type="submit" name="delete" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Supprimer
                  </button>
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
