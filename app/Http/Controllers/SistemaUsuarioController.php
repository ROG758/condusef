<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioVistaModel;
use App\Models\personalModel;
use App\Models\AccesoModel;
use App\Models\VicepresidenciaModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use App\Exports\VistasExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log; 

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
                    ->orWhere('p.numeroEmpleado', 'like', "%$search%")
                    ->orWhere('a.claveSistema', 'like', "%$search%")
                    ->orWhere('a.nombreSistema', 'like', "%$search%");
            });
        }
    
        $estatus = UsuarioVistaModel::all(); 
        
        // Definir el límite por página
        $limit = $request->input('limit', 15);
        $vistas = $query->paginate($limit)->appends(['search' => $request->search]);
    
        // Calcular el índice inicial
        $currentPage = $vistas->currentPage();
        $perPage = $vistas->perPage();
        $init = ($currentPage - 1) * $perPage;
    
        $acce = $this->unique();
        $usua = $this->uniqueusuario(); 
        $vicepres = $this->uniquevicepre();
        $area = $this->uniqueArea();
       
        return view('sistemasUsuarios.index', compact('vistas', 'acce', 'usua', 'vicepres', 'estatus', 'area', 'init'));
    }
    
    

  
    public function export(Request $request)
    {

        ini_set('memory_limit', '1024M');

        $acceSeleccionado = $request->input('acce');
        $opcionSeleccionada = $request->input('opcionTodo');
        $exportType = $request->input('exportType');
    
        if ($exportType == 'pdf') {
            if ($acceSeleccionado == "#" || $acceSeleccionado == null) {
                $vistas = UsuarioVistaModel::join('personal as p', 'usuarios_sistemas.idPersonal', '=', 'p.idPersonal')
                    ->join('accesos as a', 'usuarios_sistemas.idaccesos', '=', 'a.idaccesos')
                    ->selectRaw("CONCAT(p.numeroEmpleado, ' - ', p.nombre, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) as nombre, CONCAT(' ',a.claveSistema, ' - ', a.nombreSistema) as claveSistema, usuarios_sistemas.idSistemaPersona")
                    ->get();
    
                $estatus = UsuarioVistaModel::all();
    
                $pdf = PDF::loadView('sistemasUsuarios.pdf', compact('vistas', 'estatus'));
                return $pdf->stream();
            } elseif ($opcionSeleccionada == 'option3') {
                $vistas = PersonalModel::join('usuarios_sistemas', 'personal.idPersonal', '=', 'usuarios_sistemas.idPersonal')
                    ->join('accesos', 'usuarios_sistemas.idAccesos', '=', 'accesos.idAccesos')
                    ->selectRaw("CONCAT(personal.numeroEmpleado, ' ','-', personal.nombre, ' ', personal.apellidoPaterno, ' ', personal.apellidoMaterno) as nombre, CONCAT(accesos.claveSistema, ' ', accesos.nombreSistema) as clavesistema, usuarios_sistemas.idSistemaPersona")
                    ->where('usuarios_sistemas.idPersonal', $acceSeleccionado)
                    ->get();
    
                $resultado = PersonalModel::where('idPersonal', $acceSeleccionado)
                    ->selectRaw("CONCAT(nombre, ' ', apellidoPaterno, ' ', apellidoMaterno) as nombreCompleto")
                    ->pluck('nombreCompleto');
    
                $nombreCompleto = $resultado->isNotEmpty() ? $resultado[0] : '';
                $estatus = UsuarioVistaModel::all();
    
                $pdf = PDF::loadView('sistemasUsuarios.pdf0', compact('vistas', 'nombreCompleto', 'estatus'));
                return $pdf->stream();
            } elseif ($opcionSeleccionada == 'option4') {
                $vistas = UsuarioVistaModel::join('personal as p', 'usuarios_sistemas.idPersonal', '=', 'p.idPersonal')
                    ->join('accesos as a', 'usuarios_sistemas.idaccesos', '=', 'a.idaccesos')
                    ->join('vicepresidencia as v', 'v.idVicepre', '=', 'p.idVicepre')
                    ->selectRaw("CONCAT(p.numeroEmpleado, ' - ', p.nombre, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) as nombre, CONCAT(' ', a.claveSistema, ' - ', a.nombreSistema) as claveSistema, usuarios_sistemas.idSistemaPersona")
                    ->where('v.idVicepre', $acceSeleccionado)
                    ->get();
    
                $resultado = VicepresidenciaModel::where('idVicepre', $acceSeleccionado)
                    ->pluck('vicepresidencia');
                $resultado = strval($resultado[0]);
                $estatus = UsuarioVistaModel::all();
    
                $pdf = PDF::loadView('sistemasUsuarios.pdf2', compact('vistas', 'resultado', 'estatus'));
                return $pdf->stream();
            }else if ($opcionSeleccionada == 'option5') {
                // Realiza la unión entre las tablas personal y usuarios_sistemas usando join y ejecuta la consulta con get()
                $vistas = UsuarioVistaModel::join('personal as p', 'usuarios_sistemas.idPersonal', '=', 'p.idPersonal')
                ->join('accesos as a', 'usuarios_sistemas.idaccesos', '=', 'a.idaccesos')
                ->join('vicepresidencia as v', 'v.idVicepre', '=', 'p.idVicepre')
                ->selectRaw("CONCAT(p.numeroEmpleado, ' - ', p.nombre, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) as nombre, CONCAT(' ', a.claveSistema, ' - ', a.nombreSistema) as claveSistema, usuarios_sistemas.idSistemaPersona")
                ->where('p.area', $acceSeleccionado)  // Filtra por área
                ->get();
            
                // Obtén el valor del área seleccionada usando pluck y conviértelo a cadena
                $resultado = personalModel::where('area', $acceSeleccionado)->pluck('area')->first();
               
                $estatus = UsuarioVistaModel::all();
                

                $area = personalModel::all();
            
                // Carga la vista del PDF con los datos obtenidos
                $pdf = PDF::loadView('sistemasUsuarios.pdf3', compact('area', 'resultado', 'vistas','estatus'));
            
                return $pdf->stream();

            }else {
                $vistas = PersonalModel::join('usuarios_sistemas', 'personal.idPersonal', '=', 'usuarios_sistemas.idPersonal')
                    ->selectRaw("CONCAT(personal.numeroEmpleado, ' ','- ', personal.nombre, ' ', personal.apellidoPaterno, ' ', personal.apellidoMaterno) as nombre, usuarios_sistemas.idSistemaPersona")
                    ->where('usuarios_sistemas.idAccesos', $acceSeleccionado)
                    ->get();
    
                $resultado = AccesoModel::where('idAccesos', $acceSeleccionado)->pluck('nombreSistema');
                $resultado = strval($resultado[0]);
                $estatus = UsuarioVistaModel::all();
    
                $pdf = PDF::loadView('sistemasUsuarios.pdf1', compact('vistas', 'resultado', 'estatus'));
                return $pdf->stream();
            }
        } elseif ($exportType == 'excel') {
            return Excel::download(new VistasExport($acceSeleccionado, $opcionSeleccionada), 'report.xlsx');
        }
    }
    
    public function UpdateStatus(Request $request)
    {
        $usuario = UsuarioVistaModel::findOrFail($request->idSistemaPersona);
        $usuario->estatus = $request->estatus;
        $usuario->save();
    
        $newStatusButton = $request->estatus == 0
            ? '<br><input id="toggle'.$request->idSistemaPersona.'" class="mi_checkbox" type="checkbox" data-id="'.$request->idSistemaPersona.'" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Activo" data-off="Inactivo">'
            : '<br><input id="toggle'.$request->idSistemaPersona.'" class="mi_checkbox" type="checkbox" data-id="'.$request->idSistemaPersona.'" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Activo" data-off="Inactivo" checked>';
    
        return response()->json(['newStatus' => $newStatusButton]);
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
    public function nombreupdate(Request $request, string $id)
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
        ->distinct('a.idPersonalccesos')
        ->get();


    return $concatusuario;
    


       }

       public function uniquevicepre(){
        $vicepresidencias = VicepresidenciaModel::join('personal', 'personal.idVicepre', '=', 'vicepresidencia.idVicepre')
        ->join('usuarios_sistemas', 'usuarios_sistemas.idPersonal', '=', 'personal.idPersonal')
        ->select('vicepresidencia.idVicepre')
        ->distinct('idVicepre')
        ->get();
    
        return $vicepresidencias;
       }

       public function uniqueArea(){
        $area = personalModel::join('usuarios_sistemas', 'personal.idPersonal', '=', 'usuarios_sistemas.idPersonal')
        ->select('personal.area', 'personal.idPersonal')
        ->distinct('personal.area')
        ->get();

        return $area;

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
        $concatvicepresidencia = VicepresidenciaModel::join('personal', 'personal.idVicepre', '=', 'vicepresidencia.idVicepre')
            ->join('usuarios_sistemas', 'usuarios_sistemas.idPersonal', '=', 'personal.idPersonal')
            ->select('vicepresidencia.vicepresidencia','vicepresidencia.idVicepre as idVicepre')
            ->distinct('vicepresidencia.idVicepre')
            ->get();
        return Response::json($concatvicepresidencia);
    }

    public function obtenerAreaJson() {
        $area = personalModel::join('usuarios_sistemas', 'personal.idPersonal', '=', 'usuarios_sistemas.idPersonal')
            ->select('personal.area')
            ->distinct()
            ->get();

        return response()->json($area);
    }
        
    }