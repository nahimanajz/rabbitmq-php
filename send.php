<?php 
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
require_once __DIR__ . '/vendor/autoload.php';

$connection = new AMQPStreamConnection('localhost',5672, 'guest', 'guest');
$channel = $connection-> channel();

$channel->queue_declare('hello', false, false, false,false);

$msg = new AMQPMessage("Hello world!");
$channel->basic_publish($msg, '', 'hello');

echo "[x] Sent 'Hello World'\n";

$channel->close();
$connection->close();
// 
//Dadju, aya nakamura, central cee, 
// sport: CROSS, 6h:00  
?>
