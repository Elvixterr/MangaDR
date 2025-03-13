<?php
session_start();

$email_error = "";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar el token CSRF
    if (!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
        die("Error CSRF token no válido");
    }

    // Conectar a la base de datos
    include "db/connectDB.php";
    
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);


    // Validando el email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $email_error = "El correo electrónico no es válido";
    } 
    else 
    {
      $sql = "SELECT username FROM cuenta where username = '$username'";
      $result = $conn->query($sql);

      if($result->num_rows > 0)
      {
        $error_message = "USERNAME ALREADY TAKEN";
      }
      else
      {
        if($username === 'admin' || $username === 'Admin')
      {
        $error_message = "INVALID USERNAME";
      }
      else
      {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO cuenta (username, email, password) VALUES ('$username', '$email', '$password')";
      
        if ($conn->query($sql) === TRUE) 
        {
          // Registro exitoso, redirigir a index.php
          $_SESSION['username'] = $username;
          header("Location: index.php");
          exit();
        } 
        else 
        {
          $error_message =  "Error: " . $sql . "<br>" . $conn->error;
        }
      }

      }
    }
    
    $conn->close();
}

// Generar token CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/signup.css">
  <title>MangaDR: SIGNUP</title>
</head>
<body>
  <main class="signup">
    <h2>Sign Up</h2>
    <?php if (isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <form class="signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <!-- Campo para el token CSRF -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <input type="text" name="username" placeholder="Username" required>
        <span style="color: red;"><?php echo $email_error; ?></span>
        <input type="text" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm password" required>
        <input class="enviar" type="submit" value="Sign Up">
    </form>
    <p onclick="window.location.href='login.php';">Already have an account? Log In here</p>
  </main>
</body>
</html>
