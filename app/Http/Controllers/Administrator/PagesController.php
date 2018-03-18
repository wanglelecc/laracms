<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\PageRequest;

class PagesController extends Controller
{
    public function index(Page $page)
    {
        $this->authorize('index', $page);
        $pages = $page->filterWith()->ordered()->recent()->paginate(config('administrator.paginate.limit'));
        return backend_view('pages.index', compact('pages'));
    }

    public function show(Page $page)
    {
        return backend_view('pages.show', compact('page'));
    }

    public function create(Page $page)
    {
        $this->authorize('create', $page);
        return backend_view('pages.create_and_edit', compact('page'));
    }

    public function store(PageRequest $request, Page $page)
    {
        $this->authorize('create', $page);
        $page = Page::create($request->all());
        return redirect()->route('pages.index')->with('success', '添加成功.');
    }

    public function edit(Page $page)
    {
        $this->authorize('update', $page);
        return backend_view('pages.create_and_edit', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $this->authorize('update', $page);
        $page->update($request->all());
        return redirect()->route('pages.index')->with('success', '更新成功.');
    }

    public function destroy(Page $page)
    {
        $this->authorize('destroy', $page);
        $page->delete();
        return redirect()->route('pages.index')->with('success', '删除成功.');
    }
}