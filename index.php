<?php>
// Conexión a la base de datos
$servername = "localhost";
$username = "Horusyst";
$password = "Braham1243*";
$dbname = "BasededatosLED";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Manejar cambios de estado de los LEDs
if (isset($_GET['toggle_led'])) {
    $led_id = intval($_GET['toggle_led']);
    $result = $conn->query("SELECT status FROM led_status WHERE led_id = $led_id");
    $row = $result->fetch_assoc();
    $new_status = $row['status'] ? 0 : 1;
    $conn->query("UPDATE led_status SET status = $new_status WHERE led_id = $led_id");
}

// Obtener el estado actual de los LEDs
$result = $conn->query("SELECT led_id, status FROM led_status");
$leds = [];
while ($row = $result->fetch_assoc()) {
    $leds[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de LEDs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Control de LEDs</h1>
    <div class="led-container">
        <?php foreach ($leds as $led): ?>
            <div class="led-control">
                <img src="images/bulb.png" alt="Bombillo">
                <button
                    class="led-button <?php echo $led['status'] ? 'led-on' : 'led-off'; ?>"
                    onclick="window.location.href='?toggle_led=<?php echo $led['led_id']; ?>'">
                    LED <?php echo $led['led_id']; ?>
                </button>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
