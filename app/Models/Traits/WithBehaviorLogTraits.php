<?php
/**
 * Created by PhpStorm.
 * User: lele.wang
 * Date: 2018/2/4
 * Time: 10:43
 */

namespace App\Models\Traits;

use App\Events\BehaviorLogEvent;

trait WithBehaviorLogTraits
{
    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'title';
    }

}
