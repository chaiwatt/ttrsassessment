<?php

namespace App\Console\Commands;

use App\Model\Pillar;
use Illuminate\Console\Command;

class CronSendmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:sendemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and send notification email every minute using cron job.';

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
        $product = new Pillar();
        $product->name = "test";
        $product->percent = 10.0;
        $product->save();
    }
}
