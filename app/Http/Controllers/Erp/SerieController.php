<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Http\Requests\SerieRequest;
use App\Models\Sede;
use App\Models\Serie;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function vistaTodas()
    {
        $series = Serie::all();
        return view('erp.serie.todas', compact('series'));
    }

    public function vistaCrear()
    {
        $sedes = Sede::all();
        $tipo_documentos = TipoDocumento::all();
        return view('erp.serie.crear', compact('sedes', 'tipo_documentos'));
    }

    public function crear(SerieRequest $request)
    {
        $serie = new Serie();
        $serie->sede_id = $request->sede_id;
        $serie->tipo_documento_id = $request->tipo_documento_id;
        $serie->nombre = $request->nombre;
        $serie->correlativo = $request->correlativo;
        $serie->descripcion = $request->descripcion;
        $serie->activo = $request->activo;
        $serie->save();

        return redirect()->route('erp.serie.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaEditar($id)
    {
        $serie = Serie::find($id);
        $sedes = Sede::all();
        $tipo_documentos = TipoDocumento::all();
        return view('erp.serie.editar', compact('serie', 'sedes', 'tipo_documentos'));
    }

    public function editar(SerieRequest $request, $id)
    {
        $serie = Serie::findOrFail($id);

        $serie->sede_id = $request->sede_id;
        $serie->tipo_documento_id = $request->tipo_documento_id;
        $serie->nombre = $request->nombre;
        $serie->correlativo = $request->correlativo;
        $serie->descripcion = $request->descripcion;
        $serie->activo = $request->activo;
        $serie->save();

        return redirect()->route('erp.serie.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $serie = Serie::find($id);
        $serie->delete();

        return redirect()->route('erp.serie.vista.todas')->with('alerta', 'Eliminado');
    }
}
