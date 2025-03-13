<?php
session_start();

if (!isset($_SESSION['username'])) {
  $username = "GUEST";
}
else
{
  $username = $_SESSION['username'];
}

$jsonData = $_POST['manga'];

$manga = json_decode($jsonData);

$estado = $manga->estado;
$id = $manga->id;

include "connectDB.php";

$SearchIdUser = "SELECT id FROM cuenta WHERE username = '$username'";
$result = $conn->query($SearchIdUser);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $idUser = $row["id"];

    $Check = "SELECT id FROM mangalistuser WHERE id_user = '$idUser' and id = '$id'";
    $result = $conn->query($Check);

    if ($result->num_rows > 0) {
        
        $update = "UPDATE mangalistuser SET estado = '$estado' WHERE id_user = '$idUser' and id = '$id'";
        $result = $conn->query($update);

        if ($result === FALSE) 
        {
            $error_message = "Couldn't Update the status row in DB" ;
            
            echo $error_message;
        }

    } else {
        
        $insert = "INSERT INTO mangalistuser(id_user, estado, id) VALUES ('$idUser', '$estado', '$id')";
        $result = $conn->query($insert);

        if ($result === FALSE) 
        {
            switch($estado)
            {
                case 'Leido': $estado = "Read";
                break;
                case 'Leyendo': $estado = "Reading";
                break;
                case 'Favorito': $estado = "Favourite";
                break;
                case 'Pendiente': $estado = "Pending";
                break;
            }

            $error_message = "Couldn't add the article to the list ".$estado ;
            echo $error_message;

        }
    }

    if (isset($error_message)) {
        echo $error_message;

    } else {

        switch($estado)
        {
            case 'Leido': $estado = "Read";
            break;
            case 'Leyendo': $estado = "Reading";
            break;
            case 'Favorito': $estado = "Favourite";
            break;
            case 'Pendiente': $estado = "Pending";
            break;
        }

        $message = "Manga successfully added to the list: ".$estado;
        echo $message;

    }
    } else {
        
        $error_message = "You need an Account to use this feature!";
        echo $error_message;
    }

$conn->close();

?>
