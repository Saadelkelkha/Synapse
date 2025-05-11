<?php
    require_once 'db.php';

    function select_messages($id_user) {
        $db = database_connection();
    
        $sqlstate = $db->prepare('
            SELECT 
                CASE 
                    WHEN f.user_id_1 = ? THEN f.user_id_2
                    ELSE f.user_id_1
                END AS id_amie,
                u.prenom,
                u.nom,
                u.photo_profil,
                m.id_message,
                m.id_expediteur,
                m.id_destinataire,
                m.message,
                m.audio,
                m.audio_dure,
                m.vue,
                m.date_envoi
            FROM friends f
            JOIN user u ON u.id_user = CASE 
                                         WHEN f.user_id_1 = ? THEN f.user_id_2
                                         ELSE f.user_id_1
                                       END
            LEFT JOIN message m
                ON (
                    (f.user_id_1 = m.id_expediteur AND f.user_id_2 = m.id_destinataire)
                    OR
                    (f.user_id_2 = m.id_expediteur AND f.user_id_1 = m.id_destinataire)
                )
                AND m.id_message = (
                    SELECT MAX(m2.id_message)
                    FROM message m2
                    WHERE
                        (m2.id_expediteur = f.user_id_1 AND m2.id_destinataire = f.user_id_2)
                        OR
                        (m2.id_expediteur = f.user_id_2 AND m2.id_destinataire = f.user_id_1)
                )
            WHERE ? IN (f.user_id_1, f.user_id_2)
            ORDER BY m.id_message DESC;
        ');
    
        $sqlstate->execute([$id_user,$id_user,$id_user]);
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
                m.audio,
                m.audio_dure,
                m.vue,
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

        $sqlstate = $db->prepare('INSERT INTO notification (id_user, id_envoyeur, message) VALUES (?, ?, ?)');
    
        $sqlstate->execute([$id_user,$id_amie,$message]);
    
        $sqlstate = $db->prepare('INSERT INTO message (id_expediteur, id_destinataire, message) VALUES (?, ?, ?)');
    
        $sqlstate->execute([$id_user,$id_amie,$message]);
    }

    function send_audio($id_user,$id_amie,$message,$finalTime){
        $db = database_connection();
    
        $sqlstate = $db->prepare('INSERT INTO message (id_expediteur, id_destinataire, audio, audio_dure) VALUES (?, ?, ?, ?)');
    
        $sqlstate->execute([$id_user,$id_amie,$message,$finalTime]);
    }

    function vue_message($id_message){
        $db = database_connection();
    
        $sqlstate = $db->prepare('UPDATE message SET vue = 1 WHERE id_message = ?');
    
        $sqlstate->execute([$id_message]);
    }
    
?>