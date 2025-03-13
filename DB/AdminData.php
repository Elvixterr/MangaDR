<?php
session_start();

if (!isset($_SESSION['username'])) {
    $username = "GUEST";
} else {
    $username = $_SESSION['username'];
}


include "connectDB.php";


$AdminData = array();

function getTotal($conn, $query) {
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['total'];
}

$queries = array(
    "TotalCuentas" => "SELECT count(*) as total FROM cuenta",
    "TotalLeido" => "SELECT count(*) as total FROM mangalistuser where estado = 'Leido'",
    "TotalPendiente" => "SELECT count(*) as total FROM mangalistuser where estado = 'Pendiente'",
    "TotalFav" => "SELECT count(*) as total FROM mangalistuser where estado = 'Favorito'",
    "TotalLeyendo" => "SELECT count(*) as total FROM mangalistuser where estado = 'Leyendo'",
    "TotalMangas" => "SELECT count(DISTINCT id) as total FROM mangalistuser"
);

foreach ($queries as $index => $query) {
    $total = getTotal($conn, $query);
    $AdminData[$index] = $total;
}

echo json_encode($AdminData);

$conn->close();
?>
