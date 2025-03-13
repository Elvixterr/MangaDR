<?php
session_start();

$flag = false;

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
  }

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
  <title>ADMIN DASHBOARD</title>
</head>
<body>

  <?php include 'ReusableCode\header.php'?>

  <main class="user-infoAdmin">
    <section style="display: flex; flex-direction: column; text-align: center">
    
    <table class="table" style="text-align: center;" id="AdminTable">
      <thead>
      <tr>
          <th>QUANTITY OF REGISTERED USERS</th>
          <th>AMOUNT OF ART. IN READ</th>
          <th>AMOUNT OF ART. IN READING</th>
          <th>AMOUNT OF ART. IN FAVOURITE</th> 
          <th>AMOUNT OF ART. IN PENDING</th> 
          <th>ARTICLES STORED ON OUR SERVER</th>
        </tr>
      </thead>
      <!-- aqui va el body -->
    </table>
  </section>
    

  </main>

  
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <script src = "APIS/Admin.js"></script>
  <?php include 'ReusableCode\footer2.php' ?>
</body>
</html>