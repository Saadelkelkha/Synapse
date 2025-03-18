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
        #group_multimedia{
            border-bottom: 2px solid #2B2757;
            color:#2B2757;
        }

        .dropdown-content-modifier {
            display: none;
            position: absolute;
            right: 0;
            left: auto;
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
    </style>
</head>
<body>
    <div class="mt-3">
        <?php require_once 'vue/layout/navhome1.php'; ?>

        <main class="mt-1 d-flex">
            <?php require_once 'vue/layout/navhome2.php'; ?>
            <div class="explore_groupe">
                <?php require_once 'vue/layout/groupenav.php'; ?>
                <div class="p-3 w-100">
                    <div class="container bg-white p-4 shadow" style="border-radius: 10px;">
                        <h4 style="font-weight: bold;">Contenu multimédia</h4>

                        <div  class="d-flex gap-3">
                            <p class="btn" onclick="showimage(event)" style="border-bottom: 2px solid #2B2757;color:#2B2757;">Photos</p>
                            <p class="btn text-muted" onclick="showvideo(event)">Vidéos</p>
                        </div>
                        <div class="row">
                            <?php
                                foreach($postes_contenu as $post) {
                                    if(!empty($post->image_path_groupe) && exif_imagetype($post->image_path_groupe)) {
                                        echo "<span class='col-6 col-sm-6 col-md-4 col-lg-3 mb-3' style='height: 200px;'>";
                                        echo "<img class='h-100 w-100 image-hover shadow' src='$post->image_path_groupe' style='object-fit: cover; cursor: pointer; border-radius: 10px;' onclick=\"showPopup('$post->image_path_groupe')\" onmouseover=\"this.style.opacity='0.5';\" onmouseout=\"this.style.opacity='1';\">";
                                        echo "</span>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        function showPopup(contentPath, isVideo = false) {
            // Create the popup container
            const popup = document.createElement('div');
            popup.style.position = 'fixed';
            popup.style.top = '0';
            popup.style.left = '0';
            popup.style.width = '100%';
            popup.style.height = '100%';
            popup.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
            popup.style.display = 'flex';
            popup.style.justifyContent = 'center';
            popup.style.alignItems = 'center';
            popup.style.zIndex = '1000';

            if (isVideo) {
                // Create the video element
                const video = document.createElement('video');
                video.src = contentPath;
                video.controls = true;
                video.style.maxWidth = '90%';
                video.style.maxHeight = '90%';
                video.style.borderRadius = '10px';
                video.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
                popup.appendChild(video);
            } else {
                // Create the image element
                const img = document.createElement('img');
                img.src = contentPath;
                img.style.maxWidth = '90%';
                img.style.maxHeight = '90%';
                img.style.borderRadius = '10px';
                img.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
                popup.appendChild(img);
            }

            // Add click event to close the popup
            popup.addEventListener('click', () => {
                document.body.removeChild(popup);
            });

            // Append the popup to the body
            document.body.appendChild(popup);
        }

        function showvideo(event) {
            const photoTab = event.target.previousElementSibling;
            const videoTab = event.target;
            const contentContainer = document.querySelector('.row');

            // Update tab styles
            photoTab.style.borderBottom = 'none';
            photoTab.style.color = '#6c757d';
            videoTab.style.borderBottom = 'none';
            videoTab.style.color = '#6c757d';
            event.target.style.borderBottom = '2px solid #2B2757';
            event.target.style.color = '#2B2757';
            event.target.classList.remove('text-muted');
            event.target.previousElementSibling.classList.add('text-muted');

            // Clear existing content
            contentContainer.innerHTML = '';

            // Add video content dynamically
            <?php
            foreach ($postes_contenu as $post) {
                if (!empty($post->image_path_groupe) && pathinfo($post->image_path_groupe, PATHINFO_EXTENSION) === 'mp4') {
                    echo "{";
                    echo "let videoCol = document.createElement('span');";
                    echo "videoCol.className = 'col-6 col-sm-6 col-md-4 col-lg-3 mb-3';";
                    echo "videoCol.style.height = '200px';";
                    echo "videoCol.innerHTML = `<video class='h-100 w-100 shadow' style='object-fit: cover; cursor: pointer;border-radius: 10px;' src='$post->image_path_groupe' onclick=\"showPopup('$post->image_path_groupe', true)\" onmouseover=\"this.style.opacity='0.5';\" onmouseout=\"this.style.opacity='1';\"></video>`;";
                    echo "contentContainer.appendChild(videoCol);";
                    echo "}";
                }
            }
            ?>
        }

        function showimage(event) {
            const photoTab = event.target;
            const videoTab = event.target.nextElementSibling;
            const contentContainer = document.querySelector('.row');

            // Update tab styles
            videoTab.style.borderBottom = 'none';
            videoTab.style.color = '#6c757d';
            photoTab.style.borderBottom = 'none';
            photoTab.style.color = '#6c757d';
            event.target.style.borderBottom = '2px solid #2B2757';
            event.target.style.color = '#2B2757';
            event.target.classList.remove('text-muted');
            event.target.nextElementSibling.classList.add('text-muted');


            // Clear existing content
            contentContainer.innerHTML = '';

            // Add video content dynamically
            <?php
            foreach ($postes_contenu as $post) {
                if (!empty($post->image_path_groupe) && exif_imagetype($post->image_path_groupe)) {
                    echo "{";
                    echo "let imageCol = document.createElement('span');";
                    echo "imageCol.className = 'col-6 col-sm-6 col-md-4 col-lg-3 mb-3';";
                    echo "imageCol.style.height = '200px';";
                    echo "imageCol.innerHTML = `<img class='h-100 w-100 image-hover shadow' style='object-fit: cover; cursor: pointer;border-radius: 10px;-*' src='$post->image_path_groupe' onclick=\"showPopup('$post->image_path_groupe')\" onmouseover=\"this.style.opacity='0.5';\" onmouseout=\"this.style.opacity='1';\">`;";
                    echo "contentContainer.appendChild(imageCol);";
                    echo "}";
                }
            }
            ?>
        }

        document.querySelectorAll('.dropdown-btn-modifier').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const dropdownContent = button.nextElementSibling;
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
</body>
</html>