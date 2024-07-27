<?php
// Conexión a la base de datos
$servername = "Mysql@127.0.0.1:3306";
$username = "root";
$password = "Abraham1243";
$dbname = "led_control";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed']));
}

if (isset($_GET['toggle_led'])) {
    $led_id = intval($_GET['toggle_led']);
    $result = $conn->query("SELECT status FROM led_status WHERE led_id = $led_id");
    $row = $result->fetch_assoc();
    $new_status = $row['status'] ? 0 : 1;
    $conn->query("UPDATE led_status SET status = $new_status WHERE led_id = $led_id");
    echo json_encode(['success' => true, 'new_status' => $new_status]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$conn->close();
?>
