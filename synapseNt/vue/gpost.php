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
                <div>
                    <form action="" method="post">
                        <input type="text" name="search" placeholder="Rechercher un utilisateur" class="form-control search-bar">
                        <select name="search_by" id="search_by" class="form-select">
                            <option value="id_user">Id</option>
                            <option value="prenom">Text du post</option>
                            <option value="nom">Date de publication</option>
                           
                        </select>
                        <button type="submit" name="submit_search" class="btn btn-primary"><i class="bi bi-search"></i></button>
                    </form>
                    <form class="gusersall" action="" method="post">
                        <button type="submit" name="submit_all" class="btn btn-primary">Tous les Posts</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-light table-striped table-md mt-2">
                        <tr>
                            <th>Id</th>
                            <th>Text du post</th>
                            <th>Photo</th>
                            <th>Date de publication</th>
                            <th>Actions</th>
                        </tr>
                       
                        <?php
                            foreach ($posts as $post) {
                                echo "<tr>";
                                echo "<td>".$post->id_post."</td>";
                                echo "<td>".$post->text_content."</td>";
                                echo "<td><img src='".$post->image_path."' alt='Image du post' style='max-width: 100px; max-height: 100px;'></td>";
                                echo "<td>".$post->date_post."</td>";
                                 echo "<td class='action'><a href='index.php?action=afficherModifierPostAdmin&id_post=".$post->id_post."'><i class='uil uil-pen'></i></a>";
                                // echo "<td class='action'><a href="index.php?action=afficherModifierPostAdmin&id_post=$post->id_post."'><i class='uil uil-pen'></i></a>";

                                echo "<td class='action'><a href=''><i class='uil uil-pen'></i></a>";
                                echo "<a href='index.php?action='><i class='uil uil-trash-alt'></i></a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>