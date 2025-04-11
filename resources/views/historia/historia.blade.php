@extends('layouts.principal')

@section('title', 'Historia - Vicentenario Bolivia')

@section('content')
    <h1 class="text-center mb-4">Historia de Bolivia</h1>
    <p class="text-center mb-5">A continuación, se muestra una lista de las historias registradas.</p>

    <!-- Tabla de Historias -->
    <div class="table-responsive">
        <div class="container-fluid">
            <div class="row">
                <!-- Columna izquierda: Tabla de usuarios -->
                <div class="col-md-8">
                    
                    <table id="example" class="display nowrap table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Descripcion</th>
                                <th>Fuentes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historias as $historia)
                                <tr>
                                    <td>{{ $historia->titulo }}</td>
                                    <td>{{ Str::limit($historia->descripcion, 100) }}</td>
                                    <td>{{ $historia->fuentes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
            </div>
            
    </div>


@endsection
