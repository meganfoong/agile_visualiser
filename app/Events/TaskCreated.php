<?php

namespace App\Events;


use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;

use App\Task;


class TaskCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    

    public $task;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}
