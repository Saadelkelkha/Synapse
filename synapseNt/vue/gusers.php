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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/htmx.org"></script>
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
                <h1>Gestion des utilisateurs</h1>
                <div>
                    <form action="" method="post">
                        <input type="text" name="search" placeholder="Rechercher un utilisateur" class="form-control search-bar">
                        <select name="search_by" id="search_by" class="form-select">
                            <option value="id_user">Id</option>
                            <option value="prenom">Prenom</option>
                            <option value="nom">Nom</option>
                            <option value="email">Email</option>
                        </select>
                        <button type="submit" name="submit_search" class="btn" style="background-color: #2B2757;color:white;"><i class="bi bi-search"></i></button>
                    </form>
                    <form class="gusersall" action="" method="post">
                        <button type="submit" name="submit_all" class="btn" style="background-color: #2B2757;color:white;">Tous les utilisateurs</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-light table-striped table-md mt-2">
                        <tr>
                            <th>Id</th>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Date de naissance</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                            foreach ($users as $user) {
                                echo "<tr>";
                                echo "<td>".$user['id_user']."</td>";
                                echo "<td>".$user['prenom']."</td>";
                                echo "<td>".$user['nom']."</td>";
                                echo "<td>".$user['email']."</td>";
                                echo "<td>".$user['date_naissance']."</td>";
                                echo "<td class='action d-flex'><form class='p-0' method='post' action='index.php?action=update_user'><input name='id' type='hidden' value='" . $user['id_user'] . "'><button class='btn border-0 p-0' type='submit'><i class='uil uil-pen'></i></button></form>";
                                echo "<form class='p-0' method='post' action='index.php?action=delete_user'><input type='hidden' name='id' value='" . $user['id_user'] . "'><button class='btn border-0 p-0' type='submit'><i class='uil uil-trash-alt'></i></button></form></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>