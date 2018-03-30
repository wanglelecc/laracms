<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class SiteController extends Controller
{

    /**
     * 站点设置页面
     * @return mixed
     */
    public function basic(Setting $setting){
        $this->authorize('basic', $setting);
        $site = $setting->take('basic');
        return backend_view('site.basic',compact('site'));
    }

    /**
     * 站点设置数据保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function basicStore(Request $request, Setting $setting){
        $this->authorize('basic', $setting);
        $data = $request->only('name', 'create_year', 'copyright','keywords','index_keywords','slogan','icp','icp_link','meta','description','statistics');
        $setting->store($data,'basic','common','system');

        return redirect()->route('administrator.site.basic')->with('success', '保存成功.');
    }

    /**
     * 公司信息
     */
    public function company(Setting $setting){
        $this->authorize('company', $setting);
        $site = $setting->take('company');
        return backend_view('site/company',compact('site'));
    }

    /**
     * 公司信息数据保存
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function companyStore(Request $request, Setting $setting){
        $this->authorize('company', $setting);
        $data = $request->only('name', 'description', 'content');
        $setting->store($data,'company','common','system');

        return redirect()->route('administrator.site.company')->with('success', '保存成功.');
    }

    /**
     * 联系方式页面
     */
    public function contact(Setting $setting){
        $this->authorize('contact', $setting);
        $site = $setting->take('contact');

        return backend_view('site/contact',compact('site'));
    }

    /**
     * 联系方式数据保存
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function contactStore(Request $request, Setting $setting){
        $this->authorize('contact', $setting);
        $data = $request->only('contacts', 'phone','fax','email','qq','weixin','weibo','wangwang','site','address');
        $setting->store($data,'contact','common','system');

        return redirect()->route('administrator.site.contact')->with('success', '保存成功.');
    }

}
