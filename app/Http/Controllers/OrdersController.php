<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Events\ValidateEvent;
use App\Exceptions\CustomException;
use App\Events\ProccessOrderEvent;
use App\Events\ProccessListOrderEvent;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    private const LIMIT = 5;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->request->all();

        

        $next = isset($params['next']) ? $params['next'] : 1;
        
        
        
        $limit = self::LIMIT;
        $pag =ceil(DB::table('orders')->count() / $limit);
        $offset= $next > 1 && $next <= $pag ? $limit * ($next - 1) : 0;

        $pagination = [
            'next'=>$next,
            'offset'=>$offset,
            'pag'=>$pag,
            'limit'=>$limit
        ];

        $params['pagination'] = $pagination;

        

        $orders = event(new ProccessListOrderEvent($params));
        
        if($orders[0]['status']){
            return view('home',['orders'=>$orders[0]['data'],'pagination'=>$pagination]);    
        }
        return view('home',['orders'=>[],'pagination'=>$pagination]);
        
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $order = new Order();
        return view("order.create",['order'=>$order]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $params = $request->request->all();

            $validation = event(new ValidateEvent($params));
            
            if(!$validation[0]['status']){
                return redirect()->route("home")->with(["mensaje_error" => $validation[0]['error'],]);
            }
            $response = event(new ProccessOrderEvent($validation[0]));

            if($response[0]['status']){
                return redirect()->route("home")->with(["mensaje" => "Orden guardada",]);    
            }
            
        }catch (CustomException $e){
            return redirect()->route("home")->with(["mensaje" => $e->getMessage(),]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view("order.create",["order"=>$order]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route("home")->with(["mensaje" => "Orden eliminada"]);
    }
}
