<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccesoModel;
use App\Models\Roles_sistemaModel;
use App\Models\InformacionModel;
use App\Models\CaracteristicasModel;
use App\Models\DocumentacionModel;
use App\Models\SeguridadModel;
use App\Models\Datos_personalesModel;
use App\Models\MantenimientoModel;



class AccesoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $accesos=AccesoModel::select('*')->orderBy('claveSistema','ASC');
        $limit=(isset($request->limit)) ? $request->limit:10;

        if(isset($request->search)){
            $accesos = $accesos->where('nombreSistema','like', '%'.$request->search.'%')
                ->orWhere('claveSistema','like','%'.$request->search.'%')
                ->orWhere('descripcion','like','%'.$request->search.'%')
                ->orWhere('siglas','like','%'.$request->search.'%')
                ->orWhere('clasificacion','like','%'.$request->search.'%')
                ->orWhere('desarrollo','like','%'.$request->search.'%')
                ->orWhere('estatus','like','%'.$request->search.'%');
        }
        
        $accesos = $accesos->paginate($limit)->appends($request->all());
        return view('accesos.index',compact('accesos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $Rolsistema =Roles_sistemaModel::all();
        $Informacionsis=InformacionModel::all();
        $caracteristicas=CaracteristicasModel::all();
        $Documentacion=DocumentacionModel::all();
        $seguridad=SeguridadModel::all();
        $datos=Datos_personalesModel::all();
        $mantenimiento=MantenimientoModel::all();
        return view('accesos.create',compact('Rolsistema','Informacionsis','caracteristicas','Documentacion','seguridad','datos','mantenimiento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $acceso = new AccesoModel();
        $acceso = $this->createUpdate($request, $acceso);
        return redirect()
        ->route('acceso.index');
    }

    public function createUpdate(Request $request, $acceso){

        $acceso->claveSistema=$request->claveSistema;
        $acceso->nombreSistema=$request-> nombreSistema;
        $acceso->descripcion=$request-> descripcion;
        $acceso->siglas=$request-> siglas;
        $acceso->clasificacion=$request-> clasificacion;
        $acceso->desarrollo=$request-> desarrollo;
        $acceso->estatus=$request-> estatus;
        $acceso->url=$request-> url;
        $acceso->idRolSistema = null;
        $acceso->idInformacion = null;
        $acceso->idCaracteriticas = null;
        $acceso->idDocumentacion = null;
        $acceso->idSeguridad = null;
        $acceso->idMantenimiento = null;
        $acceso->idDatos = null;
        $acceso->idAccesos = null;
        

        $acceso->save();
        return $acceso;


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     */
 
     public function edit(string $id)
     {
         $acceso = AccesoModel::where('idAccesos', $id)->firstOrFail();
     
         $Rolsistema = Roles_sistemaModel::all();
         $Informacionsis = InformacionModel::all();
         $caracteristicas = CaracteristicasModel::all();
         $Documentacion = DocumentacionModel::all();
         $seguridad = SeguridadModel::all();
         $datos = Datos_personalesModel::all();
         $mantenimiento = MantenimientoModel::all();
     
         return view('accesos.edit', compact('acceso', 'Rolsistema', 'Informacionsis', 'caracteristicas', 'Documentacion', 'seguridad', 'datos', 'mantenimiento'));
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
        //
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}