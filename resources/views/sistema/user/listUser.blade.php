@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administracion de Usuarios</h1>
@stop

@section('content')
    <p>Lista de todos los clientes</p>
    <div class="card">
        <div class="card-header">
            <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-key" class="float-right" data-toggle="modal"
                data-target="#modalPurple" />

        </div>
        <div class="card-body">
            @php
                $heads = ['ID', 'Nombres', ['label' => 'Actions', 'no-export' => true, 'width' => 15]];

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
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->user_id}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ route('asignar.edit', $user) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                                </button>
                                <form style="display: inline" action="{{ route('asignar.destroy', $user) }}" method="POST"
                                    class="formEliminar">
                                    @csrf
                                    @method('delete')
                                    {!! $btnDelete !!}
                                </form>
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
