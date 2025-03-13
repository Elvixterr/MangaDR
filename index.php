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
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/header.css">
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="styles/buttons.scss">
  <title>MANGA DR</title>
</head>
<body>
  
<?php include 'ReusableCode\header.php'?>

  <nav class="main-navbar">
    <a class="btn btn-secondary custom-button" cursor = 'pointer' href = "?type=korean">MANHWA</a>
    <a class="btn btn-secondary custom-button" cursor = 'pointer' href = "?type=japan">MANGA</a>
    <a class="btn btn-secondary custom-button" cursor = 'pointer' href = "?type=china">MANHUA</a>
  </nav>

  <main class="content">
    <section class="top-manga">
      
    </section>

    <aside class="content-type">
    <nav class="d-grid gap-2 custom-div">
      <a class="btn btn-outline-light custom-button2" type="button" href = "?id=1">LAST UPDATES</a>
      <a class="btn btn-outline-light custom-button2" type="button" href = "?id=2">TOP MANGAS</a>
      <a class="btn btn-outline-light custom-button2" type="button" href = "?id=3">RECENTLY ADDED</a>
    </nav>
      <div class="ad">
        <img class="ad-image" src="images/logo.jpg">
      </div>
      <div class="ad">
        <img class="ad-image" src="images/logo.jpg">
      </div>
      <div class="ad">
        <img class="ad-image" src="images/logo.jpg">
      </div>
    </aside>
  </main>

  <?php include 'ReusableCode\footer2.php' ?>

  <script src="APIS/FetchMangaApi.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>