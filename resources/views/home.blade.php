@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('mensaje'))
                <div class="alert alert-success">
                    {{ Session::get('mensaje') }}
                </div>
            @endif
            @if(Session::has('mensaje_error'))
                <div class="alert alert-danger">
                    {{ Session::get('mensaje_error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('List') }}</div>
                <a href="{{route("createOrder")}}" class="btn btn-success mb-2">Agregar Orden</a>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Ver</th>
                            <th>Editar</th>
                            <th>Eliminar</th></tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->customer_email}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route("showOrder",[$order->id])}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{route("editOrder",[$order->id])}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{route("deleteOrder",[$order->id])}}" method="post">
                                        @method("delete")
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if($pagination['next'] > 1)
                <a class="btn btn-primary" href="?next={{$pagination['next'] - 1}}"> "<<" </a>
                @endif
                @if($pagination['next'] < $pagination['pag'])
                    <a class="btn btn-primary" href="?next={{$pagination['next'] + 1}}"> ">>" </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
