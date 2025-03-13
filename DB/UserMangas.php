<?php
session_start();

if (!isset($_SESSION['username'])) {
    $username = "GUEST";
} else {
    $username = $_SESSION['username'];
}


include "connectDB.php";


$listaMangas = array();

$SearchIdUser = "SELECT id FROM cuenta WHERE username = '$username'";
$result = $conn->query($SearchIdUser);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    $idUser = $row["id"];

    $SearchMangas = "SELECT id, estado FROM mangalistuser WHERE id_user = '$idUser'";
    $result = $conn->query($SearchMangas);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $listaMangas[] = $row;
        }
        echo json_encode($listaMangas);
    } else {
        echo json_encode("error");
    }
} else {
    $message = "You need an Account to use this feature!";
    echo json_encode($message);
}

$conn->close();
?>
