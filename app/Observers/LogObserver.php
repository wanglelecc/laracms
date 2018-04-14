<?php

namespace App\Observers;

use Ip;
use Auth;
use Agent;
use Request;
use App\Models\Log;
use Illuminate\Support\Carbon;


// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class LogObserver
{

    public function creating(Log $log)
    {
        $ip = Request::ip();
        $location = Ip::find($ip);
        $location = is_array($location) && !empty($location) ? trim(implode(' ', array_slice($location,0,4))) : '未知';

        $log->account = Auth::user()->name;
        $log->browser = Agent::browser();
        $log->host = Request::root();
        $log->uri = Request::path();
        $log->method = Request::method();
        $log->ip = $ip;
        $log->location = $location;
        $log->user_agent = json_encode(Agent::getUserAgent(), JSON_UNESCAPED_UNICODE);
        $log->user_id = Auth::user()->id;
        $log->data = json_encode(Request::all(),JSON_UNESCAPED_UNICODE);
    }

    public function updating(Log $log)
    {

    }
}