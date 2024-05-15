<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VicepresidenciaModel;

class VicepresidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $vicepresidencia=VicepresidenciaModel::select('*')->orderBy('idVicepre','ASC');
        $limit=(isset($request->limit)) ? $request->limit:10;

        if(isset($request->search)){
            $vicepresidencia = $vicepresidencia->where('vicepresidencia','like', '%'.$request->search.'%');
        }
        $vicepresidencia = $vicepresidencia->paginate($limit)->appends($request->all());
        return view('vicepresidencia.index',compact('vicepresidencia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vicepresidencia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vicepresidencia = new VicepresidenciaModel();
        $vicepresidencia = $this->createUpdate($request, $vicepresidencia);
        return redirect()
        ->route('vicepresidencia.index');
    }



    public function createUpdate(Request $request, $vicepresidencia){

        $vicepresidencia->vicepresidencia=$request->vicepresidencia;              
        $vicepresidencia->save();
        return $vicepresidencia;


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vicepresidencia=VicepresidenciaModel::where('idVicepre',$id)->firstOrFail();
        return view('vicepresidencia.edit',compact('vicepresidencia'));
    
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vicepresidencia=VicepresidenciaModel::where('idVicepre',$id)->firstOrFail();
        $vicepresidencia=$this->createUpdate($request,$vicepresidencia);
        return redirect()
        ->route('vicepresidencia.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vicepresidencia=VicepresidenciaModel::findOrFail($id);
        try{
            $vicepresidencia->delete();
            return redirect()
            ->route('vicepresidencia.index');
        }catch(QueryException $e){
            return redirect()
            ->route('vicepresidencia.index');
        }
    }
}
