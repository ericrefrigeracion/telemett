@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Crear Tipo de Visualizacion
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['displays.store']]) !!}
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre del tipo de Visualizacion') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => '20']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Descripcion breve') }}
                            {{ Form::text('description', null, ['class' => 'form-control', 'required', 'maxlength' => '50']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('slug', 'Slug para el sistema') }}
                            {{ Form::text('slug', null, ['class' => 'form-control', 'required', 'maxlength' => '15']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('title', 'Titulo') }}
                            {{ Form::text('title', null, ['class' => 'form-control', 'required', 'maxlength' => '30']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('scripts', 'Scripts') }}
                            {{ Form::text('scripts', null, ['class' => 'form-control', 'maxlength' => '40']) }}
                        </div>
                        <div>
                            {{ Form::submit('Crear Item', ['class' => 'btn btn-sm btn-primary']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection