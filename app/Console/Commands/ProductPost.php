<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ScheduledTaskUtility;

class ProductPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ProductPost:Update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that will update the product posting status and expiration of posted items.';

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
     * @return mixed
     */
    public function handle()
    {
        echo ScheduledTaskUtility::product_post_update();
    }
}
