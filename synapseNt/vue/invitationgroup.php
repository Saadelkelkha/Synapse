<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Explore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/home.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #group_invitation{
            border-bottom: 2px solid #2B2757;
            color:#2B2757;
        }
    </style>
</head>
<body>
    <div class="mt-3">
        <?php require_once 'vue/layout/navhome1.php'; ?>

        <main class="mt-1 d-flex">
            <?php require_once 'vue/layout/navhome2.php'; ?>
            <div class="explore_groupe">
                <?php require_once 'vue/layout/groupenav.php'; ?>
                <div class="d-flex flex-column align-items-center w-100 pt-5 pb-5" id="invitationsection">
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary" onclick="fetchMembres()"><i class="bi bi-arrow-clockwise"></i></button>
                    </div>
                </div>
              </div>
            </div>
        </main>
    </div>
    <script>
        $.ajax({
                url: 'index.php?action=select_invitation_group',
                method: 'POST',
                data: {
                    id_groupe: <?=$id_group?>,
                },
                success: function (data, status) {
                    $.each(data, function(index, inv){
                        $("#invitationsection").append(`
                            <div class="person-card d-flex justify-content-between person-card-inv-groupe bg-white" style="display: flex; align-items: center; gap: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                            <div class="d-flex gap-2 align-items-center">
                                <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" height="50" width="50" style="border-radius: 50%;">
                                <h6 style="font-weight: 600; margin: 0;">${inv.prenom} ${inv.nom}</h6>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary open-btn" style="border-color: #2B2757;" onclick="acceptinvit(${inv.id_user},event)">Accept</button>
                                <button class="btn btn-secondary open-btn" onclick="rejectinvit(${inv.id_user},event)">Reject</button>
                            </div>
                            </div><br>`
                        )
                    })
                },
        });
        function fetchInvitations() {
            $.ajax({
                url: 'index.php?action=select_invitation_group',
                method: 'POST',
                data: {
                    id_groupe: <?=$id_group?>,
                },
                success: function (data, status) {
                    $("#invitationsection").empty();
                    $("#invitationsection").append(`
                        <div class="d-flex justify-content-center mt-3">
                            <button class="btn btn-primary" onclick="fetchMembres()"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                    `)
                    $.each(data, function(index, inv){
                        $("#invitationsection").append(`
                            <div class="person-card d-flex justify-content-between person-card-inv-groupe bg-white" style="display: flex; align-items: center; gap: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                            <div class="d-flex gap-2 align-items-center">
                                <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" height="50" width="50" style="border-radius: 50%;">
                                <h6 style="font-weight: 600; margin: 0;">${inv.prenom} ${inv.nom}</h6>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary open-btn" style="border-color: #2B2757;" onclick="acceptinvit(${inv.id_user},event)">Accept</button>
                                <button class="btn btn-secondary open-btn" onclick="rejectinvit(${inv.id_user},event)">Reject</button>
                            </div>
                            </div><br>`
                        )
                    })
                },
            });
        }

        $(document).ready(function () {
            window.acceptinvit = function (id_user,event) {
                if (id_user){
                        $.ajax({
                            url: 'index.php?action=acceptinvit',
                            method: 'POST',
                            data: {
                                id_groupe: <?=$id_group?>,
                                id_user: id_user,
                            },
                            success: function(){
                                fetchMembres();
                            },
                            error: function(){
                                fetchMembres();
                            }
                        });
                }
            }
        });

        $(document).ready(function () {
            window.rejectinvit = function (id_user,event) {
                if (id_user){
                        $.ajax({
                            url: 'index.php?action=rejectinvit',
                            method: 'POST',
                            data: {
                                id_groupe: <?=$id_group?>,
                                id_user: id_user,
                            },
                            success: function(){
                                fetchMembres();
                            },
                            error: function(){
                                fetchMembres();
                            }
                        });
                }
            }
        });
    </script>
</body>
</html>