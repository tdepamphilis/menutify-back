<?php

namespace App\Listeners;

use App\Events\RestaurantDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleRestaurantDeleted
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
     * @param  \App\Events\RestaurantDeleted  $event
     * @return void
     */
    public function handle(RestaurantDeleted $event)
    {
        $restaurant = $event->restaurant;

        $menus = $restaurant->menus();
        $contacto = $restaurant->contacto();

        foreach ($menus as $key => $menu) {
            $menu->delete();
        }

        $contacto->delete();
        


    }
}
