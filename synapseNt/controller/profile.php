<?php
require_once 'model/profile.php';

function afficherPostProfileController(){
   
    $posts = afficherPostProfil();
    require_once 'vue/profile-photos.php';
   
   
}

?>