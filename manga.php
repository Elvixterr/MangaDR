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
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="styles/header.css">
  <link rel="stylesheet" href="styles/manga.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="styles/buttons.scss">
  <title>MANGA DR</title>
</head>
<body>

<?php include 'ReusableCode\header.php'; ?>

  <main>
    <section class="top-manga">
        <div class="row-container">
          <!--Aqui se coloca la imagen del manga -->
            <div class="row-container">
                <section class="mainmanga">
                  <!--Aqui se coloca el titulo, la sinopsis, los generos y el estado del manga desde el .js FetchSearchManga -->
                  <div> 
                    <h3 style="text-align: center;"> ADD TO LIST </h3>
                  </div>

                  <div class = "genero" style="justify-content: center;">
                    <div> <button type="button" class="btn btn-secondary custom-button3" id = "leido">Read</button> </div>
                    <div> <button type="button" class="btn btn-secondary custom-button3" id = "leyendo" >Reading</button> </div>
                    <div> <button type="button" class="btn btn-secondary custom-button3" id = "favorito" >Favourite</button> </div>
                    <div> <button type="button" class="btn btn-secondary custom-button3" id = "pendiente">Pending</button> </div>
                    
                    <dialog id="MessageDialog" class="dialogMsg">
                      <!-- Mensaje -->
                    </dialog>

                  </div>
                </section>
            </div>
        </div>
    </section>
    <section class = "top-manga">
      <table class="table" id = "ListaCapitulos" style="text-align: center;">
        <thead>
          <tr>
            <th>CHAPTER</th>
            <th>NAME</th>
            <th>DATE</th>
          </tr>
        </thead>
        <tbody>
        <!-- FILL WITH CHAPTERS-->
        </tbody>
      </table>
    </section>
  </main>

  <?php include 'ReusableCode\footer2.php' ?>

  <script src = "APIS/FetchSearchManga.js"></script>
  <script src="APIS/moment.min.js"></script>
  <script src = "APIS/FetchMangaChapters.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>

</body>
</html>

