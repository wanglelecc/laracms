<?php

namespace App\Listeners;

use App\Events\BehaviorLogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Log;

class BehaviorLogListener
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
     * @param  BehaviorLogEvent  $event
     * @return void
     */
    public function handle(BehaviorLogEvent $event)
    {
        $model = $event->model;
        $type = isset($model->id) ? '更新' : '添加';
        $title = get_value($model, $model->titleName());

        behavior_log($model->getTable(),"{$type}了[\"{$title}\"]", $model->getMorphClass());
    }
}
