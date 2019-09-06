@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card-columns">

                @foreach($devices as $device)
                    <div class="card text-center{{ $device->on_line ? '':' border-danger'}}">
                        <div class="card-header{{ $device->on_line ? '':' bg-danger text-white'}}">
                            {{ $device->name }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h6 class="card-subtitle text-muted">{{ $device->description }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col text-center m-2">
                                            @if($device->admin_mon && $device->tmon)
                                                @if($device->on_temp  && $device->on_t_set_point)
                                                    Funcionamiento Normal<i class="far fa-check-circle text-success m-2"></i>
                                                @endif
                                                @if(!$device->on_temp && $device->on_t_set_point)
                                                    Fuera de Rango<i class="fas fa-exclamation text-warning m-2"></i>
                                                @endif
                                                @if(!$device->on_temp && !$device->on_t_set_point)
                                                    Alerta de Funcionamiento<i class="fas fa-exclamation text-danger m-2"></i>
                                                @endif
                                                @if($device->protected)
                                                    <i class="far fa-eye text-success m-2" title="Protegido"></i></a>
                                                @else
                                                    <i class="far fa-eye-slash text-success m-2" title="Horario Permitido"></i>
                                                @endif
                                            @endif
                                        </div>
                                </div>
                            <div class="row">
                                @if($device->admin_mon)
                                    <div class="col-2">
                                        <i class="fas fa-user-shield text-success mt-3" title="Monitoreo Activo"></i>
                                        @if($device->tmon)
                                            <i class="fas fa-temperature-high text-success mt-3" title="Control de Temperatura Activo"></i>
                                        @else
                                            <i class="fas fa-temperature-high text-danger mt-3" title="Control de Temperatura Desactivado"></i>
                                        @endif
                                        @if($device->rule_type == 'Siempre Protegido')
                                            <i class="far fa-check-square text-success mt-3" title="Siempre Protegido"></i>
                                        @endif
                                        @if($device->rule_type == 'Protegido cuando cierro mi Comercio')
                                            <i class="fas fa-cash-register text-success mt-3" title="Protegido cuando cierro mi Comercio"></i>
                                        @endif
                                        @if($device->rule_type == 'Con horarios Permitidos (Perzonalizado)')
                                            <a href="{{ route('rules.index') }}"><i class="far fa-clock text-success mt-3" title="Con horarios Permitidos (Perzonalizado)"></i></a>
                                        @endif
                                    </div>
                                @endif
                                <div class="col-10">
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <h4 class="card-title display-4 m-2">{{ $device->last_data01 }}°C</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col h4 text-center m-2">
                                    @can('receptions.show-hour')
                                        <a href="{{ route('receptions.show-hour', $device->id) }}" class="text-primary m-2" title="Graficos De Temperatura"><i class="fas fa-chart-line"></i></a>
                                    @endcan
                                    @can('devices.show')
                                        <a href="{{ route('devices.show', $device->id) }}" class="text-primary m-2" title="Configuracion Del Dispositivo"><i class="fas fa-cogs"></i></a>
                                    @endcan
                                    @can('devices.show')
                                        <a href="{{ route('alerts.show', $device->id) }}" class="text-primary m-2" title="Nuevas Alertas">{{ $device->alerts_count }} <i class="fas fa-bell"></i></a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="card-footer{{ $device->on_line ? '':' bg-danger'}}">
                            <small class="{{ $device->on_line ? '':' text-white'}}">
                                @if($device->admin_mon)
                                    {{ $device->on_line ? 'En Linea':'Sin Conexion'}} - {{ $device->last_created_at }}
                                @else
                                    Monitoreo vencido - <a href="{{ route('pays.create', $device->id) }}">Pagar por el monitoreo</a>
                                @endif
                            </small>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection