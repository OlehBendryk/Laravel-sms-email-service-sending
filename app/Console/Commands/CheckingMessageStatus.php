<?php

namespace App\Console\Commands;

use App\Jobs\MassSendingJob;
use App\Models\Sending;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckingMessageStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the status of sending a message ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $query =  Sending::query();
        $query->where('status', false)->where('send_at', '<', Carbon::now());

        /* display console diagram of the progress */
        $bar = $this->getOutput()->createProgressBar($query->count());
        $bar->start();

        /** SmsSending $smsSending*/
        foreach ($query->cursor() as $sending) {
            (new MassSendingJob())->handle($sending->id);

            $bar->advance();
        }
        $bar->finish();
    }
}
