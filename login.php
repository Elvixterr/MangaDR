<?php
session_start();

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar el token CSRF
    if (!isset($_POST['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token']) {
        die("Error CSRF token no válido");
    }

    // Conectar a la base de datos
    include "db/connectDB.php";
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Consulta SQL para verificar el usuario
    $sql = "SELECT id, username, email FROM cuenta WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Usuario encontrado, iniciar sesión y redirigir a index.php
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        // Usuario no encontrado
        $error_message = "Incorrect username or password";
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
  <title>MangaDR: LOGIN</title>
</head>
<body>
  <main class="signup">
    <h2>Log In</h2>
    <?php if (isset($error_message)) { echo "<p>$error_message</p>"; } ?>
    <form class="signup" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <!-- Campo para el token CSRF -->
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input class="enviar" type="submit" value="Log In">
    </form>
    <p onclick="window.location.href='signup.php';">Don't have an account? Sign Up here</p>
  </main>
</body>
</html>
