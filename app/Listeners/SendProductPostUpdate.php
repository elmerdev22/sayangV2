<?php

namespace App\Listeners;

use App\Events\CheckOut;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendProductPostUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckOut  $event
     * @return void
     */
    public function handle(CheckOut $event)
    {
        //
    }
}
