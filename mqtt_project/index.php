<html>
<head>
    <title>MQTT con PHP</title>
</head>
<body>
    <h2>Enviar mensaje a MQTT</h2>
    <form method="post" action="index.php">
        <label for="message">Mensaje:</label>
        <input type="text" id="message" name="message" required>
        <input type="submit" value="Enviar">
    </form>

    <h2>Mensajes Recibidos:</h2>
    <div id="receivedMessages">
        <!-- Aquí se actualizarán los mensajes recibidos -->
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
        include('mqtt.php');
        $message = $_POST['message'];
        $mqtt->publish("topic/test", $message, 0);
        echo "<p>Mensaje enviado: $message</p>";
    }
    ?>
</body>
</html>
