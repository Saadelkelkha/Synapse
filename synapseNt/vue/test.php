<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barre de Navigation Facebook</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
          
            padding: 10px 20px;
        }
        .search-bar {
            background-color: #3A3B3C;
            padding: 8px 12px;
            border-radius: 20px;
            color: white;
            border: none;
        }
        .icons {
            display: flex;
            gap: 20px;
        }
        .icon {
            position: relative;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }
        .notification {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            font-size: 12px;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <input type="text" class="search-bar" placeholder="Rechercher sur Facebook">
        <div class="icons">
            <div class="icon">
                <i class="fas fa-home"></i>
                <span class="notification">1</span>
            </div>
            <div class="icon">
                <i class="fas fa-tv"></i>
            </div>
            <div class="icon">
                <i class="fas fa-store"></i>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="icon">
                <i class="fas fa-gamepad"></i>
            </div>
        </div>
    </nav>
</body>
</html>
