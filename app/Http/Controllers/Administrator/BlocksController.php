<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Block;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\BlockRequest;

class BlocksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Block $block)
	{
        $this->authorize('index', $block);
        $blocks = $block->recent()->paginate(config('administrator.paginate.limit'));
		return backend_view('blocks.index', compact('blocks'));
	}

    public function show(Block $block)
    {
        return backend_view('blocks.show', compact('block'));
    }

	public function create(Block $block, Request $request)
	{
        $this->authorize('create', $block);
        $type = config('blocks.types.'.$request->type) ?  $request->type : '';
		return backend_view('blocks.create_and_edit', compact('block', 'type'));
	}

	public function store(BlockRequest $request, Block $block)
	{
        $this->authorize('create', $block);
		$block = Block::create($request->all());
		return redirect()->route('blocks.index')->with('success', '添加成功.');
	}

	public function edit(Block $block)
	{
        $this->authorize('update', $block);
        $type = $block->type;
		return backend_view('blocks.create_and_edit', compact('block','type'));
	}

	public function update(BlockRequest $request, Block $block)
	{
		$this->authorize('update', $block);
		$block->update($request->all());

		return redirect()->route('blocks.index')->with('success', '更新成功.');
	}

	public function destroy(Block $block)
	{
		$this->authorize('destroy', $block);
		$block->delete();

		return redirect()->route('blocks.index')->with('success', '删除成功.');
	}
}