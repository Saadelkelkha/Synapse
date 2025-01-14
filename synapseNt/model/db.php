<?php
    function database_connection(){
        return new PDO("mysql:host=localhost;dbname=synapse","root","");
    }
?>