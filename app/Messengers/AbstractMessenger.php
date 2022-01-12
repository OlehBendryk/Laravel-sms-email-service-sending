<?php

namespace App\Messengers;

use App\Interfaces\MessengerInterface;

abstract class AbstractMessenger implements MessengerInterface
{
    /**
     * @var  sender
     */
    protected $sender;

    /**
     * @var recipient
     */
    protected $recipient;

    /**
     * @var message
     */
    protected $message;

    /**
     * @param $value
     * @return MessengerInterface
     */
    public function setSender($value): MessengerInterface
    {
        $this->sender = $value;

        return $this;
    }

    /**
     * @param $value
     * @return MessengerInterface
     */
    public function setRecipient($value): MessengerInterface
    {
        $this->recipient = $value;

        return $this;
    }

    /**
     * @param $value
     * @return MessengerInterface
     */
    public function setMessage($value): MessengerInterface
    {
        $this->message = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function send(): bool
    {
        return true;
    }
}
