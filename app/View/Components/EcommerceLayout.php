<?php

namespace App\View\Components;

use App\Http\Controllers\Erp\EcommerceFooterController;
use App\Models\Banner;
use Illuminate\View\Component;
use Illuminate\View\View;

class EcommerceLayout extends Component
{
    public $data_footer_1;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->data_footer_1 = app(EcommerceFooterController::class)->getEcommerceFooter(1);
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.ecommerce.layout-ecommerce', [
            'data_footer_1' => $this->data_footer_1
        ]);
    }
}
