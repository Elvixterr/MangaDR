<?php
session_start();

if (!isset($_SESSION['username'])) {
  $username = "GUEST";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/header.css">
  <link rel="stylesheet" href="styles/reader.css">
  <link rel="stylesheet" href="styles/buttons.scss">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="styles/buttons.scss">
  <title>MANGA DR</title>
</head>
<body>

  <?php include 'ReusableCode\header.php'?>

  <main class="main-container" id ="maincont">
    
    <!--div class="manga-info">
      
    </div-->
    <!--div class = "main-container">
     <img class="manga-read" src="images/berserk.png">
     <img class="manga-read" src="images/berserk.png">
    </div-->
    <!--div id="chapter">
      <button>Capitulo anterior</button>
      <button>Capitulo siguiente</button>
    </div-->
  </main>

  <script src = "APIS/FetchMangaImages.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>