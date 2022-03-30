<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use DataTables;
use App\Models\Module;
use App\Models\Feature;

class ProjectController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Project::all())
            ->addColumn('action', function ($row) {
                $action  = '<a href="/project/' . $row->id . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a> ';
                $action  .= '<a href="/project/' . $row->id . '/edit" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $action .= \Form::open(['url' => 'project/' . $row->id,'method' => 'delete','style' => 'float:right']);
                $action .= "<button type='submit'class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>";
                $action .= \Form::close();
                return $action;
            })
            ->make(true);
        }
        return view('project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'client_name' => 'required'
        ]);
        Project::create($request->all());
        return redirect('/project')->with('status', 'A New Project Was Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data['project'] = Project::with('module')->findOrFail($id);
        if ($request->ajax()) {
            return Datatables::of($data['project']->module)
            ->addColumn('action', function ($row) {
                $action  = '<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="editModule(' . $row->id . ')" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $action .= \Form::open(['url' => 'module/' . $row->id,'method' => 'delete','style' => 'float:right']);
                $action .= "<button type='submit'class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>";
                $action .= \Form::close();
                return $action;
            })
            ->addColumn('module_name', function ($row) {
                return '<b>'.$row->module_name.'</b><br>'.$row->description;
            })
            ->addColumn('feature', function ($row) {
                $feature = Feature::where('module_id', $row->id)->get();
                $listFeature = "";
                foreach ($feature as $fe) {
                    $checked = $fe->is_done == 1 ? 'checked' : '';
                    $listFeature .= "<i onclick='featureEdit(" . $fe->id . ")' class='fas fa-edit' data-bs-toggle='modal' data-bs-target='#exampleModalFeature'></i> <i class='fas fa-trash' onclick='featureDelete(" . $fe->id . ")'></i> <input type='checkbox' $checked> " . $fe->name . '<br>';
                }
                return $listFeature;
            })
            ->rawColumns(['feature','action','module_name'])
            ->make(true);
        }
        $data['module'] = Module::where('project_id',$id)->pluck('module_name', 'id');
        return view('project.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_fakultas)
    {
        $data['fakultas'] = Project::where('kode_fakultas', $kode_fakultas)->first();
        return view('project.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_fakultas)
    {
        $request->validate([
            'nama_fakultas' => 'required|min:6'
        ]);


        $fakultas = Project::where('kode_fakultas', '=', $kode_fakultas);
        $fakultas->update($request->except('_method', '_token'));
        return redirect('/fakultas')->with('status', 'Data fakultas Berhasil Di Update');
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->module()->feature()->delete();
        $project->module()->delete();
        $project->delete();
        return redirect('/project')->with('message', 'A project With Name ' . $project->project_name . 'Was Deleted');
        ;
    }
}
