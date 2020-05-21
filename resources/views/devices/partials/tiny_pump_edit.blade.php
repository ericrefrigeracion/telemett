<div class="col-md-6 mb-2">
    <h3>Valores de Nivel</h3><br>
    {!! Form::model($device->tiny_pump_device, ['route' => ['devices.update_tiny_pump', $device->id], 'method' => 'PUT']) !!}
    <div class="form-group">
        {{ Form::label('l_cal', 'Calibracion de la Medicion (cms)') }}
        {{ Form::number('l_cal', null, ['class' => 'form-control', 'default' => 0, 'min' => -100, 'max' => 100, 'step' => 1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('l_offset', 'Offset (cms)') }}
        {{ Form::number('l_offset', null, ['class' => 'form-control', 'default' => 0, 'min' => 0, 'max' => 480, 'step' => 1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('l_min', 'Minimo Nivel Permitido (cms)') }}
        {{ Form::number('l_min', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 480, 'step' => 1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('l_max', 'Maximo Nivel Permitido (cms)') }}
        {{ Form::number('l_max', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 480, 'step' => 1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('l_dly', 'Retardo al Aviso (minutos)') }}
        {{ Form::number('l_dly', null, ['class' => 'form-control', 'required', 'default' => 60, 'min' => 0, 'max' => 360, 'step' => 1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('signal_mode', 'Tipo de Señal de Control') }} <br>
        {{ Form::radio('signal_mode', 'local') }} Señal local <br>
        {{ Form::radio('signal_mode', 'remote') }} Señal remota <br>
    </div>
    <div class="form-group">
        {{ Form::label('control_mode', 'Tipo de Funcionamiento del Sistema') }} <br>
        {{ Form::radio('control_mode', 'emptied') }} Para vaciado <br>
        {{ Form::radio('control_mode', 'filled') }} Para llenado <br>
    </div>
    <div class="form-group">
        {{ Form::label('channel1_config', 'Tipo de funcionamiento del Canal 1') }}
        {{ Form::select('channel1_config', [
                                        'enabled' => 'Funcionamiento Permanente',
                                        'auto' => 'Funcionamiento Automatico',
                                        'disabled' => 'Canal Deshabilitado',
                                    ], null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('channel1_min', 'Minimo nivel para el Canal 1 (cms)') }}
        {{ Form::number('channel1_min', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 480, 'step' => 1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('channel1_max', 'Maximo nivel para el Canal 1 (cms)') }}
        {{ Form::number('channel1_max', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 480, 'step' => 1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('channel2_config', 'Tipo de funcionamiento del Canal 2') }}
        {{ Form::select('channel2_config', [
                                        'enabled' => 'Funcionamiento Permanente',
                                        'auto' => 'Funcionamiento Automatico',
                                        'disabled' => 'Canal Deshabilitado',
                                    ], null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('channel2_min', 'Minimo nivel para el Canal 2 (cms)') }}
        {{ Form::number('channel2_min', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 480, 'step' => 1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('channel2_max', 'Maximo nivel para el Canal 2 (cms)') }}
        {{ Form::number('channel2_max', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 480, 'step' => 1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('channel3_config', 'Tipo de funcionamiento del Canal 3') }}
        {{ Form::select('channel3_config', [
                                        'enabled' => 'Funcionamiento Permanente',
                                        'auto' => 'Funcionamiento Automatico',
                                        'disabled' => 'Canal Deshabilitado',
                                    ], null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('channel3_min', 'Minimo nivel para el Canal 3 (cms)') }}
        {{ Form::number('channel3_min', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 480, 'step' => 1]) }}
    </div>
    <div class="form-group">
        {{ Form::label('channel3_max', 'Maximo nivel para el Canal 3 (cms)') }}
        {{ Form::number('channel3_max', null, ['class' => 'form-control', 'required', 'min' => 0, 'max' => 480, 'step' => 1]) }}
    </div>

    <div>
        {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-sm btn-primary']) }}
    </div>
    {!! Form::close() !!}
</div>