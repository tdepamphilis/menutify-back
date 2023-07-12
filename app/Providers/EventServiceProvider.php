<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\CategoriaDeleted;
use App\Events\ItemDeleted;
use App\Events\MenuDeleted;
use App\Events\RestaurantDeleted;


use App\Listeners\HandleCategoriaDeleted;
use App\Listeners\HandleItemDeleted;
use App\Listeners\HandleMenuDeleted;
use App\Listeners\HandleRestaurantDeleted;




class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CategoriaDeleted::class => [
            HandleCategoriaDeleted::class,
        ],
        ItemDeleted::class => [
            HandleItemDeleted::class,
        ],
        MenuDeleted::class => [
            HandleMenuDeleted::class
        ],
        RestaurantDeleted::class => [
            HandleRestaurantDeleted::class
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
