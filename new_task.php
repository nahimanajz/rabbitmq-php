<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__ . '/vendor/autoload.php';

$connection = new AMQPStreamConnection('localhost',5672, 'guest', 'guest');
$channel = $connection-> channel();

$channel->queue_declare('task_queue', false, true, false,false); // 3rd param is true, means if rabbitmq restart no message will be lost

$data = implode(' ', array_slice($argv, 1));
if (empty($data)){
    $data = "Hello world!";
}

$msg = new AMQPMessage($data, array('delivery_mode'=> AMQMessage::DELIVERY_MODE_PERSISTENT));
$channel->basic_publish($msg, '', 'hello');

echo '[x] Sent ', $data, "\n";

$channel->close();
$connection->close();


?>