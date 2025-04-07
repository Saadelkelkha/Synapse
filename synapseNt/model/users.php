<?php

    require_once 'db.php';

    function check_email($email) {
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM user WHERE email = ?");
        $sqlstate->execute([$email]);

        $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return true;
        }else{
            $sqlstate = $db->prepare("SELECT * FROM admin WHERE email = ?");
            $sqlstate->execute([$email]);

            $admin = $sqlstate->fetch(PDO::FETCH_ASSOC);
            
            if ($admin) {
                $_SESSION['is_admin'] = true;
                return true;
            }else{
                return false;
            }
        }
    }

    function check_password($email, $pass){
        $db = database_connection();

        if($_SESSION["is_admin"]){
            $sqlstate = $db->prepare("SELECT * FROM admin WHERE EMAIL = ?");
            $sqlstate->execute([$email]);

            $admin = $sqlstate->fetch(PDO::FETCH_ASSOC);

            if ($admin) {
                if (password_verify($pass, $admin['password'])){
                    $_SESSION['id_admin'] = $admin['id_admin'];
                    $_SESSION['conn'] = true;
                    return true;
                }
            }else{
                $_SESSION["is_admin"] = false;
                return false;
            }

        }else{
            $sqlstate = $db->prepare("SELECT * FROM user WHERE EMAIL = ?");
            $sqlstate->execute([$email]);

            $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($pass, $user['password'])){
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['conn'] = true;
                    return true;
                }
            }else{
                return false;
            }
        }
    }

    function addUser($prenom,$nom,$logdate,$email,$password){
        $db = database_connection();
        $query = $db->prepare("INSERT INTO user(id_user,prenom,nom,date_naissance,email,password) values(null,?,?,?,?,?)");
        $query->execute([$prenom,$nom,$logdate,$email,$password]);

        $sqlstate = $db->prepare("SELECT * FROM user WHERE EMAIL = ?");
        $sqlstate->execute([$email]);
        $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['conn'] = true;

        if ($user) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['conn'] = true;
        }
    }

    function UpdatePassword($email,$password,$admin){
        $db = database_connection();
        if($admin){
            $query = $db->prepare("UPDATE admin SET PASSWORD = ? WHERE EMAIL = ?");
        }else{
            $query = $db->prepare("UPDATE user SET PASSWORD = ? WHERE EMAIL = ?");
        }
        $query->execute([$password,$email]);
    }

    function add_token($email,$token,$expiry){
        if($_SESSION["is_admin"]){
            $is_admin = 1;
        }else{
            $is_admin = 0;
        }
        $db = database_connection();
        $query = $db->prepare("INSERT INTO password_resets(email, token, expire_at, is_admin) values(?,?,?,?)");
        $query->execute([$email,$token,$expiry,$is_admin]);
        $_SESSION["is_admin"] = false;
    }

    function check_token($token){
        $db = database_connection();
        $query = $db->prepare("SELECT email FROM password_resets WHERE token = ? AND expire_at > NOW()");
        $query->execute([$token]);
        $email = $query->fetch(PDO::FETCH_ASSOC);
        if ($email){
            return $email['email'];
        }else{
            return false;
        }
    }

    function delete_token($email){
        $db = database_connection();
        $query = $db->prepare("DELETE FROM password_resets WHERE email = ?");
        $query->execute([$email]);
    }

    function selectuser($id){
        $db = database_connection();

        $sqlstate = $db->prepare("SELECT * FROM user WHERE id_user = ?");
        $sqlstate->execute([$id]);
        $user = $sqlstate->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        }else{
            return [];
        }
    }

    function selectcomments($id_post_groupe){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM comment_post JOIN user ON user.id_user = comment_post.id_user  WHERE id_post_groupe = ? ORDER BY id_groupe_comment DESC');
        $sqlstate->execute([$id_post_groupe]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function getlikescomment_home($id_groupe_post){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT comment_like_post.* FROM comment_like_post join comment_post on comment_like_post.id_comment = comment_post.id_groupe_comment WHERE comment_post.id_post_groupe = ?');
        $sqlstate->execute([$id_groupe_post]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function selectresponsehome($id_comment){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM reply_comment join user on reply_comment.id_user = user.id_user where reply_comment.id_comment_grp = ?');
        $sqlstate->execute([$id_comment]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function getlikesreplycomment_home($id_comment){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT reply_like.* FROM reply_like join reply_comment on reply_like.id_reply_grp = reply_comment.id_reply_grp WHERE reply_comment.id_comment_grp = ?');
        $sqlstate->execute([$id_comment]);
        return $sqlstate->fetchAll(PDO::FETCH_OBJ);
    }

    function submitcommentlike_home($id_comment,$idm){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO comment_like_post(id_comment,id_user) VALUES(?,?)');
        $sqlstate->execute([$id_comment,$idm]);
    }

    function submitreplylike_home($id_reply,$idm){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO reply_like(id_reply_grp,id_user) VALUES(?,?)');
        $sqlstate->execute([$id_reply,$idm]);
    }

    function removeereplylike_home($id_reply,$idm){
        $db = database_connection();

        $sqlstate = $db->prepare('DELETE FROM reply_like WHERE id_reply_grp = ? AND id_user = ?');
        $sqlstate->execute([$id_reply,$idm]);
    }

    function removeecommentlike_home($id_comment,$idm){
        $db = database_connection();

        $sqlstate = $db->prepare('DELETE FROM comment_like_post WHERE id_comment = ? AND id_user = ?');
        $sqlstate->execute([$id_comment,$idm]);
    }

    function submit_reply($id,$groupe_comment,$reply_to){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO reply_comment(id_comment_grp,id_user,content_reply_grp) VALUES (?,?,?)');
        $sqlstate->execute([$reply_to,$id,$groupe_comment]);
    }

    function selectreply($idm){
        $db = database_connection();

        $sqlstate = $db->prepare('SELECT * FROM reply_comment join user on reply_comment.id_user =  user.id_user where reply_comment.id_user = ?  order by id_reply_grp desc limit 1;');
        $sqlstate->execute([$idm]);
        return $sqlstate->fetch(PDO::FETCH_OBJ);
    }

    function submit_comment($id,$id_groupe_post,$groupe_comment){
        $db = database_connection();

        $sqlstate = $db->prepare('INSERT INTO comment_post(id_post_groupe,id_user,groupe_comment_content) VALUES (?,?,?)');
        $sqlstate->execute([$id_groupe_post,$id,$groupe_comment]);
    }
?>