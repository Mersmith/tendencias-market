<?php

namespace App\Livewire\Erp\Plantilla\Footer;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

#[Layout('layouts.erp.layout-erp')]
class FooterEditarLivewire extends Component
{
    public $footer;
    public $redesSociales = [];
    public $terminos = [];
    public $derechos;
    public $direccion;
    public $backgroundColor;

    public function mount()
    {
        $this->footer = json_decode(Storage::get('footer.json'), true);
        $this->redesSociales = $this->footer['redes_sociales'];
        $this->terminos = $this->footer['terminos'];
        $this->derechos = $this->footer['derechos'];
        $this->direccion = $this->footer['direccion'];
        $this->backgroundColor = $this->footer['background_color'];
    }

    #[On('handleRedesSocialesOn')]
    public function handleRedesSocialesOn($item, $position)
    {
        $index = array_search($item, array_column($this->redesSociales, 'id'));

        if ($index !== false) {
            $element = array_splice($this->redesSociales, $index, 1)[0];
            array_splice($this->redesSociales, $position, 0, [$element]);
        }
    }

    #[On('handleRedesTerminosOn')]
    public function handleRedesTerminosOn($item, $position)
    {
        $index = array_search($item, array_column($this->terminos, 'id'));

        if ($index !== false) {
            $element = array_splice($this->terminos, $index, 1)[0];
            array_splice($this->terminos, $position, 0, [$element]);
        }
    }

    public function render()
    {
        return view('livewire.erp.plantilla.footer.footer-editar-livewire');
    }

    public function agregarRedSocial()
    {
        $this->redesSociales[] = [
            'id' => null,
            'nombre' => '',
            'link' => ''
        ];
    }

    public function eliminarRedSocial($index)
    {
        unset($this->redesSociales[$index]);
        $this->redesSociales = array_values($this->redesSociales);
    }

    public function agregarTermino()
    {
        $this->terminos[] = [
            'id' => null,
            'nombre' => '',
            'link' => ''
        ];
    }

    public function eliminarTermino($index)
    {
        unset($this->terminos[$index]);
        $this->terminos = array_values($this->terminos);
    }

    public function submitForm()
    {
        // Validación de datos si es necesario

        // Actualizar los datos en el archivo footer.json o cualquier almacenamiento deseado
        $this->footer['redes_sociales'] = $this->redesSociales;
        $this->footer['terminos'] = $this->terminos;
        $this->footer['derechos'] = $this->derechos;
        $this->footer['direccion'] = $this->direccion;
        $this->footer['background_color'] = $this->backgroundColor;

        Storage::put('footer.json', json_encode($this->footer));

        $this->dispatch('alertaLivewire', "Actualizado");
    }
}
