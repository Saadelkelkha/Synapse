<?php
if(isset($_POST['annulerModifier'])){
    header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar and Sidebar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/home.css" />
    <style>
        textarea {
            width: 100%;
            resize: none;
            font-size: 18px;
            min-height: 100px;
           
            margin-bottom: 15px;
        }
      
        form{
            width:100%;
        }
        .img-nom5{
            display:flex;
            gap:8px;
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
    </style>
</head>
<body>
    <div class=" mt-3">
        <!-- Navbar -->
        <?php require_once 'vue/layout/navhome1.php'; ?>

        <main class="mt-1 d-flex">
            <!-- Sidebar -->
            <?php require_once 'vue/layout/navhome2.php'; ?>
           

            <!-- Formulaire de création de post -->
            <div class="content_chat">
              <div class="content flex-grow-1">
                  <!-- Formulaire de création de post -->

                  <!-- Feed -->
                  <?php if ($post) { ?>
    <div class="feed" width="100%">
        <div class="user">
            <div class="profile-pic mt-3" width="100%" style="display: flex; gap: 10px;">
                <form action="index.php?action=modifierPost" enctype="multipart/form-data" method="post">
                    <div class="name1">
                        <div class="img-nom5">
                            <img src="img/Profile/Julia Clarke.png" alt="">
                            <h5 class="mt-2">Ahmed Said</h5>
                        </div>
                        <input type="hidden" name="id_post" value="<?php echo htmlspecialchars($post->id_post); ?>">

                        <textarea class="form-control mt-3" placeholder="What's on your mind, SynapseNt?" rows="3" name="text_content"><?php echo htmlspecialchars($post->text_content); ?></textarea>

                        <div class="options">
                            <label for="imageInput">Choisir une nouvelle image</label>
                            <div id="uploadedImageContainer"></div>
                            <input type="file" id="imageInput" name="image" accept="image/*">
                        </div>
                        
                    </div>
                    <button class="btn btn-primary" id="supprimerPhoto">Supprimer La photo</button>
                    <input type="hidden" name="oldimagepath" value="<?php echo htmlspecialchars($post->image_path);  ?>">
                    <input type="hidden" name="oldimagepathTrue" value="true">
                    <img class="image-width" height="500px" width="100%" src="<?php echo htmlspecialchars($post->image_path); ?>" alt="Image du post">
                    <br>
                    <button class="btn btn-primary mt-1" name="modifier">Modifier</button>
                    
                </form>
              
            </div>
        </div>
       
    </div>
<?php } else { ?>
    <p>Erreur : Aucun post trouvé.</p>
<?php } ?>



        </main>
        <?php include 'chatbot1.php'; ?>
    </div>

    <script>

document.getElementById("imageInput").addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const uploadedImageContainer = document.getElementById("uploadedImageContainer");
            uploadedImageContainer.innerHTML = `<img src="${e.target.result}" alt="Uploaded Image">`;
        };
        reader.readAsDataURL(file);
    }
});

    </script>

</body>
</html>