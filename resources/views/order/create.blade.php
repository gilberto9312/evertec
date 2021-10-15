@section("titulo", "Registrar")

@extends('layouts.app')

@section('content')

        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">{{ __('Registro') }}</div>
                        
                        <div class="card-body">
                            <label class="label">Total $25.000</label>
                            <form method="POST" action="{{route("createOrderStore")}}">
                                @csrf
                                <input type="hidden" value="{{$order->id}}" name="id">
                                <div class="form-group">
                                    <label class="label">Nombre</label>
                                    <input required autocomplete="off" name="name" class="form-control"
                                           type="text" placeholder="Nombre" value="{{$order->customer_name}}">
                                </div>
                                <div class="form-group">
                                    <label class="label">Email</label>
                                    <input required autocomplete="off" name="email" class="form-control"
                                           type="text" placeholder="email@example.com" value="{{$order->customer_email}}">
                                </div>
                                <div class="form-group">
                                    <label class="label">Telefono</label>
                                    <input required autocomplete="off" name="phone" class="form-control"
                                           type="text" placeholder="3103121232" value="{{$order->customer_mobile}}">
                                </div>

                                
                                <button class="btn btn-success">Guardar</button>
                                <a class="btn btn-primary" href="{{route("home")}}">Volver al listado</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
@endsection