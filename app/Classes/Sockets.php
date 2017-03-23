<?php namespace App\Classes;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;


class Sockets implements MessageComponentInterface
{

    protected $clients;
    private $clientsIds;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $msg = json_decode($msg, true);
        echo var_dump($msg);
        $this->$msg["name"]($from, $msg);
//        $numRecv = count($this->clients) - 1;
//        foreach ($this->clients as $client) {
//            if ($from !== $client) {
//                // The sender is not the receiver, send to each client connected
//                $client->send($msg);
//            }
//        }
    }

    public function sendNotification($from, $msg)
    {
        $to = $msg["to_user"];
        $this->clientsIds[$to][1]->send(json_encode([
            "name" => "new_notification",
            "title" => $msg["title"],
            "description" => $msg["description"]
        ]));
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $resourceId = $conn->resourceId;
        $this->clients->detach($conn);
        foreach ($this->clientsIds as $key => $id) {
            if ($id == $resourceId) {
                unset($this->clientsIds[$key]);
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

    private function init($from, $msg)
    {
        $this->clientsIds[$msg['user_id']] = [$from->resourceId, $from];
    }

}