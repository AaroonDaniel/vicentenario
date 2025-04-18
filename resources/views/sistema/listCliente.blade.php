@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administracion de clientes</h1>
@stop

@section('content')
    <p>Lista de todos los clientes</p>
    <div class="card">
        @can('Crear cliente')
            <div class="card-head">
                <a href="{{ route('cliente.create') }}" class="btn btn-primary float-right mt-2 mr-2">Nuevo</a>
            </div>
        @endcan
            <div class="card-body">
                @php
                    $heads = [
                        'ID',
                        'Apelldo',
                        'Nombres',
                        ['label' => 'Telefono ', 'width' => 40],
                        ['label' => 'Actions', 'no-export' => true, 'width' => 15],
                    ];

                    $btnEdit = '';
                    $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
                    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

                    $config = [
                        'language' => [
                            'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json', // Corregido "plgu-ins" por "plug-ins"
                        ],
                    ];
                @endphp

                {{-- Minimal example / fill data using the component slot --}}
                <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td><a href="{{ route('cliente.edit', $cliente) }}"
                                    class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                </a>
                                @can('Eliminar cliente')
                                <form style="display: inline" action="{{ route('cliente.destroy', $cliente) }}" method="POST"
                                    class="formEliminar">
                                    @csrf
                                    @method('delete')
                                    {!! $btnDelete !!}
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>

            </div>
        </div>

    @stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Estas seguro?",
                    text: "Se va a eliminar un registro!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, quiero borrarlo"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            })
        })
    </script>
@stop
