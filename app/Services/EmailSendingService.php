<?php

namespace App\Services;

use App\Models\Sending;

class EmailSendingService
{

    /**
     *
     */
    public function __construct()
    {
        //
    }

    /**
     */
    public function create(array $data)
    {
        $emailSending = new Sending();

        $emailSending->group_id = $data['group_id'];
        $emailSending->msg_template = $data['msg_template'];
        $emailSending->send_at = $data['send_at'];
        $emailSending->messenger = $data['messenger'];

        $emailSending->save();

        return $emailSending;
    }
}
