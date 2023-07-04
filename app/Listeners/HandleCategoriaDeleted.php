<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Log;

class HandleCategoriaDeleted
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    

    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $items = $event->categoria->items;

        foreach ($items as $key => $item) {
            $item->delete();
        }

        $event->categoria->freeUpPlace();
    }
}
