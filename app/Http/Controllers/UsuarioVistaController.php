<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioVistaModel;
use App\Models\personalModel;
use App\Models\AccesoModel;
use Barryvdh\DomPDF\Facade\Pdf;

class UsuarioVistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        
        $query = UsuarioVistaModel::join('personal as p', 'usuarios_sistemas.idPersonal', '=', 'p.idPersonal')
            ->join('accesos as a','usuarios_sistemas.idaccesos', '=','a.idaccesos')
            ->select(UsuarioVistaModel::Raw ("CONCAT (p.nombre,' ' ,p.apellidoPaterno,' ',p.apellidoMaterno) as nombre") ,UsuarioVistaModel::Raw ("CONCAT (a.claveSistema,' ', a.nombreSistema) as claveSistema"), 'usuarios_sistemas.idSistemaPersona')
            ;
            $limit=(isset($request->limit)) ? $request->limit:10;

            if ($request->has('search')) {
                $query->where('p.nombre', 'like', '%' . $request->search . '%')
                      ->orWhere('p.numeroEmpleado', 'like', '%' . $request->search . '%');
            }
            
            
        

        
            $vistas = $query->paginate(15)->appends(['search' => $request->search]);
            return view('vistauser.index', compact('vistas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
       
        $personal =personalModel::all();
        $accesos  =AccesoModel::all();


        return view('vistauser.create',compact('personal','accesos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
        $personal = new UsuarioVistaModel();
        $personal = $this->createUpdate($request, $personal);
        return redirect()
        ->route('vista.index');
    }



    public function createUpdate(Request $request, $personal){
                
        for($i=0; $i<count($request->idAccesos);$i++){
        $personal = new UsuarioVistaModel();
        $personal->idPersonal=$request->idPersonal;
        $personal->idAccesos=$request->idAccesos[$i];
        $personal->save();
        };
        //$personal->save();
        //return $personal;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
       
        $vistas=UsuarioVistaModel::where('idSistemaPersona',$id)->firstOrFail();
        return view('vistauser.show',compact('vistas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
      }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $personal=UsuarioVistaModel::findOrFail($id);
        try{
            $personal->delete();
            return redirect()
            ->route('vista.index');
        }catch(QueryException $e){
            return redirect()
            ->route('vista.index');
        }
    }
       
    



    public function __construct()
    {
        $this->middleware('auth');
    }

   
}