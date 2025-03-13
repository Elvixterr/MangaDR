<?php
session_start();

if (!isset($_SESSION['username'])) {
    $username = "GUEST";
} else {
    $username = $_SESSION['username'];
}

include "connectDB.php";

$SearchIdUser = "SELECT id FROM cuenta WHERE username = '$username'";
$result = $conn->query($SearchIdUser);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idUser = $row["id"];

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];

        $imagenBinaria = file_get_contents($fileTmpName);
      
        // Guardar la imagen binaria en la base de datos
        $sql = "UPDATE cuenta SET avatar = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $imagenBinaria, $idUser);
        $stmt->execute();

        // Devuelve una respuesta JSON con la ruta del archivo o cualquier otro mensaje
        echo json_encode(['message' => 'Archivo subido exitosamente']);
    } else {
        // Enviar una respuesta JSON indicando que no se encontraron resultados
        echo json_encode(['message' => 'No se encontraron resultados']);
    }
}
else
{
    echo json_encode(['message' => 'No se encontraron resultados']);
}

?>
