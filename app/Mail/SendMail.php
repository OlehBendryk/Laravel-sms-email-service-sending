<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender;
    public $messageTemplate;
    public $recipient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender, $messageTemplate, $recipient)
    {
        $this->sender = $sender;
        $this->messageTemplate = $messageTemplate;
        $this->recipient = $recipient;
    }

    /**
     * Build the message.
     *
     * @return SendMail|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function build()
    {
        return $this->from($this->sender)->subject($this->messageTemplate['subject'])->view('admin.email_templates.template');

    }
}
