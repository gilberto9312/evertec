<?php

namespace App\Listeners;

use App\Events\ProccessListOrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;


class ProccessListOrderListener
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
     * @param  ProccessListOrderEvent  $event
     * @return void
     */
    public function handle(ProccessListOrderEvent $event)
    {

        $offset = isset($event->arr_parametros['pagination']['offset']) ? $event->arr_parametros['pagination']['offset'] : 0;
        $limit = isset($event->arr_parametros['pagination']['limit']) ? $event->arr_parametros['pagination']['limit'] : 5;
        $id = isset($event->arr_parametros['id']) ? $event->arr_parametros['id'] : null;

        $query = DB::table('orders')
                        ->where('user_id',auth()->id())
                        ->offset($offset)
                        ->limit($limit)
                        ->orderByDesc('id');

        if($id){
            $query->where('id',$id);
        }

        $orders = $query->get();

        return ['status'=>true,'data'=>$orders];
    }
}
