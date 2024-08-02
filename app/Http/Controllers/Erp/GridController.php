<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;

use App\Models\Grid;
use Illuminate\Http\Request;

class GridController extends Controller
{
    public function getEcommerceGrid($id)
    {
        $grid_1 = Grid::find($id);
        if ($grid_1) {
            $grid_1->imagenes = json_decode($grid_1->imagenes, true);
        } else {
            $grid_1 = null;
        }

        return $grid_1;
    }
}
