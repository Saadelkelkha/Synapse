<?php
    require_once 'db.php';

    function select_messages($id_user) {
        $db = database_connection();
    
        $sqlstate = $db->prepare('
            SELECT
                f.id_amie,
                u.prenom,
                u.nom,
                u.photo_profil,
                m.id_message,
                m.id_expediteur,
                m.id_destinataire,
                m.message,
                m.date_envoi
            FROM followers f
            JOIN user u ON u.id_user = f.id_amie
            LEFT JOIN message m
                ON (
                    (f.id_user = m.id_expediteur AND f.id_amie = m.id_destinataire)
                    OR
                    (f.id_user = m.id_destinataire AND f.id_amie = m.id_expediteur)
                )
                AND m.id_message = (
                    SELECT MAX(m2.id_message)
                    FROM message m2
                    WHERE
                        (m2.id_expediteur = f.id_user AND m2.id_destinataire = f.id_amie)
                        OR
                        (m2.id_expediteur = f.id_amie AND m2.id_destinataire = f.id_user)
                )
            WHERE f.id_user = ?
            ORDER BY m.id_message DESC
        ');
    
        $sqlstate->execute([$id_user]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function select_messagesamie($id_amie,$id_user){
        $db = database_connection();
    
        $sqlstate = $db->prepare('
            SELECT 
                m.id_message,
                m.id_expediteur,
                m.id_destinataire,
                m.message, 
                m.date_envoi
            FROM message m
            WHERE 
                (m.id_expediteur = ? AND m.id_destinataire = ?)
                OR 
                (m.id_expediteur = ? AND m.id_destinataire = ?)
            ORDER BY m.date_envoi ASC; 
        ');
    
        $sqlstate->execute([$id_user,$id_amie,$id_amie,$id_user]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function select_amieinfo($id_amie){
        $db = database_connection();
    
        $sqlstate = $db->prepare('SELECT prenom, nom, photo_profil from user where id_user = ?');
    
        $sqlstate->execute([$id_amie]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }

    function send_message($id_user,$id_amie,$message){
        $db = database_connection();
    
        $sqlstate = $db->prepare('INSERT INTO message (id_expediteur, id_destinataire, message) VALUES (?, ?, ?)');
    
        $sqlstate->execute([$id_user,$id_amie,$message]);
    }
    
?>