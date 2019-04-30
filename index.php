<?php


require_once 'vendor/autoload.php';

// Bağlantı ayarları
$connectionOptions = new \Nats\ConnectionOptions();
$connectionOptions->setHost('localhost')->setPort(4222);
//$connectionOptions->setHost('localhost')->setPort(4222)->setUser('foo')->setPass('bar');
//$connectionOptions->setHost('localhost')->setPort(4222)->setToken('supersecrettoken');

// Yeni bağlantı nesnesi oluşturma ve bağlanma
$client = new \Nats\Connection($connectionOptions);
$client->connect();
printf('Bağlanılan NATS Server id: %s <br>', $client->connectedServerId());

// Basit Subscribe olma
$client->subscribe(
    'foo',
    function ($message) {
        printf(PHP_EOL."Data: %s\r\n", $message->getBody());
    }
);

// Basit Publish yapma
//$client->publish('foo', 'Marty McFly');

// 1 mesaj gelene kadar bekletme
$client->wait(1);

// Bağlantıyı sonlandır
$client->close();
?>