@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administracion de roles</h1>
@stop

@section('content')
    <p>Lista de todos los roles</p>
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
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td><a href="{{ route('roles.edit', $role) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            <form style="display: inline" action="{{ route('roles.destroy', $role) }}" method="POST"
                                class="formEliminar">
                                @csrf
                                @method('delete')
                                {!! $btnDelete !!}
                            </form>
                            <form style="display: inline" action="{{ route('roles.switchGuard', $role) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-xs btn-default text-warning mx-1 shadow" title="Cambiar Guard">
                                    <i class="fa fa-lg fa-fw fa-exchange-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>

        </div>
    </div>

    {{-- Themed --}}
    <x-adminlte-modal id="modalPurple" title="Nuevo Rol" theme="primary" icon="fas fa-bolt" size='lg'
        disable-animations>
        <form action="{{ route('roles.store') }}" method="post">
            @csrf
            <div class="row">
                <x-adminlte-input name="nombre" label="Nombre" placeholder="Aqui su rol" fgroup-class="col-md-6"
                    disable-feedback />
            </div>
            <!-- Botón Aceptar -->
            <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save" />

        </form>

    </x-adminlte-modal>


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

    @if (session('message'))
        <script>
            $(document).ready(function() {
                let mensaje = "{{ session('message') }}"; // Acceder correctamente a la sesión
                Swal.fire({
                    title: 'Resultado',
                    text: mensaje, // Usar el valor de la sesión
                    icon: 'success' // Ícono de éxito
                });
            });
        </script>
    @endif
    @if (session('warning'))
    <script>
        $(document).ready(function() {
            let mensajeAdvertencia = "{{ session('warning') }}"; // Acceder correctamente a la sesión
            Swal.fire({
                title: 'Advertencia',
                text: mensajeAdvertencia, // Usar el valor de la sesión
                icon: 'warning' // Ícono de advertencia
            });
        });
    </script>
@endif
@stop
