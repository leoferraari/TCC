<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DynamicDropdown extends Component
{

    public $estado;

    public function render()
    {

        $aEstados = json_decode(
            Http::get(
                'https://servicodados.ibge.gov.br/api/v1/localidades/estados',
                ['orderBy' => 'nome']
            )->body()
        );


        $aMunicipios = [];

        if ($this->estado) {
            $aMunicipios = json_decode(
                Http::get(
                    "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$this->estado}/municipios",
                )->body()
            );
        }
  
        return view('livewire.dynamic-dropdown', [
            'estados' => $aEstados,
            'municipios' => $aMunicipios
        ]);
    }
}
