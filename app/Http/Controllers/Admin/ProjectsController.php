<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::latest()->where('status', true)->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'description' => 'required',
            'deal_value' => '',
            'deal_expense' => '',
            'deal_profit' => '',
            'start_date' => ''
            // 'image' => 'required'
        ]);
        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->deal_value);
        if(isset($image))
        {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            // check project directory if it exists
            if(!Storage::disk('public')->exists('project'))
            {
                Storage::disk('public')->makeDirectory('project');
            }
            // resize image for Project upload
            $project = Image::make($image)->resize(700,700)->stream();
            Storage::disk('public')->put('project/'.$imageName,$project);
        }else{
            $imageName = "default.png";
        }
        $project = new Project();
        $project->description = $request->description;
        $project->deal_value = $request->deal_value;
        $project->deal_expense = $request->deal_expense;
        $project->deal_profit = $request->deal_profit;
        $project->start_date = $request->start_date;
        $project->image = $imageName;
    
        if($project->save()){
            $response = [
                'status' =>true,
                'message'=>'Project Successfully Submited',
            ];
        }else{
            $response = [
                'status' =>false,
                'message'=>'Project not submitted',
            ];
        }
        // echo json_encode($response); exit; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if (Storage::disk('public')->exists('project/'.$project->image))
        {
            Storage::disk('public')->delete('project/'.$project->image);
        }
        $project->delete();

        // if($loan->delete()){
        //     $response = [
        //         'status' =>true,
        //         'message'=>'Project Successfully Deleted',
        //     ];
        // }else{
        //     $response = [
        //         'status' =>false,
        //         'message'=>'Project not Deleted',
        //     ];
        // }
        // // echo json_encode($response); exit; 
        // Toastr::success('Project Successfully Deleted', 'Success');
        return redirect()->back();
    }

    public function completed()
    {
        $projects = Project::where('status',false)->get();
        return view('admin.projects.completed', compact('projects'));
    }

    public function failed()
    {
        $projects = Project::where('status', 2)->get();
        return view('admin.projects.failed', compact('projects'));
    }
}
