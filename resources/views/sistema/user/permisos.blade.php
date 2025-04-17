@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Administracion de permisos</h1>
@stop

@section('content')
    <p>Lista de todos los usuarios</p>
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
                @foreach ($permisos as $permiso)
                    <tr>
                        <td>{{ $permiso->id }}</td>
                        <td>{{ $permiso->name }}</td>
                        <td>
                            <!-- Botón Editar -->
                            <button class="btn btn-xs btn-primary mx-1 shadow edit-permission-btn" title="Editar"
                                data-id="{{ $permiso->id }}" data-name="{{ $permiso->name }}">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </button>

                            <!-- Botón Eliminar -->
                            <form style="display: inline" action="{{ route('permisos.destroy', $permiso) }}" method="POST"
                                class="formEliminar">
                                @csrf
                                @method('DELETE')
                                {!! $btnDelete !!}
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>

        </div>
    </div>

    {{-- Themed --}}
    <x-adminlte-modal id="modalPurple" title="Nuevo Permiso" theme="primary" icon="fas fa-bolt" size='lg'
        disable-animations>
        <form action="{{ route('permisos.store') }}" method="post">
            @csrf
            <div class="row">
                <x-adminlte-input name="nombre" label="Nombre" placeholder="Aqui su permiso" fgroup-class="col-md-6"
                    disable-feedback />
            </div>
            <!-- Botón Aceptar -->
            <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save" />

        </form>

    </x-adminlte-modal>

    <!-- ACA VENDRA LO DE EDITAR -->
    <!-- Modal para Editar Permiso -->
    <x-adminlte-modal id="modalEditPermission" title="Editar Permiso" theme="primary" icon="fas fa-edit" size='lg'
        disable-animations>
        <form id="editPermissionForm" action="" method="post">
            @csrf
            @method('PUT') <!-- Método HTTP para actualizar -->

            <!-- Campo Oculto para el ID del Permiso -->
            <input type="hidden" name="id" id="editPermissionId">

            <!-- Campo para el Nombre del Permiso -->
            <div class="row">
                <x-adminlte-input name="nombre" label="Nombre" placeholder="Aquí su permiso" fgroup-class="col-md-6"
                    disable-feedback />
            </div>

            <!-- Botón Guardar -->
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

    <script>
        $(document).ready(function() {
            // Abrir el modal al hacer clic en el botón "Editar"
            $('.edit-permission-btn').on('click', function() {
                const permissionId = $(this).data('id');
                const permissionName = $(this).data('name');

                // Completar el campo de nombre del permiso
                $('#editPermissionForm input[name="nombre"]').val(permissionName);

                // Completar el campo oculto con el ID del permiso
                $('#editPermissionId').val(permissionId);

                // Actualizar la acción del formulario con el ID del permiso
                const updateUrl = "{{ url('permisos') }}/" + permissionId;
                $('#editPermissionForm').attr('action', updateUrl);

                // Mostrar el modal
                $('#modalEditPermission').modal('show');
            });
        });
    </script>
@stop
