<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des groupes | SynapseNt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4p889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/home.css" />
    <link rel="shortcut icon" href="img/logop11.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/htmx.org"></script>
    <style>
      #Groups i{
        color: #102770;
      }

      #Groups h3{
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
                <h1>Gestion des Groupes</h1>
                <div>
                    <form action="" method="post">
                        <input type="text" name="search" placeholder="Rechercher un groupe" class="form-control search-bar">
                        <select name="search_by" id="search_by" class="form-select">
                            <option value="id_group">ID</option>
                            <option value="id_admin">ID admin</option>
                            <option value="name_group">Nom de groupe</option>
                        </select>
                        <button type="submit" name="submit_search" class="btn" style="background-color: #2B2757;color:white;"><i class="bi bi-search"></i></button>
                    </form>
                    <form class="gusersall" action="" method="post">
                        <button type="submit" name="submit_all" class="btn" style="background-color: #2B2757;color:white;">Tous les Groupes</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-light table-striped table-md mt-2">
                        <tr>
                            <th>ID</th>
                            <th>ID Admin</th>
                            <th>Nom de groupe</th>
                            <th>Description de groupe</th>
                            <th>Date de creation de groupe</th>
                            <th>Banner de groupe</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                            foreach ($groups as $user) {
                                echo "<tr>";
                                echo "<td>".$user['id_group']."</td>";
                                echo "<td>".$user['id_admin']."</td>";
                                echo "<td>".$user['name_group']."</td>";
                                echo "<td>".$user['description_group']."</td>";
                                echo "<td>".$user['date_creation_group']."</td>";
                                echo "<td onclick='showPopup(\"".$user['group_banner']."\",\"".$user['id_group']."\")' style='cursor: pointer;'><img src='".$user['group_banner']."' style='max-width:100px;max-height:100px'/></td>";
                                echo "<td class='action'><form class='p-0' method='post' action='index.php?action=update_groupe'><input name='id' type='hidden' value='" . $user['id_group'] . "'><button class='btn border-0 p-0' type='submit'><i class='uil uil-pen'></i></button></form>";
                                echo "<form class='p-0' method='post' action='index.php?action=delete_groupe'><input type='hidden' name='id' value='" . $user['id_group'] . "'><button class='btn border-0 p-0' type='submit'><i class='uil uil-trash-alt'></i></button></form></td>";
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script>
        function showPopup(contentPath,id) {
            // Create the popup container
            const popup = document.createElement('div');
            popup.style.position = 'fixed';
            popup.style.top = '0';
            popup.style.left = '0';
            popup.style.width = '100%';
            popup.style.height = '100%';
            popup.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
            popup.style.display = 'flex';
            popup.style.flexDirection = 'column';
            popup.style.justifyContent = 'center';
            popup.style.alignItems = 'center';
            popup.style.zIndex = '1000';
            
            // Create the image element
            const img = document.createElement('img');
            img.src = contentPath;
            img.style.maxWidth = '90%';
            img.style.maxHeight = '70%';
            img.style.borderRadius = '10px';
            img.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
            popup.appendChild(img);

            // Create the button container
            const buttonContainer = document.createElement('div');
            buttonContainer.style.marginTop = '20px';
            buttonContainer.style.display = 'flex';
            buttonContainer.style.gap = '10px';

            // Create the "Supprimer la bannière" form
            const removeForm = document.createElement('form');
            removeForm.method = 'post';
            removeForm.action = 'index.php?action=delete_banner_grp';
            removeForm.style.display = 'inline';

            // Add a hidden input to pass the banner path
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'id';
            hiddenInput.value = id;
            removeForm.appendChild(hiddenInput);

            // Create the "Supprimer la bannière" button
            const removeButton = document.createElement('button');
            removeButton.textContent = 'Supprimer la bannière';
            removeButton.style.padding = '10px 20px';
            removeButton.style.backgroundColor = '#dc3545';
            removeButton.style.color = '#fff';
            removeButton.style.border = 'none';
            removeButton.style.borderRadius = '5px';
            removeButton.style.cursor = 'pointer';
            removeForm.appendChild(removeButton);

            // Append the form to the button container
            buttonContainer.appendChild(removeForm);

            // Create the "Annuler" button
            const cancelButton = document.createElement('button');
            cancelButton.textContent = 'Annuler';
            cancelButton.style.padding = '10px 20px';
            cancelButton.style.backgroundColor = '#6c757d';
            cancelButton.style.color = '#fff';
            cancelButton.style.border = 'none';
            cancelButton.style.borderRadius = '5px';
            cancelButton.style.cursor = 'pointer';
            cancelButton.addEventListener('click', () => {
                document.body.removeChild(popup);
            });
            buttonContainer.appendChild(cancelButton);

            // Append the button container to the popup
            popup.appendChild(buttonContainer);

            // Append the popup to the body
            document.body.appendChild(popup);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>