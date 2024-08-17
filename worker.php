<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo "[*] Waiting for message. To exit press CTRL+C \n";

// fn to deliver message from queue
$callback = function ($msg) {
    echo '[X] Received', $msg->getBody(), "\n";
    sleep(substr_count($msg->getBody(), '.'));
    echo "[x] Done\n";
    $msg->ack();
};

$channel->basic_qos(null, 1, false); // instruct queue to dispatch one message at a time
$channel->basic_consume('hello', '', false, true, false, false, $callback);

try {
    $channel->consume();
} catch (\Throwable $exception) {
    echo $exception->getMessage();
}

$channel->close();
$connection-> close();
?>