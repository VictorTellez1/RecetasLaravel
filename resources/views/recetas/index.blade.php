@extends('layouts.app')
@section('botones')
    @include('ui.navegacion')
@endsection
@section('content')
    <h2 class="text-center mb-5">Administra tus recetas</h2>
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>   
                    <th scole="col">Titulo</th>
                    <th scole="col">Categoria</th>
                    <th scole="col">Acciones</th>
                </tr>
                <tbody>
                    @foreach ($recetas as $receta)
                    <tr>
                        <td>{{$receta->titulo}}</td>
                        <td>{{$receta->categoria->nombre}}</td> <!--Te esta pasando toda la informacion de categoria, ahora solo necesitas acceder al nombre-->
                        <td>
                           {{-- <form action="{{route('recetas.destroy',['receta'=>$receta->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                                <input type="submit" class="btn btn-danger mr1 d-block w-100" value="Eliminar &times;"/>
                           </form> --}}
                           <eliminar-receta
                                receta-id={{$receta->id}}
                           ></eliminar-receta>
                            <a href="{{route('recetas.edit',['receta'=>$receta->id])}}" class="btn btn-dark mr-1 d-block">Editar</a>
                            <a href="/recetas/{{$receta->id}}" class="btn btn-success mr-1 d-block">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
        <div class="col-12 mt-4 justify-content-center d-flex">
            {{$recetas->links()}}
        </div>
        <h2 class="text-center my-5">Recetas que te gusta</h2>
        <div class="col-md-10 mx-auto bg-white p-3">
            @if(count($usuario->meGusta)>0)
            <ul class="list-group">
                @foreach($usuario->meGusta as $receta)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                       <p> {{$receta->titulo}} </p>
                       <a class="btn btn-outline-success" href="{{route('recetas.show',['receta'=>$receta->id])}}">Ver</a>
                    </li>

                @endforeach
            </ul>
            @else
                <p class="text-center">Aun no tienes recetas guardadas</p>
            @endif
        </div>
    </div>

@endsection