<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Support\LogViewer;
use App\Models\Log;
use Illuminate\Http\Request;

class LogViewerController extends Controller
{
    protected $request;

    public function __construct ()
    {
        $this->request = app('request');
    }

    public function index(Log $log, Request $request, $group, $title){
        $types = $log->select('type')->where('group',$group)->groupBy('type')->get();

        // 关键字过滤
        if($type = $request->type ?? ''){
            $log = $log->where('type', '=', $type);
        }

        $logs = $log->where('group',$group)->orderBy('id','desc')->paginate(config('administrator.paginate.limit'));
        return backend_view('log.index', compact('types','logs', 'title'));
    }

    // 任务日志
    public function jobs(Log $log, Request $request){
        return $this->index($log,$request,'jobs', '任务日志');
    }

    // 队列日志
    public function queue(Log $log, Request $request){
        return $this->index($log,$request,'queue', '队列日志');
    }

    // 行为日志
    public function behavior(Log $log, Request $request){
        return $this->index($log,$request,'behavior', '行为日志');
    }

    // 业务日志
    public function business(Log $log, Request $request){
        return $this->index($log,$request,'business', '业务日志');
    }

    // Laravel日志
    public function laravel()
    {

        if ($this->request->input('l')) {
            LogViewer::setFile(Crypt::decrypt($this->request->input('l')));
        }

        if ($this->request->input('dl')) {
            return $this->download(LogViewer::pathToLogFile(Crypt::decrypt($this->request->input('dl'))));
        } elseif ($this->request->has('del')) {
            app('files')->delete(LogViewer::pathToLogFile(Crypt::decrypt($this->request->input('del'))));
            return $this->redirect($this->request->url());
        } elseif ($this->request->has('delall')) {
            foreach(LogViewer::getFiles(true) as $file){
                app('files')->delete(LogViewer::pathToLogFile($file));
            }
            return $this->redirect($this->request->url());
        }
        
        $data = [
            'logs' => LogViewer::all(),
            'files' => LogViewer::getFiles(true),
            'current_file' => LogViewer::getFileName()
        ];

        if ($this->request->wantsJson()) {
            return $data;
        }

        return backend_view('log.viewer', $data);
//        return app('view')->make('laravel-log-viewer::log', $data);
    }

    private function redirect($to)
    {
        if (function_exists('redirect')) {
            return redirect($to);
        }

        return app('redirect')->to($to);
    }

    private function download($data)
    {
        if (function_exists('response')) {
            return response()->download($data);
        }

        // For laravel 4.2
        return app('\Illuminate\Support\Facades\Response')->download($data);
    }
}
