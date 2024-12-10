<?php
    function database_connection(){
        return new PDO("mysql:host=localhost;dbname=synapse","root","");
    }

    function check_email($email) {
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM user WHERE EMAIL = ?");
        $sqlstate->execute([$email]);

        $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return true;
        }
        return false; 
    }

    function check_password($email, $pass){
        $db = database_connection();

        // Prepare the SQL query to fetch the user by email
        $sqlstate = $db->prepare("SELECT * FROM user WHERE EMAIL = ?");
        $sqlstate->execute([$email]);

        // Fetch the user data
        $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password using password_verify  password_verify($pass, $user['PASSWORD'])
            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            if (password_verify($pass, $user['PASSWORD'])){
                $_SESSION['ID_USER'] = $user['ID_USER'];
                $_SESSION['ISCONNECTED'] = true;
                return true; // Login successful
            }
        }
        return false; // Login failed
    }

    function addUser($prenom,$nom,$logdate,$email,$password){
        $db = database_connection();
        $query = $db->prepare("INSERT INTO user values(null,?,?,?,?,?)");
        $query->execute([$prenom,$nom,$logdate,$email,$password]);

        $sqlstate = $db->prepare("SELECT * FROM user WHERE EMAIL = ?");
        $sqlstate->execute([$email]);
        $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

        $_SESSION['ID_USER'] = $user['ID_USER'];
        $_SESSION['ISCONNECTED'] = true;

        if ($user) {
            $_SESSION['ID_USER'] = $user['ID_USER'];
            $_SESSION['ISCONNECTED'] = true;
        }
    }
?>