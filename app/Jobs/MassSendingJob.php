<?php

namespace App\Jobs;

use App\AppMessenger;
use App\Models\Sending;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class MassSendingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(int $id)
    {
        $emailSending = Sending::findOrFail($id);
        $messageTemplate = $emailSending->msg_templates()->get()->first();
        $group = $emailSending->groups()->get()->first();
        $recipients = $group->customers()->get();

        $messenger = new AppMessenger();

        $sender = config('mail.from.address');

        if ($emailSending->messenger === 1){
            $messenger->toSms();
        }
        DB::transaction(function() use($emailSending, $messenger, $sender, $recipients, $messageTemplate){
            $messenger->setSender($sender)
                ->setRecipient($recipients)
                ->setMessage($messageTemplate)
                ->send();

            $emailSending->status = true;
            $emailSending->save();
        });
    }
}
