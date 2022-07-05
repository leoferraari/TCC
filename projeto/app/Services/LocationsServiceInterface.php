<?php 

namespace App\Services;

use Illuminate\Support\Collection;

interface LocationsServiceInterface {

    public function getEstados(): Collection;

    public function getMunicipios($siglaEstado): Collection;
}

