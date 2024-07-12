<?php

namespace App\Http\Controllers\Erp\Footer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ErpFooterController extends Controller
{
    public function get()
    {
        $footer = json_decode(Storage::get('footer.json'), true);
        return response()->json($footer);
    }

    public function set(Request $request)
    {
        $footerData = $request->all();
        Storage::put('footer.json', json_encode($footerData));
        return response()->json(['message' => 'Actualizado']);
    }
}
