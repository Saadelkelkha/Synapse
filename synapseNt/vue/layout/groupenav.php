                <div class="groupe-banner-container">
                    <img class="groupe-banner" src="<?= $group_info->group_banner ?>" width="100%" alt="Group banner">
                    <?php
                    if($is_admin){
                                    
                    ?>
                    <div class="edit-banner-btn">
                        <button class="btn btn-light d-flex align-items-center justify-content-center gap-2 dropdown-btn-modifier"><i class="bi bi-pencil-fill"></i>Edit</button>
                        <div class="dropdown-content-modifier" style="width:180px">
                            <button class="" onclick="changeBanner()">Changer la bannière</button>   
                        </div>
                    </div>
                    <?php
                    }
                                    
                    ?>
                </div>
                <div class="groupe-info w-100 p-2 ps-3 pe-3 bg-white">
                    <h1 class="w-100"><b><?= $group_info->name_group ?></b></h1>
                    <p><?= $group_info->description_group ?></p>
                    <p class="w-100"><?= $countmembres ?> membres</p>
                    <div class="d-flex justify-content-between w-100">
                        <div class="d-flex align-items-center">
                             <?php
                                                $countmembershow = 0;
                                                foreach ($imgmembres as $index => $img) {
                                                    $positionStyle = 'position: relative; margin-left: ' . ($index * -40) . 'px;';
                                                    echo '<img class="navhome1_profile" src="' . htmlspecialchars($img->photo_profil, ENT_QUOTES, 'UTF-8') . '" width="50px" height="50px" alt="Member profile picture" style="' . $positionStyle . '">';
                                                    $countmembershow++;
                                                    if ($countmembershow >= 10) {
                                                        break;
                                                    }
                                                }                
                                                ?>                
                        </div>
                        <div>
                            <button class="btn btn-primary" onclick="addamiepopup(event)">Inviter</button>
                        </div>
                    </div>
                    <nav class="border-top border-2 mt-2 pt-1 d-flex gap-3 justify-content-between">
                        <div  class="d-flex gap-3">
                            <form action="index.php?action=exploregroup" method="post" style="display:inline;">
                                <input type="hidden" value="<?= $id_group; ?>" name="id_group">
                                <button type="submit" class="btn" id="group_discussion">Discussion</button>
                            </form>
                            <?php
                                    if($is_admin){
                                    
                                ?>
                            <form action="index.php?action=invitationgroup" method="post" style="display:inline;">
                                <input type="hidden" value="<?= $id_group; ?>" name="id_group">
                                <button type="submit" class="btn" id="group_invitation">Invitation</button>
                            </form>
                            <?php
                                    }
                                    
                                ?>
                            <form action="index.php?action=membresgroup" method="post" style="display:inline;">
                                <input type="hidden" value="<?= $id_group; ?>" name="id_group">
                                <button type="submit" class="btn" id="group_Membres">Membres</button>
                            </form>
                            <form action="index.php?action=multimedia_groupe" method="post" style="display:inline;">
                                <input type="hidden" value="<?= $id_group; ?>" name="id_group">
                                <button type="submit" class="btn" id="group_multimedia">Multimédia</button>
                            </form>
                        </div>
                        <div >
                            <button class="btn btn-secondary dropdown-btn-modifier">...</button>
                            <div class="dropdown-content-modifier">
                                <?php
                                    if($is_admin){
                                        echo '<button class="" onclick="deleteGroup()">Supprimer le groupe</button>';
                                    }else{
                                        echo '<button class="" onclick="leaveGroup()">Quitter le groupe</button>';
                                    }
                                ?>
                            </div>
                    </nav>
                </div>

                <!-- Invite Member Form -->
                <div id="inviteMemberForm" style="display:none; flex-direction: column; gap: 5px; max-height: 40vh; overflow-y: auto; border-radius: 5px; -ms-overflow-style: none; scrollbar-width: none;">
                    <div style="display: flex;flex-direction: column; justify-content: space-between; align-items: center;">               
                        <div class="p-2 w-100" align="center" style="border-bottom: 1px solid #ddd;">
                            <button type="button" class="btn" onclick="addamiepopup(event)" style="position: absolute; top: -6px; left: -10px;"><i style="font-size: 25px;" class="bi bi-x-lg"></i></button>
                            <b>Inviter des amis</b>
                        </div>
                        <div class="p-3 pb-0 w-100">
                            <input type="text" class="form-control" placeholder="Rechercher un amie...">
                        </div>
                    </div>                
                    <div class="d-flex flex-column align-items-center w-100 p-3" id="amis">
                    
                    </div>
                </div>
                <div class="overlay" id="overlayamie" onclick="addamiepopup(event)"></div>
                <script>
                    function changeBanner() {
                        var overlay = document.createElement('div');
                        overlay.id = 'changeBannerOverlay';
                        overlay.style.position = 'fixed';
                        overlay.style.top = '0';
                        overlay.style.left = '0';
                        overlay.style.width = '100%';
                        overlay.style.height = '100%';
                        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
                        overlay.style.zIndex = '1000';
                        overlay.style.display = 'flex';
                        overlay.style.justifyContent = 'center';
                        overlay.style.alignItems = 'center';

                        var popup = document.createElement('div');
                        popup.style.backgroundColor = 'white';
                        popup.style.padding = '20px';
                        popup.style.borderRadius = '5px';
                        popup.style.textAlign = 'center';
                        popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
                        popup.style.width = '400px';
                        popup.innerHTML = `
                            <p>Choisissez une nouvelle bannière pour le groupe :</p>
                            <input type="file" id="bannerInput" accept="image/*" class="form-control mb-3">
                            <button class="btn btn-primary" id="confirmChangeBanner">Changer</button>
                            <button class="btn btn-secondary" id="cancelChangeBanner">Annuler</button>
                        `;

                        overlay.appendChild(popup);
                        document.body.appendChild(overlay);

                        document.getElementById('confirmChangeBanner').onclick = function () {
                            var fileInput = document.getElementById('bannerInput');
                            if (fileInput.files.length > 0) {
                                var formData = new FormData();
                                formData.append('group_banner', fileInput.files[0]);
                                formData.append('id_group', <?= $id_group ?>);

                                $.ajax({
                                    url: 'index.php?action=change_group_banner',
                                    method: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (res) {
                                        window.location.reload();
                                    },
                                    error: function () {
                                        alert('Une erreur est survenue lors du changement de la bannière.');
                                    },
                                });
                            } else {
                                alert('Veuillez sélectionner une image.');
                            }
                        };

                        document.getElementById('cancelChangeBanner').onclick = function () {
                            document.body.removeChild(overlay);
                        };
                    }              
                    function deleteGroup() {
                        var overlay = document.createElement('div');
                        overlay.id = 'deleteGroupOverlay';
                        overlay.style.position = 'fixed';
                        overlay.style.top = '0';
                        overlay.style.left = '0';
                        overlay.style.width = '100%';
                        overlay.style.height = '100%';
                        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
                        overlay.style.zIndex = '1000';
                        overlay.style.display = 'flex';
                        overlay.style.justifyContent = 'center';
                        overlay.style.alignItems = 'center';

                        var popup = document.createElement('div');
                        popup.style.backgroundColor = 'white';
                        popup.style.padding = '20px';
                        popup.style.borderRadius = '5px';
                        popup.style.textAlign = 'center';
                        popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
                        popup.innerHTML = `
                            <p>Êtes-vous sûr de vouloir supprimer ce groupe ?</p>
                            <button class="btn btn-danger" id="confirmDeleteGroup">Supprimer</button>
                            <button class="btn btn-secondary" id="cancelDeleteGroup">Annuler</button>
                        `;

                        overlay.appendChild(popup);
                        document.body.appendChild(overlay);

                        document.getElementById('confirmDeleteGroup').onclick = function () {
                            $.ajax({
                                url: 'index.php?action=delete_group',
                                method: 'POST',
                                data: {
                                    id_group: <?= $id_group ?>,
                                },
                                success: function () {
                                    window.location.href = 'index.php?action=groups';
                                },
                            });
                            document.body.removeChild(overlay);
                        };

                        document.getElementById('cancelDeleteGroup').onclick = function () {
                            document.body.removeChild(overlay);
                        };
                    }

                    function leaveGroup() {
                        var overlay = document.createElement('div');
                        overlay.id = 'leaveGroupOverlay';
                        overlay.style.position = 'fixed';
                        overlay.style.top = '0';
                        overlay.style.left = '0';
                        overlay.style.width = '100%';
                        overlay.style.height = '100%';
                        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
                        overlay.style.zIndex = '1000';
                        overlay.style.display = 'flex';
                        overlay.style.justifyContent = 'center';
                        overlay.style.alignItems = 'center';

                        var popup = document.createElement('div');
                        popup.style.backgroundColor = 'white';
                        popup.style.padding = '20px';
                        popup.style.borderRadius = '5px';
                        popup.style.textAlign = 'center';
                        popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
                        popup.innerHTML = `
                            <p>Êtes-vous sûr de vouloir quitter ce groupe ?</p>
                            <button class="btn btn-danger" id="confirmLeaveGroup">Quitter</button>
                            <button class="btn btn-secondary" id="cancelLeaveGroup">Annuler</button>
                        `;

                        overlay.appendChild(popup);
                        document.body.appendChild(overlay);

                        document.getElementById('confirmLeaveGroup').onclick = function () {
                            $.ajax({
                                url: 'index.php?action=leave_group',
                                method: 'POST',
                                data: {
                                    id_group: <?= $id_group ?>,
                                    id_user: <?= $id ?>,
                                },
                                success: function () {
                                    window.location.href = 'index.php?action=groups';
                                },
                            });
                            document.body.removeChild(overlay);
                        };

                        document.getElementById('cancelLeaveGroup').onclick = function () {
                            document.body.removeChild(overlay);
                        };
                    } 

                    function addamiepopup(event) {
                        var form = document.getElementById('inviteMemberForm');
                        var overlay = document.getElementById('overlayamie');
                        if (form.style.display === 'none' || form.style.display === '') {
                            form.style.display = 'flex';
                            overlay.style.display = 'block';
                            $.ajax({
                                url: 'index.php?action=select_amie',
                                method: 'POST',
                                data: {
                                    id_user: <?= $id ?>,
                                },
                                success: function (data, status) {
                                    $("#amis").empty();
                                    $.each(data, function(index, inv){
                                        $("#amis").append(`
                                            <div class="person-card mt-2 w-100 d-flex justify-content-between person-card-inv-groupe bg-white" style="display: flex; align-items: center; gap: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                            <div class="d-flex gap-2 align-items-center">
                                                <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" height="50" width="50" style="border-radius: 50%;">
                                                <h6 style="font-weight: 600; margin: 0;">${inv.prenom} ${inv.nom}</h6>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-primary open-btn" style="border-color: #2B2757;" onclick="inviter_amie(${inv.id_user},event)">Inviter</button>
                                            </div>
                                            </div>`
                                        )
                                    });
                                },
                            });
                        } else {
                            form.style.display = 'none';
                            overlay.style.display = 'none';
                        }
                    }

                    function inviter_amie(id_user,event){
                        if (event.target.innerText === 'Inviter') {
                            $.ajax({
                                url: 'index.php?action=invit_amie_group',
                                method: 'POST',
                                data: {
                                    id_user : id_user,
                                    id_groupe: <?=$id_group?>,
                                },
                                success: function () {
                                    event.target.innerText = 'Cancel';
                                },
                                error: function () {
                                    event.target.innerText = 'Inviter';
                                },
                            });
                        }else{
                            if (event.target.innerText === 'Cancel') {
                                $.ajax({
                                    url: 'index.php?action=cancel_invit_group',
                                    method: 'POST',
                                    data: {
                                        id_user: id_user,
                                        id_groupe: <?=$id_group?>,
                                    },
                                    success: function (res) {
                                        event.target.innerText = 'Inviter';
                                    },
                                    error: function () {
                                        event.target.innerText = 'Cancel';
                                    },
                                });                }
                        }
                    }
                </script>