<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\SlideRequest;

class SlidesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Slide $slide)
	{
        $this->authorize('index', $slide);
//
		$slides = collect(config('slides'));

		return backend_view('slides.index', compact('slides'));
	}

	public function manage($group, Request $request, Slide $slide){
        $this->authorize('manage', $slide);

        $slideConfig = $this->checkGroup($group);
        $slides = $slide->where('group',$group)->ordered()->recent()->paginate((config('administrator.paginate.limit')));

        return backend_view('slides.manage', compact('slides','slideConfig', 'group'));
    }

	public function create($group, Slide $slide)
	{
        $this->authorize('create', $slide);
        $slideConfig = $this->checkGroup($group);
		return backend_view('slides.create_and_edit', compact('slide','slideConfig', 'group'));
	}

	public function store(SlideRequest $request, Slide $slide)
	{
        $this->authorize('create', $slide);
		$slide = Slide::create($request->all());
		return redirect()->route('slides.manage', $slide->group)->with('success', '添加成功.');
	}

	public function edit(Slide $slide)
	{
        $this->authorize('update', $slide);
        $group = $slide->group;
        $slideConfig = $this->checkGroup($group);
		return backend_view('slides.create_and_edit', compact('slide','slideConfig', 'group'));
	}

	public function update(SlideRequest $request, Slide $slide)
	{
		$this->authorize('update', $slide);
		$slide->update($request->all());
		return redirect()->route('slides.manage', $slide->group)->with('success', '更新成功.');
	}

	public function destroy(Slide $slide)
	{
        $this->authorize('destroy', $slide);
        $group = $slide->group;
		$slide->delete();

		return redirect()->route('slides.manage',$group)->with('success', '删除成功.');
	}

	private function checkGroup($group){
        if( !($slideConfig = config('slides.'.$group)) ){
            abort(404);
        }

        return $slideConfig;
    }
}