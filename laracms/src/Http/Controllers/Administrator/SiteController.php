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

use Illuminate\Http\Request;
use Wanglelecc\Laracms\Models\Setting;

/**
 * 站点相关信息控制器
 *
 * Class SiteController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class SiteController extends Controller
{
    
    public function __construct()
    {
        static::$activeNavId = 'website';
    }
    
    /**
     * 站点设置页面
     *
     * @param Setting $setting
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function basic(Setting $setting){
        static::$activeNavId = 'website.basic';
        
        $this->authorize('basic', $setting);
        $site = $setting->take('basic');

        return backend_view('site.basic',compact('site'));
    }

    /**
     * 站点设置数据保存
     *
     * @param Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function basicStore(Request $request, Setting $setting){
        $this->authorize('basic', $setting);

        $data = $request->only('status', 'close_tips', 'name', 'create_year', 'copyright','keywords','index_keywords','slogan','icp','icp_link','meta','description','statistics', 'map');
        $setting->store($data,'basic','common','system');

        return redirect()->route('administrator.site.basic')->with('success', '保存成功.');
    }

    /**
     * 公司信息
     *
     * @param Setting $setting
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function company(Setting $setting){
        static::$activeNavId = 'website.company';
        $this->authorize('company', $setting);

        $site = $setting->take('company');

        return backend_view('site/company',compact('site'));
    }

    /**
     * 公司信息数据保存
     *
     * @param Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function companyStore(Request $request, Setting $setting){
        $this->authorize('company', $setting);

        $data = $request->only('name', 'description', 'content');
        $setting->store($data,'company','common','system');

        return redirect()->route('administrator.site.company')->with('success', '保存成功.');
    }

    /**
     * 联系方式页面
     *
     * @param Setting $setting
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function contact(Setting $setting){
        static::$activeNavId = 'website.contact';
        $this->authorize('contact', $setting);

        $site = $setting->take('contact');

        return backend_view('site/contact',compact('site'));
    }

    /**
     * 联系方式数据保存
     *
     * @param Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function contactStore(Request $request, Setting $setting){
        $this->authorize('contact', $setting);

        $data = $request->only('contacts', 'phone','fax','email','qq','weixin','weibo','wangwang','site','address');
        $setting->store($data,'contact','common','system');

        return redirect()->route('administrator.site.contact')->with('success', '保存成功.');
    }

}
