<?php

namespace App\Messengers;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class EmailMessenger extends AbstractMessenger
{
    /**
     * @return bool
     */
    public function send(): bool
    {
            /** @var $recipient Customer model */
            foreach ($this->recipient as $recipient) {
                Mail::to($recipient)->queue((new SendMail($this->sender, $this->message, $recipient))->build());

            }

//        \info("Sent by" . __METHOD__);
        return parent::send();
    }
}
