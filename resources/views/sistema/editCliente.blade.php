@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ADMINISTRACIÓN DE EXPOSITORES </h1>
@stop

@section('content')
    <p>Ingresa la información del cliente</p>

    <div class="card ">

        <div class="card-body">
            <form action="{{ route('cliente.update', $cliente) }}" method="post">
                @csrf
                @method('PUT')
                <!-- DNI -->
                <x-adminlte-input type="text" name="dni" label="DNI" placeholder="Aqui su numero de cedula"
                    value="{{ $cliente->dni }}" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <!-- Nombre -->
                <x-adminlte-input type="text" name="nombre" label="NOMBRES" placeholder="Aquí sus nombres"
                    value="{{ $cliente->nombre }}" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <!-- Apellido -->
                <x-adminlte-input type="text" name="apellido" label="APELLIDO" placeholder="Aquí sus apellidos"
                    value="{{ $cliente->apellido }}" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <!-- Email -->
                <x-adminlte-input type="text" name="email" label="EMAIL" placeholder="test@test.com"
                    value="{{ $cliente->email }}" label-class="text-lightblue">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-envelope text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <!--Telefono-->
                <x-adminlte-input type="text" name="telefono" label="TELEFONO" placeholder="+54894561321321"
                    value="{{ $cliente->telefono }}" label-class="text-lightblue">
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

                <!--Estado civil-->
                <x-adminlte-select type="text" name="estado" label="ESTADO CIVIL" label-class="text-lightblue"
                    igroup-size="lg">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-dark">
                            <i class="fas fa-car-side"></i>
                        </div>
                    </x-slot>

                    <option value="{{ $cliente->estado }}">{{ $cliente->estado }}</option>
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
@stop