<?php

namespace App\Events;

use App\Models\Car;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Pusher\Pusher;

class CarCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Car $car;

    /**
     * Create a new event instance.
     */
    public function __construct(Car $car)
    {
        $this->car = $car;

        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('user-'.$car->user_id, 'car-created', [
            'message' => 'A new car has been created',
            'car' => $car,
        ]);

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user-'.$this->car->user_id),
        ];
    }
}
