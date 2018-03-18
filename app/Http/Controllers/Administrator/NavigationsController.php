<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\NavigationRequest;
use Illuminate\Support\Facades\View;
use App\Models\Navigation;
use App\Handlers\NavigationHandler;


class NavigationsController extends Controller
{
    public function index( $category, Navigation $navigation, NavigationHandler $navigationHandler){
        $this->authorize('index', $navigation);
        $navigations = $navigation->ordered()->recent('asc')->where('category','=', $category)->get();
        if($navigations){
            $navigations = $navigationHandler->level($navigations);
        }
        $view = backend_view_exists("navigation.index_{$category}") ? backend_view("navigation.index_{$category}") : backend_view('navigation.index');
        return $view->with(compact(['category','navigations']));
    }

    public function create($category, $parent = 0, Navigation $navigation){
        $this->authorize('create', $navigation);
        $view = backend_view_exists("navigation.create_and_edit_{$category}") ? backend_view("navigation.create_and_edit_{$category}") : backend_view('navigation.create_and_edit');
        return $view->with(compact(['category','parent','navigation']));
    }

    public function store($category, NavigationRequest $request, Navigation $navigation){
        $this->authorize('create', $navigation);
        $navigation = Navigation::create($request->all());
        return redirect()->route('administrator.navigation.index',$category)->with('success', '添加成功.');
    }

    public function edit(Navigation $navigation, $category){
        $this->authorize('update', $navigation);
        $view = backend_view_exists("navigation.create_and_edit_{$category}") ? backend_view("navigation.create_and_edit_{$category}") : backend_view('navigation.create_and_edit');
        $parent = $navigation->parent;
        return $view->with(compact(['navigation','category','parent']));
    }

    public function update(Navigation $navigation, $category, NavigationRequest $request){
        $this->authorize('update', $navigation);
        $navigation->update($request->all());
        return redirect()->route('administrator.navigation.index',$category)->with('success', '更新成功.');
    }

    public function destroy(Navigation $navigation, $category){
        $this->authorize('destroy', $navigation);
        $navigation->delete();
        return redirect()->route('administrator.navigation.index',$category)->with('success', '删除成功.');
    }

    public function order(Navigation $navigation, $category){
        $this->authorize('update', $navigation);
        $ids = request('id',[]);
        $order = request('order',[]);

        foreach($ids as $k => $id){
            $navigation->where('id',$id)->update(['order' => $order[$k] ?? 999 ]);
        }

        return redirect()->route('administrator.navigation.index', $category)->with('success', '操作成功.');
    }
}
