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
        #group_discussion{
            border-bottom: 2px solid #2B2757;
            color:#2B2757;
        }

        /* Popup styles */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none; /* Hidden by default */
            z-index: 1000;
            text-align: center;
        }

        .popup h2 {
            margin-bottom: 10px;
        }

        .popup button {
            background-color: #2B2757;
        }

        /* Overlay to dim background */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none; /* Hidden by default */
            z-index: 999;
        }

        .creer-poste {
            
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container_creer{
            width: 400px;
            overflow: hidden;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
            z-index: 300;
            position: relative;
        }

        .post header {
            font-size: 22px;
            font-weight: 600;
            padding: 17px 0;
            text-align: center;
        }

        .post form {
            margin: 20px 25px;
        }

        form textarea {
            width: 100%;
            resize: none;
            font-size: 18px;
            min-height: 100px;
            outline: none;
            border: none;
            margin-bottom: 15px;
        }

        #uploadedImageContainer img {
            height: 100px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 80%;
            margin-top: 10px;
        }

        #uploadedImageContainer {
            display: flex;
            justify-content: center;
        }

        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 57px;
            margin: 15px 0;
            padding: 0 15px;
            border-radius: 7px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .options p {
            color: #595959;
            font-size: 15px;
            font-weight: 500;
            cursor: default;
        }

        .options .list {
            display: flex;
            list-style: none;
        }

        .options .list li {
            cursor: pointer;
        }

        .options .list li label {
            cursor: pointer;
            display: inline-block;
            padding: 10px;
        }

        .options .list li input[type="file"] {
            display: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background-color: #2B2757;
            border: none;
            border-radius: 8px;
            cursor: pointer;

        }

        input[type="submit"]:hover {
            background-color:rgb(47, 41, 112);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .dropdown {
                    position: relative;
                    display: inline-block;
                }
        .dropdown-btn {
            background-color: while;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown-content.show {
            display: block;
        }

        .dropdown-content a {
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }
        .dropdown.show .dropdown-content {
            display: block;
        }
        .btn-enregsitrer{
            color:black;
            background-color:white;
        }
        .btn-enregistrer i:hover{
            color:white;
        }

        .hidden-modifier {
            display: none;
        }

        .overlay-modifier {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
        }

        .overlay-supprimer{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
        }

        .popup-modifier {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 30px;
            border-radius: 10px;
            z-index: 1100;
            width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .popup-modifier header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .popup-modifier textarea {
            width: 100%;
            height: 100px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .popup-modifier .options-modifier {
            text-align: left;
            margin-bottom: 20px;
        }

        .popup-modifier .options-modifier p {
            margin: 0;
            font-size: 1rem;
            color: #555;
        }

        .popup-modifier .options-modifier label {
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
        }

        .popup-modifier .options-modifier label img {
            width: 24px;
            height: 24px;
        }

        .popup-modifier button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            margin: 5px;
            width: calc(50% - 10px);
        }

        .popup-modifier button:hover {
            background-color: #45a049;
        }

        .popup-modifier .close-popup-btn-modifier {
            background-color: #f44336;
        }

        .popup-modifier .close-popup-btn-modifier:hover {
            background-color: #e53935;
        }

        .dropdown-modifier {
            position: relative;
            display: inline-block;
        }

        .dropdown-content-modifier {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
            border-radius: 5px;
        }

        .dropdown-content-modifier button,
        .dropdown-content-modifier a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            text-align: left;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
        }

        .dropdown-content-modifier button:hover,
        .dropdown-content-modifier a:hover {
            background-color: #f3f4f6;
        }

        .dropdown-modifier .dropdown-btn-modifier:focus + .dropdown-content-modifier {
            display: block;
        }

        .enregistrer-annuler-btn{
            display:flex;
        }
    </style>
</head>
<body>
    <div class="mt-3">
        <?php require_once 'vue/layout/navhome1.php'; ?>

        <main class="mt-1 d-flex">
            <?php require_once 'vue/layout/navhome2.php'; ?>
            <div class="explore_groupe">
            <div class="groupe-banner-container">
                    <img class="groupe-banner" src="<?= $group_info->group_banner ?>" width="100%" alt="Group banner">
                </div>
                <div class="groupe-info w-100 p-2 ps-3 pe-3 bg-white">
                    <h1 class="w-100"><b><?= $group_info->name_group ?></b></h1>
                    <p><?= $group_info->description_group ?></p>
                    <p class="w-100"><?= $countmembres ?> membres</p>
                    <div class="d-flex justify-content-between w-100">
                        <div class="d-flex align-items-center">
                            <img class="navhome1_profile" src="img/Profile/Julia Clarke.png" width="50px" height="50px">
                        </div>
                        <div>
                                <?php
                                    $issendinvet = false;
                                    foreach ($invitations as $invitation){
                                        if($invitation->id_groupe == $id_groupe && $invitation->id_user == $id){
                                            $issendinvet = true;
                                            break;
                                        }
                                    }
                                    if($issendinvet == true){
                                        ?>
                                        <button class="btn btn-primary" style="border-color: #2B2757;" id="join_groupe" onclick="join_groupe(<?php echo $id_groupe; ?>,event)">Cancel request</button>
                                    <?php }elseif($issendinvet == false){
                                ?>      
                                        <button class="btn btn-primary" style="border-color: #2B2757;" id="join_groupe" onclick="join_groupe(<?php echo $id_groupe; ?>,event)">Rejoindre</button>
                                    <?php } ?>
                        </div>
                    </div>
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
            </div>
        </main>
    </div>

    <script>
        
    </script>
</body>
</html>