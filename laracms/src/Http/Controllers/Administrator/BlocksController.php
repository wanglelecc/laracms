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

use Wanglelecc\Laracms\Models\Block;
use Illuminate\Http\Request;
use Wanglelecc\Laracms\Http\Requests\Administrator\BlockRequest;

/**
 * 后台区块管理控制器
 *
 * Class BlocksController
 * @package Wanglelecc\Laracms\Http\Controllers\Administrator
 */
class BlocksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        static::$activeNavId = 'content.block';
    }

    /**
     * 列表
     *
     * @param Block $block
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function index(Block $block)
	{
        $this->authorize('index', $block);
        $blocks = $block->recent()->paginate(config('administrator.paginate.limit'));

		return backend_view('blocks.index', compact('blocks'));
	}

    /**
     * 详情
     *
     * @param Block $block
     * @return mixed
     */
    public function show(Block $block)
    {
        return backend_view('blocks.show', compact('block'));
    }

    /**
     * 创建
     *
     * @param Block $block
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function create(Block $block, Request $request)
	{
        $this->authorize('create', $block);
        $type = config('blocks.types.'.$request->type) ?  $request->type : '';

		return backend_view('blocks.create_and_edit', compact('block', 'type'));
	}

    /**
     * 保存
     *
     * @param BlockRequest $request
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function store(BlockRequest $request, Block $block)
	{
        $this->authorize('create', $block);
		$block = Block::create($request->all());

		return redirect()->route('blocks.index')->with('success', '添加成功.');
	}

    /**
     * 编辑
     *
     * @param Block $block
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function edit(Block $block)
	{
        $this->authorize('update', $block);
        $type = $block->type;

		return backend_view('blocks.create_and_edit', compact('block','type'));
	}

    /**
     * 更新
     *
     * @param BlockRequest $request
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function update(BlockRequest $request, Block $block)
	{
		$this->authorize('update', $block);
		$block->update($request->all());

		return redirect()->route('blocks.index')->with('success', '更新成功.');
	}

    /**
     * 删除
     *
     * @param Block $block
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function destroy(Block $block)
	{
		$this->authorize('destroy', $block);
		$block->delete();

		return redirect()->route('blocks.index')->with('success', '删除成功.');
	}
}