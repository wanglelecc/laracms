<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

namespace Wanglelecc\Laracms\Http\Controllers\Administrator;

use Illuminate\Support\Facades\Crypt;
use Wanglelecc\Laracms\Support\LogViewer;
use Wanglelecc\Laracms\Models\Log;
use Illuminate\Http\Request;

/**
 * Log 控制器
 *
 * Class LogViewerController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class LogViewerController extends Controller
{
    protected $request;

    public function __construct ()
    {
        $this->request = app('request');
        static::$activeNavId = 'develop';
    }

    /**
     * 列表
     *
     * @param Log $log
     * @param Request $request
     * @param $group
     * @param $title
     * @return mixed
     */
    public function index(Log $log, Request $request, $group, $title){
        $types = $log->select('type')->where('group',$group)->groupBy('type')->get();

        // 关键字过滤
        if($type = $request->type ?? ''){
            $log = $log->where('type', '=', $type);
        }

        $logs = $log->where('group',$group)->orderBy('id','desc')->paginate(config('administrator.paginate.limit'));
        return backend_view('log.index', compact('types','logs', 'title'));
    }

    /**
     * 任务日志
     *
     * @param Log $log
     * @param Request $request
     * @return mixed
     */
    public function jobs(Log $log, Request $request){
        static::$activeNavId = 'develop.task';
        return $this->index($log,$request,'jobs', '任务日志');
    }

    /**
     * 队列日志
     *
     * @param Log $log
     * @param Request $request
     * @return mixed
     */
    public function queue(Log $log, Request $request){
        static::$activeNavId = 'develop.queue';
        return $this->index($log,$request,'queue', '队列日志');
    }

    /**
     * 行为日志
     *
     * @param Log $log
     * @param Request $request
     * @return mixed
     */
    public function behavior(Log $log, Request $request){
        static::$activeNavId = 'develop.behavior';
        return $this->index($log,$request,'behavior', '行为日志');
    }

    /**
     * 业务日志
     *
     * @param Log $log
     * @param Request $request
     * @return mixed
     */
    public function business(Log $log, Request $request){
        static::$activeNavId = 'develop.business';
        return $this->index($log,$request,'business', '业务日志');
    }

    /**
     * Laravel日志
     *
     * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \Exception
     */
    public function laravel()
    {
        static::$activeNavId = 'develop.log';
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

    protected function redirect($to = null)
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
