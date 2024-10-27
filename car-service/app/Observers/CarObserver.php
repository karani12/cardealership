<?php

namespace App\Observers;

use App\Events\CarCreated;
use App\Events\CarDeleted;
use App\Events\CarUpdated;
use App\Models\Car;

class CarObserver
{
    /**
     * Handle the Car "created" event.
     */
    public function created(Car $car): void
    {
        event(new CarCreated($car));
    }

    /**
     * Handle the Car "updated" event.
     */
    public function updated(Car $car): void
    {
        event(new CarUpdated($car));
    }

    /**
     * Handle the Car "deleted" event.
     */
    public function deleted(Car $car): void
    {
        event(new CarDeleted($car));
    }

    /**
     * Handle the Car "restored" event.
     */
    public function restored(Car $car): void
    {
        //
    }

    /**
     * Handle the Car "force deleted" event.
     */
    public function forceDeleted(Car $car): void
    {
        //
    }
}
