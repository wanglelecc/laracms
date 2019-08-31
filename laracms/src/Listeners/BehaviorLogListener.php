<?php

namespace Wanglelecc\Laracms\Listeners;

use Wanglelecc\Laracms\Events\BehaviorLogEvent;
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
     * 监听处理模型 添加/更新 事件.
     *
     * @param  BehaviorLogEvent  $event
     * @return void
     */
    public function handle(BehaviorLogEvent $event)
    {
        if (app()->runningInConsole()) { return; }

        $model = $event->model;
        $type = isset($model->id) ? '更新' : '添加';
        $title = get_value($model, $model->titleName());

        behavior_log($model->getTable(),"{$type}了[\"{$title}\"]", $model->getMorphClass());
    }
}
