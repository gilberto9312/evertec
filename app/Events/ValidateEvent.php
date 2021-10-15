<?php

namespace App\Events;


class ValidateEvent
{

    public $arr_parametros;
    
    public function __construct($arr_parametros)
    {
        
        $this->arr_parametros = $arr_parametros;
    }

}
