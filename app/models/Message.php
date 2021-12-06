<?php

namespace app\models;

class Message extends \app\core\Model {
    public $message_id;
    public $sender;
    public $receiver;
    public $message;
    public $timestamp;
    public $read_status; 

    // the constructor
    public function __construct() {
        parent::__construct();
    }

    // Sends a message to other user
    public function addMessage() {
        $SQL = "INSERT INTO message (sender, receiver, message, read_status)
                VALUES (:sender, :receiver, :message, :read_status)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["sender" => $this->sender, "receiver" => $this->receiver, "message" => $this->message, "read_status" => $this->read_status]);
    }

    // Retrieve all the messages of the current user
    public function getAllMessages($receiver) {
        $SQL = "SELECT sender, message, message_id, timestamp, read_status FROM message WHERE receiver = :receiver";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["receiver" => $receiver]);
        $STMT->setFetchMode(\PDO::FETCH_CLASS, "app\\models\\Message");
        return $STMT->fetchAll();
    }

    // Deletes the message
    public function deleteMessage($message_id) {
        $SQL = "DELETE FROM message WHERE message_id = :message_id";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(["message_id" => $message_id]);
    }
    
    // Edit the status of the message
    public function editReadStatus($message_id, $status) {
        $SQL = 'UPDATE message SET read_status = :read_status WHERE message_id = :message_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['read_status'=>$status, 'message_id'=>$message_id]);
    }
}