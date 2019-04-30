<?php

/**
 * This example show how to use PHP NATS Client
 *
 * @package    PHP NATS
 * @author     Erhan Yakut <yakuter@gmail.com>
 * @copyright  2019 Yakuter
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    1.0.0
 * @link       https://github.com/yakuter/php-nats-client
 */

require_once 'vendor/autoload.php';

// Bağlantı ayarları
$connectionOptions = new \Nats\ConnectionOptions();
$connectionOptions->setHost('localhost')->setPort(4222);
//$connectionOptions->setHost('localhost')->setPort(4222)->setUser('foo')->setPass('bar');
//$connectionOptions->setHost('localhost')->setPort(4222)->setToken('supersecrettoken');

// Yeni bağlantı nesnesi oluşturma ve bağlanma
$client = new \Nats\Connection($connectionOptions);
$client->connect();
printf('Bağlanılan NATS Server id: <strong>%s</strong> <br>', $client->connectedServerId());

// Basit Subscribe olma
$callback = function($payload)
{
    printf("Data: <strong>%s</strong>", $payload);
};
$sid = $client->subscribe("foo", $callback);

// Basit Publish yapma
$client->publish('foo', 'Marty McFly');

// 1 mesaj gelene kadar bekletme
$client->wait(1);
$client->unsubscribe($sid);

// Bağlantıyı sonlandır
//$client->close();
?>