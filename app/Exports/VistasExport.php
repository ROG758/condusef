<?php

namespace App\Exports;

use App\Models\UsuarioVistaModel;
use App\Models\personalModel;
use App\Models\VicepresidenciaModel;
use App\Models\AccesoModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VistasExport implements FromCollection, WithHeadings
{
    protected $acceSeleccionado;
    protected $opcionSeleccionada;

    public function __construct($acceSeleccionado, $opcionSeleccionada)
    {
        $this->acceSeleccionado = $acceSeleccionado;
        $this->opcionSeleccionada = $opcionSeleccionada;
    }

    public function collection()
    {
        if ($this->acceSeleccionado == "#" || $this->acceSeleccionado == null) {
            return UsuarioVistaModel::join('personal as p', 'usuarios_sistemas.idPersonal', '=', 'p.idPersonal')
                ->join('accesos as a', 'usuarios_sistemas.idaccesos', '=', 'a.idaccesos')
                ->selectRaw("CONCAT(p.numeroEmpleado, ' - ', p.nombre, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) as nombre, CONCAT(' ', a.claveSistema, ' - ', a.nombreSistema) as claveSistema, usuarios_sistemas.idSistemaPersona")
                ->get();
        } elseif ($this->opcionSeleccionada == 'option3') {
            return PersonalModel::join('usuarios_sistemas', 'personal.idPersonal', '=', 'usuarios_sistemas.idPersonal')
                ->join('accesos', 'usuarios_sistemas.idAccesos', '=', 'accesos.idAccesos')
                ->selectRaw("CONCAT(personal.numeroEmpleado, ' ', personal.nombre, ' ', personal.apellidoPaterno, ' ', personal.apellidoMaterno) as nombre, CONCAT(accesos.claveSistema, ' ', accesos.nombreSistema) as clavesistema, usuarios_sistemas.idSistemaPersona")
                ->where('usuarios_sistemas.idPersonal', $this->acceSeleccionado)
                ->get();
        } elseif ($this->opcionSeleccionada == 'option4') {
            return UsuarioVistaModel::join('personal as p', 'usuarios_sistemas.idPersonal', '=', 'p.idPersonal')
                ->join('accesos as a', 'usuarios_sistemas.idaccesos', '=', 'a.idaccesos')
                ->join('vicepresidencia as v', 'v.idVicepre', '=', 'p.idVicepre')
                ->selectRaw("CONCAT(p.numeroEmpleado, ' - ', p.nombre, ' ', p.apellidoPaterno, ' ', p.apellidoMaterno) as nombre, CONCAT(' ', a.claveSistema, ' - ', a.nombreSistema) as claveSistema, usuarios_sistemas.idSistemaPersona")
                ->where('v.idVicepre', $this->acceSeleccionado)
                ->get();
        } else {
            return personalModel::join('usuarios_sistemas', 'personal.idPersonal', '=', 'usuarios_sistemas.idPersonal')
                ->selectRaw("CONCAT(personal.numeroEmpleado, ' ', personal.nombre, ' ', personal.apellidoPaterno, ' ', personal.apellidoMaterno) as nombre, usuarios_sistemas.idSistemaPersona")
                ->where('usuarios_sistemas.idAccesos', $this->acceSeleccionado)
                ->get();
        }
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Clave Sistema',
            'ID Sistema Persona'
        ];
    }
}
