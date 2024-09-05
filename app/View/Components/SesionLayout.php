<?php

namespace App\View\Components;
use Illuminate\View\Component;
use Illuminate\View\View;

class SesionLayout extends Component
{
    public function render(): View
    {
        return view('layouts.sesion.layout-sesion');
    }
}
