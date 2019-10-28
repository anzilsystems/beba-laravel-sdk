<?php

namespace AnzilSystems\Beba;

use Illuminate\Support\Facades\Facade;

class BebaFacade extends Facade{

    protected static function getFacadeAccessor() {
        return 'beba';   
    }

}