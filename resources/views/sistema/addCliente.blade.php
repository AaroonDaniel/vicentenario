@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ADMINISTRACIÓN DE EXPOSITORES </h1>
@stop

@section('content')
    <p>Ingresa la información del cliente</p>

    <div class="card ">
        @php
            // Verificar si existe la variable de sesión 'message'
            if (session()->has('message')) {
                if (session('message') == 'ok') {
                    echo '<x-adminlte-alert class="bg-teal text-uppercase" icon="fa fa-lg fa-thumbs-up" title="Done" dismissable>
                    Registro completado!
                  </x-adminlte-alert>';
                }
            }
        @endphp
        <div class="card-body">
            <form action="{{ route('cliente.store') }}" method="post">
                @csrf
                <!-- DNI -->
                <x-adminlte-input type="text" name="dni" label="DNI" placeholder="Aqui su numero de cedula"
                    value="{{ old('apellido') }}" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <!-- Nombre -->
                <x-adminlte-input type="text" name="nombre" label="NOMBRES" placeholder="Aquí sus nombres"
                    value="{{ old('apellido') }}" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <!-- Apellido -->
                <x-adminlte-input type="text" name="apellido" label="APELLIDO" placeholder="Aquí sus apellidos"
                    value="{{ old('nombre') }}" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <!-- Email -->
                <x-adminlte-input type="text" name="email" label="EMAIL" placeholder="test@test.com"
                    value="{{ old('email') }}" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-envelope text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <!--Telefono-->
                <x-adminlte-input type="text" name="telefono" label="TELEFONO" placeholder="+54894561321321"
                    value="{{ old('telefono') }}" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fa fa-phone text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <!--Descriocion-->
                <x-adminlte-textarea type="text" name="direccion" label="DIRECCION" rows=5
                    placeholder="Inserte descripcion" value="{{ old('direccion') }}" label-class="text-lightblue"
                    igroup-size="sm">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-dark">
                            <i class="fas fa-lg fa-file-alt text-warning"></i>
                        </div>
                    </x-slot>
                </x-adminlte-textarea>

                <!--Telefono-->
                <x-adminlte-select type="text" name="estado" label="ESTADO CIVIL" label-class="text-lightblue"
                    igroup-size="lg">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-dark">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>
                    <option value="">Seleccione el estado civil</option>
                    <option value="Casado">Casado</option>
                    <option value="Soltero">Soltero</option>
                    <option value="Union libre">Union libre</option>
                </x-adminlte-select>

                <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save" />

            </form>
        </div>
    </div>
    " @stop @section('css') {{-- Agrega aquí estilos adicionales --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log("Hola, estoy usando el paquete Laravel-AdminLTE!");
    </script>
@stop
