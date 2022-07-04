<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use App\Facades\Locations;

class DynamicDropdown extends Component
{

    public $estado;
    public $cidades = [];

    public function getEstadosProperty() {
        return Locations::getEstados();
    }

    public function updatedEstado() {
        $this->cidades = Locations::getMunicipios($this->estado);
    }

    public function render()
    {
        return view('livewire.dynamic-dropdown');
    }
}
