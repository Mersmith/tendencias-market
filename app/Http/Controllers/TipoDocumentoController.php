<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoDocumentoRequest;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class TipoDocumentoController extends Controller
{
    public function vistaTodas()
    {
        $tipo_documentos = TipoDocumento::all();
        return view('erp.tipo-documento.todas', compact('tipo_documentos'));
    }

    public function vistaCrear()
    {
        return view('erp.tipo-documento.crear');
    }

    public function crear(TipoDocumentoRequest $request)
    {
        $tipo_documento = new TipoDocumento();
        $tipo_documento->nombre = $request->nombre;
        $tipo_documento->save();

        return redirect()->route('erp.tipo-documento.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaEditar($id)
    {
        $tipo_documento = TipoDocumento::find($id);
        return view('erp.tipo-documento.editar', compact('tipo_documento'));
    }

    public function editar(TipoDocumentoRequest $request, $id)
    {
        $tipo_documento = TipoDocumento::findOrFail($id);
        $tipo_documento->nombre = $request->nombre;
        $tipo_documento->save();

        return redirect()->route('erp.tipo-documento.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $tipo_documento = TipoDocumento::find($id);
        $tipo_documento->delete();

        return redirect()->route('erp.tipo-documento.vista.todas')->with('alerta', 'Eliminado');
    }
}
