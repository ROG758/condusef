<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\personalModel;
use App\Models\AccesoModel;
use App\Models\VicepresidenciaModel;
use Illuminate\Database\QueryException;

class personalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        
        $personal=personalModel::select('*')->orderBy('idPersonal','ASC');
        $limit=(isset($request->limit)) ? $request->limit:10;

        if(isset($request->search)){
            $personal = $personal->where('idPersonal','like', '%'.$request->search.'%')
                ->orWhere('numeroEmpleado','like','%'.$request->search.'%')
                ->orWhere('nombre','like','%'.$request->search.'%')
                ->orWhere('apellidoPaterno','like','%'.$request->search.'%')
                ->orWhere('apellidoMaterno','like','%'.$request->search.'%')
                ->orWhere('area','like','%'.$request->search.'%');
        }

        $vicepresi = VicepresidenciaModel::all();

        $personal = $personal->paginate($limit)->appends($request->all());
        return view('usuarios.index',compact('personal','vicepresi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $Vicepresidencia =VicepresidenciaModel::all();
        return view('usuarios.create',compact('Vicepresidencia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $personal = new personalModel();
        $personal = $this->createUpdate($request, $personal);
        return redirect()
        ->route('personal.index');
    }

//CREACION DE USUARIOS
    public function createUpdate(Request $request, $personal){ 

        
        $personal->numeroEmpleado=$request->numeroEmpleado;
        $personal->nombre=$request-> nombre;
        $personal->apellidoPaterno=$request-> apellidoPaterno;
        $personal->apellidoMaterno=$request-> apellidoMaterno;
        $personal->area=$request-> area;
        $personal->idVicepre=$request->idVicepre;
        $personal->save();
        return $personal;


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('usuarios.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $Vicepresidencia =VicepresidenciaModel::all();
        $personal=personalModel::where('idPersonal',$id)->firstOrFail();
        return view('usuarios.edit',compact('personal','Vicepresidencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $personal=personalModel::where('idPersonal',$id)->firstOrFail();
        $personal=$this->createUpdate($request,$personal);
        return redirect()
        ->route('personal.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $personal=personalModel::findOrFail($id);
        try{
            $personal->delete();
            return redirect()
            ->route('personal.index');
        }catch(QueryException $e){
            return redirect()
            ->route('personal.index');
        }
        
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}