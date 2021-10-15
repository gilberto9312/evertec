@section("titulo", "Registrar")

@extends('layouts.app')

@section('content')

        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">{{ __('Orden') }}</div>

                        <div class="card-body">
                                <input type="hidden" value="{{$order->id}}" name="id">
                                <div class="form-group">
                                    <label class="label">Nombre</label>
                                    <label class="label"> {{$order->customer_name}}" </label>
                                </div>
                                <div class="form-group">
                                    <label class="label">Email</label>
                                    <label class="label"> {{$order->customer_email}}" </label>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="label">Telefono</label>
                                    <label class="label"> {{$order->customer_mobile}}" </label>
                                    
                                </div>

                                <div class="form-group row" >
                                    <a class="btn btn-success" href="{{route("editOrder",[$order->id])}}">
                                            Editar
                                        </a>
                                    <form action="{{route("deleteOrder",[$order->id])}}" method="post">
                                        @method("delete")
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            Eliminar
                                        </button>
                                    </form>
                                    <a class="btn btn-primary" href="{{route("home")}}">Volver al listado</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
@endsection