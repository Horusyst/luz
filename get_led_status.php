<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "1";
$password = "Abraham1243";
$dbname = "led_control";

$conn = mysqli_connect( $servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed']));
}

$result = $conn->query("SELECT led_id, status FROM led_status");
$leds = [];
while ($row = $result->fetch_assoc()) {
    $leds[] = $row;
}
echo json_encode($leds);

$conn->close();
?>
