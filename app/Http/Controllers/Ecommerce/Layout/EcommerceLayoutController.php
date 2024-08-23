<?php

namespace App\Http\Controllers\Ecommerce\Layout;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\EcommerceFooter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EcommerceLayoutController extends Controller
{
    public function getEcommerceFooter($id)
    {
        $footer = EcommerceFooter::where('id', $id)
            ->where('activo', true)
            ->first();

        if ($footer) {
            $footer->enlaces_rapidos = json_decode($footer->enlaces_rapidos, true);
            $footer->redes_sociales = json_decode($footer->redes_sociales, true);
            $footer->terminos = json_decode($footer->terminos, true);
        } else {
            $footer = null;
        }

        return $footer;
    }

    public function getEcommerceCategoriaAnidadas()
    {
        $categorias = DB::table('categorias as c1')
            ->leftJoin('categorias as c2', function ($join) {
                $join->on('c2.categoria_padre_id', '=', 'c1.id')
                    ->where('c2.activo', 1); // Condición para subcategorías activas
            })
            ->whereNull('c1.categoria_padre_id')
            ->where('c1.activo', 1)
            ->select(
                'c1.id as id',
                'c1.nombre as nombre',
                'c1.slug as slug',
                'c1.descripcion as descripcion',
                'c1.icono as icono',
                'c1.imagen_ruta as imagen_ruta',
                'c2.id as sub_id',
                'c2.nombre as sub_nombre',
                'c2.slug as sub_slug',
                'c2.descripcion as sub_descripcion',
                'c2.icono as sub_icono',
                'c2.imagen_ruta as sub_imagen_ruta'
            )
            ->orderBy('c1.orden')
            ->orderBy('c2.orden')
            ->get();

        // Agrupar las subcategorías bajo sus categorías padre
        $categorias_anidadas = [];
        foreach ($categorias as $categoria) {
            if (!isset($categorias_anidadas[$categoria->id])) {
                $categorias_anidadas[$categoria->id] = [
                    'id' => $categoria->id,
                    'nombre' => $categoria->nombre,
                    'url' => url("category/{$categoria->id}/{$categoria->slug}"),
                    'descripcion' => $categoria->descripcion,
                    'icono' => $categoria->icono,
                    'imagen_url' => $categoria->imagen_ruta ? $categoria->imagen_ruta : null,
                    'subcategorias' => [],
                ];
            }

            if ($categoria->sub_id) {
                $categorias_anidadas[$categoria->id]['subcategorias'][] = [
                    'id' => $categoria->sub_id,
                    'nombre' => $categoria->sub_nombre,
                    'url' => url("category/{$categoria->sub_id}/{$categoria->sub_slug}"),
                    'descripcion' => $categoria->sub_descripcion,
                    'icono' => $categoria->sub_icono,
                    'imagen_url' => $categoria->sub_imagen_ruta ? $categoria->sub_imagen_ruta : null,

                ];
            }
        }

        return $categorias_anidadas;
    }

    public function getEcommerceCantidadItemsCarrito()
    {

        $user = Auth::user();

        if (!$user || !$user->hasRole('comprador')) {
            return 0; // Retorna 0 si el usuario no está autenticado o no es un comprador
        }

        // Busca el carrito asociado al usuario
        $carrito = Carrito::where('user_id', $user->id)->first();

        if (!$carrito) {
            return 0; // Retorna 0 si no se encuentra un carrito para el usuario
        }

        // Cuenta los ítems en el carrito
        $cantidadItems = $carrito->detalle()->count();

        return $cantidadItems;
    }

}