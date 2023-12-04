<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helper;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id','desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //visto che ho fuso create e edit gli passo i valori
        $method = 'POST';
        $project = null;
        $route = route('admin.projects.store');
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact ('method', 'route', 'project', 'technologies', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();
        $form_data['slug']=Helper::generateSlug($form_data['title'], Project::class);
        $new_project=Project::create($form_data);

        return redirect()->route('admin.projects.show', $new_project)->with('success', 'Progetto inserito con successo');


        $new_project = Project::create($form_data);

        if(array_key_exists('types', $form_data)){

        }

        return redirect()->route('admin.projects.show', $new_prject);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Project $project)
    {
        //visto che ho fuso create e edit gli passo i valori
        $method = 'PUT';
        $route = route('admin.projects.update', $project);
        $technologies = Technology::all();
        $types = Type::all();

        // Passa anche il $project alla vista
        return view('admin.projects.create', compact('method', 'route', 'technologies', 'project', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data=$request->all();
        if($form_data['title'] != $project->title){
            $form_data['slug']=Helper::generateSlug($form_data['title'], Project::class);
        }else{
            $form_data['slug']=$project->slug;
        }

        $project->update($form_data);

        if(array_key_exists('types', $for_data)){
            $project->types()->sync($form_data['types']);
        }else{
            $project->types()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
