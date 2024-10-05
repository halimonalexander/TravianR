<?php

namespace App\Repositories;

use App\Models\Message;
use App\Models\User;

class MessagesRepository
{
    function sendMessage(
        User|int $sender,
        User $recipient,
        string $topic,
        string $messageText,
    ) {
        $message = new Message();

        $message->sender_id = is_int($sender) ? $sender : $sender->id;
        $message->recipient_id = $recipient->id;
        $message->topic = $topic;
        $message->message = $messageText;

        $message->saveOrFail();
    }

    function setArchived($id)
    {
        $q = "UPDATE mdata set archived = 1 where id = $id";
        return $this->connection->query($q);
    }

    function setNorm($id)
    {
        $q = "UPDATE mdata set archived = 0 where id = $id";
        return $this->connection->query($q);
    }

    /***************************
     * Function to get messages
     * Mode 1: Get inbox
     * Mode 2: Get sent
     * Mode 3: Get message
     * Mode 4: Set viewed
     * Mode 5: Remove message
     * Mode 6: Retrieve archive
     * References: User ID/Message ID, Mode
     ***************************/
    function getMessage($id, $mode)
    {
        global $session;
        switch ($mode) {
            case 1:
                $q = "SELECT * FROM mdata WHERE target = $id and send = 0 and archived = 0 ORDER BY time DESC";
                break;
            case 2:
                $q = "SELECT * FROM mdata WHERE owner = $id ORDER BY time DESC";
                break;
            case 3:
                $q = "SELECT * FROM mdata where id = $id";
                break;
            case 4:
                $q = "UPDATE mdata set viewed = 1 where id = $id AND target = $session->uid";
                break;
            case 5:
                $q = "UPDATE mdata set deltarget = 1,viewed = 1 where id = $id";
                break;
            case 6:
                $q = "SELECT * FROM mdata where target = $id and send = 0 and archived = 1";
                break;
            case 7:
                $q = "UPDATE mdata set delowner = 1 where id = $id";
                break;
            case 8:
                $q = "UPDATE mdata set deltarget = 1,delowner = 1,viewed = 1 where id = $id";
                break;
            case 9:
                $q = "SELECT * FROM mdata WHERE target = $id and send = 0 and archived = 0 and deltarget = 0 ORDER BY time DESC";
                break;
            case 10:
                $q = "SELECT * FROM mdata WHERE owner = $id and delowner = 0 ORDER BY time DESC";
                break;
            case 11:
                $q = "SELECT * FROM mdata where target = $id and send = 0 and archived = 1 and deltarget = 0";
                break;
        }
        if ($mode <= 3 || $mode == 6 || $mode > 8) {
            $result = $this->connection->query($q);
            return $this->mysqli_fetch_all($result);
        } else {
            return $this->connection->query($q);
        }
    }

    function getDelSent($uid)
    {
        $q = "SELECT * FROM mdata WHERE owner = $uid and delowner = 1 ORDER BY time DESC";
        $result = $this->connection->query($q);
        return $this->mysqli_fetch_all($result);
    }

    function getDelInbox($uid)
    {
        $q = "SELECT * FROM mdata WHERE target = $uid and deltarget = 1 ORDER BY time DESC";
        $result = $this->connection->query($q);
        return $this->mysqli_fetch_all($result);
    }

    function getDelArchive($uid)
    {
        $q = "SELECT * FROM mdata WHERE target = $uid and archived = 1 and deltarget = 1 OR owner = $uid and archived = 1 and delowner = 1 ORDER BY time DESC";
        $result = $this->connection->query($q);
        return $this->mysqli_fetch_all($result);
    }
}
