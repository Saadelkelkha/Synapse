<?php
    require_once 'model/admin.php';
    require_once 'model/users.php';
    require_once 'model/group.php';
    require_once 'model/home.php';

    function groups(){
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];
        
        if (isset($_POST['submit_search_group'])) {
            $search_group = $_POST['search_group'];

            $vosgroupes = recherchervosGroupParkeywords($id,$search_group);
            $joingroupes = rechercherjoinGroupParkeywords($id,$search_group);
            $suggestiongroupes = recherchersuggestionGroupParkeywords($id,$search_group);
        } else if (isset($_POST['submit_all_group'])) {
            $vosgroupes = recherchervosGroup($id);
            $joingroupes = rechercherjoinGroup($id);
            $suggestiongroupes = recherchersuggestionGroup($id);
        } else {
            $vosgroupes = recherchervosGroup($id);
            $joingroupes = rechercherjoinGroup($id);
            $suggestiongroupes = recherchersuggestionGroup($id);
        }

        $invitations = selectinvitationgroup();
        

        require_once 'vue/group.php';
    }

    function addgroupe($name, $description,$id){
        addgroup($name, $description,$id);
        header('Location: index.php?action=groups');
    }

    function exploregroupe($id_group){
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];

        $group_info = selectGroup($id_group);
        $group_info = $group_info[0];

        $countmemberGroup = countmemberGroup($id_group);
        $countmemberGroup = $countmemberGroup[0];

        $countmembres = $countmemberGroup->count + 1;

        require_once 'vue/exploregroupe.php';
    }

    function joingroup($idgroupe){
        $iduser = $_SESSION['id_user'];
        join_group($idgroupe,$iduser);
        header('Content-Type: application/text');
    }
    function canceljoingroup($idgroupe){
        $iduser = $_SESSION['id_user'];
        canceljoin_group($idgroupe,$iduser);
        header('Content-Type: application/text');
    }

    function invitationgroup($id_group){
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];

        
        $group_info = selectGroup($id_group);
        $group_info = $group_info[0];

        $countmemberGroup = countmemberGroup($id_group);
        $countmemberGroup = $countmemberGroup[0];

        $countmembres = $countmemberGroup->count + 1;

        require_once 'vue/invitationgroup.php';
    }

    function membresgroup($id_group){
        $id = $_SESSION['id_user'];
        $user = selectuser($id);
        $fullname = $user['prenom'] . " " . $user['nom'];

        
        $group_info = selectGroup($id_group);
        $group_info = $group_info[0];

        $countmemberGroup = countmemberGroup($id_group);
        $countmemberGroup = $countmemberGroup[0];

        $countmembres = $countmemberGroup->count + 1;

        require_once 'vue/membresgroup.php';
    }

    function select_invitation_group($id_group){
        $invitations = selectinvitationgroupparid($id_group);
        echo json_encode($invitations);

        header('Content-Type: application/json');
    }

    function select_membres_group($id_group){
        $membres = selectmembresgroupparid($id_group);
        echo json_encode($membres);

        header('Content-Type: application/json');
    }

    function acceptinvit($id_user,$id_groupe){
        acceptinvitation($id_user,$id_groupe);
        rejectinvitation($id_user,$id_groupe);

        header('Content-Type: application/json');
    }

    function rejectinvit($id_user,$id_groupe){
        rejectinvitation($id_user,$id_groupe);

        header('Content-Type: application/json');
    }
?>