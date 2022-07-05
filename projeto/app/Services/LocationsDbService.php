<?php 

namespace App\Services;

use App\Models\Estado;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class LocationsDbService implements LocationsServiceInterface {

    public function getEstados(): Collection {
        if (! Cache::get('estados')) {
            Cache::put('estados', Estado::orderBy('nome')->get());
        }

        return Cache::get('estados');
    }

    public function getMunicipios($siglaEstado): Collection {
        if (! Cache::get('municipios_'.$siglaEstado)) {
            Cache::put('municipios_'. $siglaEstado,  Estado::where('sigla', $siglaEstado)->first()->municipios);
        }

        return Cache::get('municipios_'. $siglaEstado);
    }
}

