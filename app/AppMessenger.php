<?php

namespace App;

use App\Interfaces\MessengerInterface;
use App\Messengers\EmailMessenger;
use App\Messengers\SmsMessenger;

class AppMessenger implements MessengerInterface
{
    /**
     * @var MessengerInterface
     */
    private $messenger;

    /**
     * @param $messenger
     */
    public function __construct()
    {
        $this->toEmail();
    }

    /**
     * @return $this
     */
    public function toEmail(): AppMessenger
    {
        $this->messenger = new EmailMessenger();

        return $this;
    }

    /**
     * @return $this
     */
    public function toSms(): AppMessenger
    {
        $this->messenger = new SmsMessenger();

        return $this;
    }

    /**
     * @param $value
     * @return MessengerInterface
     */
    public function setSender($value): MessengerInterface
    {
        $this->messenger->setSender($value);

        return $this->messenger;
    }

    /**
     * @param $value
     * @return MessengerInterface
     */
    public function setRecipient($value): MessengerInterface
    {
        $this->messenger->setRecipient($value);

        return $this->messenger;
    }

    /**
     * @param $value
     * @return MessengerInterface
     */
    public function setMessage($value): MessengerInterface
    {
        $this->messenger->setMessage($value);

        return $this->messenger;
    }

    /**
     * @return bool
     */
    public function send(): bool
    {
       return $this->messenger->send();
    }
}
