<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioVistaModel;
use App\Models\personalModel;
use App\Models\AccesoModel;
use App\Models\VicepresidenciaModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class SistemaUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UsuarioVistaModel::join('personal as p', 'usuarios_sistemas.idPersonal', '=', 'p.idPersonal')
            ->join('accesos as a', 'usuarios_sistemas.idaccesos', '=', 'a.idaccesos')
            ->select(
                UsuarioVistaModel::Raw("CONCAT(p.nombre, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) as nombre"),
                UsuarioVistaModel::Raw("CONCAT(a.claveSistema, ' ', a.nombreSistema) as claveSistema"),
                'usuarios_sistemas.idSistemaPersona'
            )
            ->distinct();
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($query) use ($search) {
                $query->where('p.nombre', 'like', "%$search%")
                    ->orWhere('p.apellidoPaterno', 'like', "%$search%")
                    ->orWhere('p.apellidoMaterno', 'like', "%$search%")
                    ->orWhere('p.numeroEmpleado' , 'like', "%$search%")
                    ->orWhere('a.claveSistema', 'like', "%$search%")
                    ->orWhere('a.nombreSistema', 'like', "%$search%");
            });
        }
        
        $vistas = $query->paginate(15)->appends(['search' => $request->search]);
        $acce = $this->unique();
        $usua= $this->uniqueusuario(); 
        $vicepres=$this->uniquevicepre();
        //dd($usua);      JOSE MARTIN
        return view('sistemasUsuarios.index', compact('vistas','acce','usua','vicepres'));
    }
    

    public function pdf(Request $request)
    {
        $acceSeleccionado = $request->input('acce');
        $opcionSeleccionada = $request->input('opcionTodo'); // Captura el valor correcto del input
        
        if ($acceSeleccionado == "#" || $acceSeleccionado == null) {
            // Ejecuta la consulta y obtén los datos
            $vistas = UsuarioVistaModel::join('personal as p', 'usuarios_sistemas.idPersonal', '=', 'p.idPersonal')
                ->join('accesos as a', 'usuarios_sistemas.idaccesos', '=', 'a.idaccesos')
                ->select(
                    UsuarioVistaModel::Raw("CONCAT(p.numeroEmpleado, ' - ', p.nombre, '  ', p.apellidoPaterno, '  ', p.apellidoMaterno) as nombre"),
                    UsuarioVistaModel::Raw("CONCAT(' ',a.claveSistema, ' - ', a.nombreSistema) as claveSistema"),
                    'usuarios_sistemas.idSistemaPersona'
                )
                ->get(); // Ejecuta la consulta y obtiene los resultados
    
            // Pasa los datos a la vista y genera el PDF
            $pdf = PDF::loadView('sistemasUsuarios.pdf', compact('vistas'));
            return $pdf->stream();
        } elseif ($opcionSeleccionada == 'option3') {
            // Obtener el personal asociado a un sistema específico
            $vistas = PersonalModel::join('usuarios_sistemas', 'personal.idPersonal', '=', 'usuarios_sistemas.idPersonal')
                ->join('accesos', 'usuarios_sistemas.idAccesos', '=', 'accesos.idAccesos')
                ->selectRaw("CONCAT(personal.numeroEmpleado, ' ', personal.nombre, ' ', personal.apellidoPaterno, ' ', personal.apellidoMaterno) as nombre, CONCAT(accesos.claveSistema, ' ', accesos.nombreSistema) as clavesistema")
                ->where('usuarios_sistemas.idPersonal', $acceSeleccionado)
                ->get();
            
            // Obtener y concatenar el nombre completo del personal
            $resultado = PersonalModel::where('idPersonal', $acceSeleccionado)
                ->selectRaw("CONCAT(nombre, ' ', apellidoPaterno, ' ', apellidoMaterno) as nombreCompleto")
                ->pluck('nombreCompleto');
        
            // Convertir el resultado a string
            $nombreCompleto = $resultado->isNotEmpty() ? $resultado[0] : '';
            
            // Generar el PDF con la vista correspondiente
            $pdf = PDF::loadView('sistemasUsuarios.pdf0', compact('vistas', 'nombreCompleto'));
        
            return $pdf->stream();
        } else {
            $vistas = PersonalModel::join('usuarios_sistemas', 'personal.idPersonal', '=', 'usuarios_sistemas.idPersonal')
                ->selectRaw("CONCAT(personal.numeroEmpleado, ' ', personal.nombre, ' ', personal.apellidoPaterno, ' ', personal.apellidoMaterno) as nombre")
                ->where('usuarios_sistemas.idAccesos', $acceSeleccionado)
                ->get();
    
            $resultado = AccesoModel::where('idAccesos', $acceSeleccionado)->pluck('nombreSistema');
            $resultado = strval($resultado[0]);
    
            $pdf = PDF::loadView('sistemasUsuarios.pdf1', compact('vistas', 'resultado'));
    
            return $pdf->stream();
        }
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personal =personalModel::all();
        $accesos  =AccesoModel::all();


        return view('sistemasUsuarios.create',compact('personal','accesos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $personal = new UsuarioVistaModel();
        $personal = $this->createUpdate($request, $personal);
        return redirect()
        ->route('sistemas.index');
    }

    public function createUpdate(Request $request, $personal){
                
        for($i=0; $i<count($request->idPersonal);$i++){
        $personal = new UsuarioVistaModel();
        $personal->idPersonal=$request->idPersonal[$i];
        $personal->idAccesos=$request->idAccesos;
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vistas=UsuarioVistaModel::findOrFail($id);
        try{
            $vistas->delete();
            return redirect()
            ->route('sistemas.index');
        }catch(QueryException $e){
            return redirect()
            ->route('sistemas.index');
        }
    }
    // sistemas de informacion
    public function unique()
    {   
       $concat = UsuarioVistaModel::join('accesos as a', 'usuarios_sistemas.idaccesos', '=', 'a.idaccesos')
       ->select(
        UsuarioVistaModel::Raw("CONCAT(a.claveSistema, ' ', a.nombreSistema) as claveSistema"),
        'a.idaccesos'
        )
        ->distinct('a.idaccesos')
        ->get();


    return $concat;
        
       }
       

        public function uniqueusuario(){
        $concatusuario = UsuarioVistaModel::join('personal as p', 'usuarios_sistemas.idPersonal', '=', 'p.idPersonal')
       ->select(
        UsuarioVistaModel::Raw("CONCAT(p.numeroEmpleado, ' ', p.nombre,' ',p.apellidoPaterno) as nombre"),
        'p.idPersonal'
        )
        ->distinct('a.idaidPersonalccesos')
        ->get();


    return $concatusuario;
    


       }

       public function uniquevicepre(){
        $vicepresidencias = VicepresidenciaModel::join('personal', 'personal.idVicepre', '=', 'vicepresidencia.idVicepre')
        ->join('usuarios_sistemas', 'usuarios_sistemas.idPersonal', '=', 'personal.idPersonal')
        ->select('vicepresidencia.vicepresidencia')
        ->distinct()
        ->get();

    
        return $vicepresidencias;
       }


    public function obtenerDatosAccesoJson()
    {

        $concat = UsuarioVistaModel::join('accesos as a', 'usuarios_sistemas.idAccesos', '=', 'a.idaccesos')
        ->select(
         UsuarioVistaModel::Raw("CONCAT(a.claveSistema, ' ', a.nombreSistema) as claveSistema"),
         'a.idaccesos'
         )
         ->distinct('a.idaccesos')
         ->get();
    // Devuelve los datos en formato JSON
    return Response::json($concat);
    }


    public function obtenerDatosUsuarioJson()
    {
       
        $concatusuario = UsuarioVistaModel::join('personal as p', 'usuarios_sistemas.idPersonal', '=', 'p.idPersonal')
            ->select(
                UsuarioVistaModel::Raw("CONCAT(p.numeroEmpleado, ' ', p.nombre, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) as nombre"),
                'p.idPersonal'
            )
            ->distinct('p.idPersonal')
            ->get();

        // Devuelve los datos en formato JSON
        return Response::json($concatusuario);
    }

    public function obtenerDatosVicepresidenciaJson()
    {
        $concatvicepresidencia=VicepresidenciaModel::join('personal', 'personal.idVicepre', '=', 'vicepresidencia.idVicepre')
        ->join('usuarios_sistemas', 'usuarios_sistemas.idPersonal', '=', 'personal.idPersonal')
        ->select('vicepresidencia.vicepresidencia')
        ->distinct()
        ->get();

        return Response::json($concatvicepresidencia);

    }
        
    }