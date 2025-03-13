<?php

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
      }
    }
    else
    {
      $flag = false;
    }
  }
}
?>

<style>

  .search-box{
    width: 400px;
    background: #fff;
    margin: 0.1px auto 0;
    margin-left: 620px;
    border-radius: 5px;

  }
  
  .row{
    display: flex;
    flex-direction: row;
    align-items: center;
    padding:10px 20px;
  }
  
  input{
    flex: 1;
    height: 20px;
    background: transparent;
    border: 0;
    outline: 0;
    font-size: 18px;
    color: #333;
  }

  .menu-container {
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-right: 100px;
}

.menu-toggle {
    display: none;
}

.menu-label {
    margin-top: 5px;
    cursor: pointer;
    padding: 10px 15px;
    background-color: #f1f1f1;
    border: 1px solid #ccc;
    border-radius: 5px;
    z-index: 1; /* Añadido z-index para que el menu-label esté por encima del menu-list */
}

.menu-list {
    display: none;
    position: absolute;
    top: 97%; /* Ajustado para que el menu-list aparezca debajo del menu-label */
    left: 5;
    margin-top: 5px;
    padding: 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    list-style-type: none;
    z-index: 1; /* Añadido z-index para que el menu-list esté por encima de otros elementos */
}

.menu-list li {
  padding: 10px 15px;
}

.menu-list li:hover {
    background-color: #f1f1f1;
}

.menu-toggle:checked + .menu-label + .menu-list {
    display: block;
}
</style>

<head>
<script src="https://kit.fontawesome.com/cd3de0af1d.js" crossorigin="anonymous"></script>
</head>

<header class="head-container">
    <div class="logo-container">
      <img class="logo" src="images/logo.jpg" style="cursor: pointer" onclick= "window.location.href = 'index.php';">
    </div>
    <div class = "search-box">
        <div class = "row">
          <input  type="text" id="input-box" placeholder="Search..." autocomplete="off">
        </div>
        <div class = "result-box">
        </div>
      </div> 

    <div class="menu-container">
      <?php

        if($flag){
          echo '<img class="user-picture" src="data:image/jpeg;base64,' . $imagenBase64 . '" alt="Imagen">';
        }
        else
        {
          echo '<img class="user-picture" src="images/GuestPhoto.jpg">';
        }
      ?>
      <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="menu-label"> <?php echo $username ?> </label>
        
        <?php      
        if (isset($_SESSION['username']))
        {
            echo '<ul class="menu-list">
            <li><a href="user.php">Account</a></li>
            <li><a href="logout.php">Logout</a></li>
            </ul>';
        }
        else
        {
            echo '<ul class="menu-list">
            <li><a href="user.php">Account</a></li>
            <li><a href="login.php">Log_In</a></li>
            </ul>';
        }
        ?>
        
    </div>
    <script src = "APIS\SearchBarFunction.js"></script>
  </header>