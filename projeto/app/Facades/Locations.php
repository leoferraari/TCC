<?php 

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array getEstados()
 * @method static array getMunicipios(string $siglaEstado)
 */
class Locations extends Facade {

    protected static function getFacadeAccessor() {
        return 'Locations';
    }
}

