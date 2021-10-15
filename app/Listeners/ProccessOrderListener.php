<?php

namespace App\Listeners;

use App\Events\ProccessOrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Order;
use App\Exceptions\CustomException;

class ProccessOrderListener
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
     * @param  ProccessOrderEvent  $event
     * @return void
     */
    public function handle(ProccessOrderEvent $event)
    {
        try{

            list($id,$name,$email,$phone)= $this->getParameter($event->arr_parametros['params']);
    
            if($id==null){
                $order = new Order();
                
            }else{
                $order = Order::find($id);
            }

            $token = $this->generateInvoice();

            $order->customer_name=$name;
            $order->customer_email=$email;
            $order->customer_mobile=$phone;
            $order->status='CREATED';
            $order->user_id=auth()->id();
            $order->invoice=$token;
            $order->total=25000;
            $order->saveOrFail();    
            
            return [
                'status'=>true,
                'data'=>$order
            ];    
        }catch(CustomException $e){
            return [
                'status'=>false,
                'error'=>$e->getMessage()
            ];    
        }
    
        
        
    }

    private function generateInvoice(){

        $token = uniqid('',true);
        $id = explode('.',$token);
        return $id[1];
    }
    private function getParameter($params): array 
    {
        $id = $params['id'];
        $name = $params['name'];
        $email = $params['email'];
        $phone = $params['phone'];

        return [$id,$name,$email,$phone];
    }
}
