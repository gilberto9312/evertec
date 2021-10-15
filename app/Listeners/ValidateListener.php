<?php

namespace App\Listeners;

use App\Events\ValidateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Helpers\ValidationGlobal;
use App\Exceptions\CustomException;

class ValidateListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ValidateEvent  $event
     * @return void
     */
    public function handle(ValidateEvent $event)
    {
        try{
            $params = $event->arr_parametros;

            ValidationGlobal::validateRequiredParameters($params, ['name','email','phone']);

            $phone = intval($params['phone']);        

            ValidationGlobal::validateEmail($params['email']);
            ValidationGlobal::validateString($params['name']);

            $params['phone'] = $phone;
            
            return array('status' => true, 'params' => $params);
        }catch (CustomException $e){
            return array('status' => false,'error'=>$e->getMessage(),'params' => $params);
        }
        
    }
}
