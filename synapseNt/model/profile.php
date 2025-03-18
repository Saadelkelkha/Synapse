<?php
require_once "db.php";

function afficherPostProfil(){
    $pdo = new PDO("mysql:host=localhost;dbname=synapse", "root", "");
    $id = $_SESSION['id_user'];
    $sqlState = $pdo->query('SELECT image_path FROM post'); 
    
    $posts = $sqlState->fetchAll(PDO::FETCH_OBJ);}
?>