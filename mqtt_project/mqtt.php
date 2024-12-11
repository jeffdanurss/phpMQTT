<?php
require("../vendor/autoload.php");  // Si usas Composer

use Bluerhinos\phpMQTT;

class MQTT {
    private $client;
    private $host = "localhost";  // Dirección de tu broker MQTT (en este caso es localhost)
    private $port = 1883;
    private $username = "";
    private $password = "";

    public function __construct() {
        $this->client = new phpMQTT($this->host, $this->port, "php-client");
    }

    public function connect() {
        if ($this->client->connect(true, NULL, $this->username, $this->password)) {
            return true;
        }
        return false;
    }

    public function publish($topic, $message, $qos = 0) {
        $this->client->publish($topic, $message, $qos);
    }

    public function subscribe($topic, $qos = 0) {
        $this->client->subscribe([$topic => ['qos' => $qos, 'function' => 'messageHandler']]);
    }

    public function loop() {
        $this->client->loop();
    }
}

// Crear instancia de la clase MQTT
$mqtt = new MQTT();
if (!$mqtt->connect()) {
    echo "Conexión fallida al broker MQTT";
    exit();
}

// Suscribirse a un topic
$mqtt->subscribe("topic/test");

?>
