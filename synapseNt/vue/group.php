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
</head>
<body>
    <div class="mt-3">
        <!-- Navbar -->
        <?php require_once 'vue/layout/navhome1.php'; ?>

        <main class="mt-1 d-flex">
            <!-- Sidebar -->
            <?php require_once 'vue/layout/navhome2.php'; ?>
            
            <div class="group">
                <div class="actions-group">
                    <form class="aff_group_form" action="" method="post">
                        <input type="text" name="search_group" placeholder="Rechercher un groupe" class="form-control search-bar">
                        <button type="submit" name="submit_search_group" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        <button type="submit" name="submit_all_group" class="btn btn-primary">Tous les groupes</button>
                    </form>
                    <form class="add_group_form" action="javascript:void(0);" method="post" onsubmit="toggleAddGroupForm()">
                        <button type="submit" name="add_group" class="btn btn-primary">Ajouter groupe</button>
                    </form>
                </div>
                <div id="addGroupForm">
                    <form action="index.php?action=addgroupe" method="post" class="form-group">
                        <div class="mb-3">
                            <label for="groupName" class="form-label">Nom du groupe</label>
                            <input type="text" class="form-control" id="groupName" name="group_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="groupDescription" class="form-label">Description du groupe</label>
                            <textarea class="form-control" id="groupDescription" name="group_description" rows="3" required></textarea>
                        </div>
                        <div class="d-flex w-100 justify-content-around">
                            <button type="submit" name="submit_new_group" class="btn btn-primary">Créer groupe</button>
                            <button type="button" class="btn btn-secondary" onclick="toggleAddGroupForm()">Annuler</button>
                        </div>
                    </form>
                </div>
                <div class="overlay" id="overlay" onclick="toggleAddGroupForm()"></div>
                <div class="group-card">
                    
                    <?php if (!empty($vosgroupes)) {
                        echo '<h3>Vos groupes</h3>';
                        foreach ($vosgroupes as $group) { ?>
                            <div class="person-card" style="display: flex; align-items: center; gap: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" height="50" width="50" style="border-radius: 50%;">
                                <div>
                                    <h6 style="font-weight: 600; margin: 0;"><?php echo $group->name_group; ?></h6>
                                    <small style="font-size: small; color: #777;"><?php echo $group->description_group; ?></small>
                                </div>
                                <form method="POST" action="index.php?action=exploregroup">
                                    <input type="hidden" value="<?php echo $group->id_group; ?>" name="id_group">
                                    <button class="btn btn-primary open-btn" style="border-color: #2B2757;">Open</button>
                                </form>
                            </div>
                    <?php  }
                        }
                    ?>

                    
                    <?php if (!empty($joingroupes)) {
                        echo '<h3>Groupes aux quels vous avez rejoint</h3>';
                        foreach ($joingroupes as $group) { ?>
                            <div class="person-card" style="display: flex; align-items: center; gap: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" height="50" width="50" style="border-radius: 50%;">
                                <div>
                                    <h6 style="font-weight: 600; margin: 0;"><?php echo $group->name_group; ?></h6>
                                    <small style="font-size: small; color: #777;"><?php echo $group->description_group; ?></small>
                                </div>
                                <form method="POST" action="index.php?action=exploregroup">
                                    <input type="hidden" value="<?php echo $group->id_group; ?>" name="id_group">
                                    <button class="btn btn-primary open-btn" style="border-color: #2B2757;">Open</button>
                                </form>
                            </div>
                    <?php  }
                        }
                    ?>

                    
                    <?php if (!empty($suggestiongroupes)) {
                        echo '<h3>Suggestions</h3>';
                        foreach ($suggestiongroupes as $group) { 
                            $issendinvet = false;
                            ?>
                            <div class="person-card" style="display: flex; align-items: center; gap: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" height="50" width="50" style="border-radius: 50%;">
                                <div>
                                    <h6 style="font-weight: 600; margin: 0;"><?php echo $group->name_group; ?></h6>
                                    <small style="font-size: small; color: #777;"><?php echo $group->description_group; ?></small>
                                </div>
                                <?php
                                    foreach ($invitations as $invitation){
                                        if($invitation->id_groupe == $group->id_group && $invitation->id_user == $id){
                                            $issendinvet = true;
                                            break;
                                        }
                                    }
                                    if($issendinvet == true){
                                        ?>
                                        <button class="btn btn-primary rejoindre-btn" style="border-color: #2B2757;" id="join_groupe" onclick="join_groupe(<?php echo $group->id_group; ?>,event)">Cancel request</button>
                                    <?php }elseif($issendinvet == false){
                                ?>      
                                        <button class="btn btn-primary rejoindre-btn" style="border-color: #2B2757;" id="join_groupe" onclick="join_groupe(<?php echo $group->id_group; ?>,event)">Rejoindre</button>
                                    <?php } ?>
                            </div>
                    <?php  }
                        }
                    ?>
                </div>
            </div>
        </main>
    </div>
    <script>
        function toggleAddGroupForm() {
            var form = document.getElementById('addGroupForm');
            var overlay = document.getElementById('overlay');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'flex';
                overlay.style.display = 'block';

            } else {
                form.style.display = 'none';
                overlay.style.display = 'none';
            }
        }

        $(document).ready(function () {
            window.join_groupe = function (id_groupe,event) {
                if (id_groupe) {
                    if (event.target.innerText === 'Rejoindre') {
                        $.ajax({
                            url: 'index.php?action=join_group',
                            method: 'POST',
                            data: {
                                id_groupe: id_groupe,
                            },
                            success: function () {
                                event.target.innerText = 'Cancel request';
                            },
                            error: function () {
                                event.target.innerText = 'Rejoindre';
                            },
                        });
                    }else{
                        if (event.target.innerText === 'Cancel request') {
                            $.ajax({
                                url: 'index.php?action=cancel_join_group',
                                method: 'POST',
                                data: {
                                    id_groupe: id_groupe,
                                },
                                success: function () {
                                    event.target.innerText = 'Rejoindre';
                                },
                                error: function () {
                                    event.target.innerText = 'Cancel request';
                                },
                            }); 
                        }
                    }
                    
                }
            }
        });
    </script>
</body>
</html>