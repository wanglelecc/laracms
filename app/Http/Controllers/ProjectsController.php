<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$projects = Project::paginate();
		return view('projects.index', compact('projects'));
	}

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

	public function create(Project $project)
	{
		return view('projects.create_and_edit', compact('project'));
	}

	public function store(ProjectRequest $request)
	{
		$project = Project::create($request->all());
		return redirect()->route('projects.show', $project->id)->with('message', 'Created successfully.');
	}

	public function edit(Project $project)
	{
        $this->authorize('update', $project);
		return view('projects.create_and_edit', compact('project'));
	}

	public function update(ProjectRequest $request, Project $project)
	{
		$this->authorize('update', $project);
		$project->update($request->all());

		return redirect()->route('projects.show', $project->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Project $project)
	{
		$this->authorize('destroy', $project);
		$project->delete();

		return redirect()->route('projects.index')->with('message', 'Deleted successfully.');
	}
}