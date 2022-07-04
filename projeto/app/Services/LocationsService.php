<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class LocationsService {

    public function getEstados(): array {
        if (! Cache::get('estados')) {
            Cache::put('estados', Http::get(
                "https://servicodados.ibge.gov.br/api/v1/localidades/estados",
            ['orderBy' => 'nome']
            )->object());
        }

        return Cache::get('estados');
    }

    public function getMunicipios($siglaEstado): array {
        if (! Cache::get('municipios_'.$siglaEstado)) {
            Cache::put('municipios_'. $siglaEstado,  Http::get(
                "https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$siglaEstado}/municipios",
            )->object());
        }

        return Cache::get('municipios_'. $siglaEstado);
    }
}

