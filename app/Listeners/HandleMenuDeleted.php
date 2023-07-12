<?php

namespace App\Listeners;

use App\Events\MenuDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleMenuDeleted
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
     * @param  \App\Events\MenuDeleted  $event
     * @return void
     */
    public function handle(MenuDeleted $event)
    {
        $menu = $event->menu;
        $categorias = $menu->categorias;

        foreach ($categorias as $key => $categoria) {
            $categoria->delete();
        }
        
    }
}
