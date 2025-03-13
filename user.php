<?php
session_start();

$flag = false;
$case = false;

if (!isset($_SESSION['username'])) {
  $username = "GUEST";
}
else
{
  $username = $_SESSION['username'];
  $flag = true;

  include "db/connectDB.php";

  $SearchIdUser = "SELECT id FROM cuenta WHERE username = '$username'";
  $result = $conn->query($SearchIdUser);

  if ($result->num_rows > 0) 
  {
    $row = $result->fetch_assoc();
    $idUser = $row["id"];

    $Avatar = "SELECT avatar FROM cuenta where id = '$idUser'";
    
    $result = $conn->query($Avatar);
    if ($result->num_rows > 0) 
    {
      $row = $result->fetch_assoc();
      $imagenBinaria = $row["avatar"];
      
      if (!empty($imagenBinaria)) 
      {
        $imagenBase64 = base64_encode($imagenBinaria);
      } else 
      {
        // El campo avatar está vacío
        $flag = false;
        $case = true;
      }
    }
    else
    {
      $flag = false;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/header.css">
  <link rel="stylesheet" href="styles/navbar.css">
  <link rel="stylesheet" href="styles/user.css">
  <link rel="stylesheet" href="styles/buttons.scss">
  <link rel="stylesheet" href="styles/footer.css">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/buttons.scss">
  <title>MANGA DR: USER</title>
</head>
<body>

  <?php include 'ReusableCode\header.php'?>

  <main class="user-info">
    <section style="display: flex; flex-direction: column; text-align: center">
    <?php
    if($flag){
      echo '<img class="user-pic" src="data:image/jpeg;base64,' . $imagenBase64 . '" alt="Imagen">
            <input type="file" name ="imagen" id="fileInput" style="display: none;" accept="image/*">
            <label for="fileInput" style="cursor: pointer; text-align: center; color:#3366FF;"><p>Change Profile Picture!</p></label>';
    }
    else
    {
      if($case)
      {
        if ($username === 'admin')
        {
          echo '<img class="user-pic" src="images/GuestPhoto.jpg">
          <label style="cursor: pointer; text-align: center; color:#3366FF;" onclick = "window.location.href = `admin.php`;"><p> PAGE DASHBOARD </p></label>';
        }
        else
        {
          echo '<img class="user-pic" src="images/GuestPhoto.jpg">
          <input type="file" name ="imagen" id="fileInput" style="display: none;" accept="image/*">
          <label for="fileInput" style="cursor: pointer; text-align: center; color:#3366FF;"><p>Change Profile Picture!</p></label>';
        }
     }
      else
      {
        echo '<img class="user-pic" style="margin-bottom: 30px" src="images/GuestPhoto.jpg">';
      }
    }
    ?> 
  </section>
    
    <div class="user-name"> <?php echo $username ?> </div>

  </main>

  <nav class="main-navbar2">
    <div class="btn btn-secondary custom-button" id="leido">Read</div>
    <div class="btn btn-secondary custom-button" id="leyendo">Reading</div>
    <div class="btn btn-secondary custom-button" id="favorito">Favourite</div>
    <div class="btn btn-secondary custom-button" id="pendiente">Pending</div>

    <dialog id="MessageDialog" class="dialogMsg">
    </dialog>
  </nav>

  <section class="top-manga">
    <!-- Esto se llena con FetchListUser -->
  </section>
  
  <script src="APIS/FetchListUser.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <?php include 'ReusableCode\footer2.php' ?>
</body>
</html>