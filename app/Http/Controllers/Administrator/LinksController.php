<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\LinkRequest;

class LinksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Link $link)
	{
	    $this->authorize('index',$link);
		$links = $link->ordered()->recent()->paginate((config('administrator.paginate.limit')));
		return backend_view('links.index', compact('links'));
	}

    public function show(Link $link)
    {
        return backend_view('links.show', compact('link'));
    }

	public function create(Link $link)
	{
        $this->authorize('create',$link);
		return backend_view('links.create_and_edit', compact('link'));
	}

	public function store(LinkRequest $request, Link $link)
	{
        $this->authorize('create',$link);
		$link = Link::create($request->all());
		return redirect()->route('links.index')->with('success', '添加成功.');
	}

	public function edit(Link $link)
	{
        $this->authorize('update', $link);
		return backend_view('links.create_and_edit', compact('link'));
	}

	public function update(LinkRequest $request, Link $link)
	{
		$this->authorize('update', $link);
		$link->update($request->all());

		return redirect()->route('links.index')->with('success', '更新成功.');
	}

	public function destroy(Link $link)
	{
		$this->authorize('destroy', $link);
		$link->delete();

		return redirect()->route('links.index')->with('success', '删除成功.');
	}
}