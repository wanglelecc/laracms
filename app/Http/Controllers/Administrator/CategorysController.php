<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\CategoryRequest;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Handlers\CategoryHandler;


class CategorysController extends Controller
{
    public function index( $type, Category $category, CategoryHandler $categoryHandler){
        $this->authorize('index', $category);
        $categorys = $category->ordered()->recent('asc')->where('type','=', $type)->get();
        if($categorys){
            $categorys = $categoryHandler->level($categorys);
        }
        $view = backend_view_exists("category.index_{$type}") ? backend_view("category.index_{$type}") : backend_view('category.index');
        return $view->with(compact(['type','categorys']));
    }

    public function create($type, $parent = 0, Category $category){
        $this->authorize('create', $category);
        $view = backend_view_exists("category.create_and_edit_{$type}") ? backend_view("category.create_and_edit_{$type}") : backend_view('category.create_and_edit');
        return $view->with(compact(['type','parent','category']));
    }

    public function store($type, CategoryRequest $request, Category $category){
        $this->authorize('create', $category);
        $category = Category::create($request->all());
        return redirect()->route('administrator.category.index',$type)->with('success', '添加成功.');
    }

    public function edit(Category $category, $type){
        $this->authorize('update', $category);
        $view = backend_view_exists("category.create_and_edit_{$type}") ? backend_view("category.create_and_edit_{$type}") : backend_view('category.create_and_edit');
        $parent = $category->parent;
        return $view->with(compact(['category','type','parent']));
    }

    public function update(Category $category, $type, CategoryRequest $request){
        $this->authorize('update', $category);
        $category->update($request->all());
        return redirect()->route('administrator.category.index',$type)->with('success', '更新成功.');
    }

    public function destroy(Category $category, $type){
        $this->authorize('destroy', $category);
        $category->delete();
        return redirect()->route('administrator.category.index',$type)->with('success', '删除成功.');
    }

    public function order(Category $category, $type){
        $this->authorize('update', $category);
        $ids = request('id',[]);
        $order = request('order',[]);

        foreach($ids as $k => $id){
            $category->where('id',$id)->update(['order' => $order[$k] ?? 999 ]);
        }

        return redirect()->route('administrator.category.index', $type)->with('success', '操作成功.');
    }
}
