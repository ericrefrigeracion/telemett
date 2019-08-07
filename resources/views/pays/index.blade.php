@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Pagos realizados
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Dispositivo</th>
                                <th>Creado Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($pays as $pay)
                                    <tr>
                                        <td>
                                            <a href="{{ route('devices.show', $pay->device_id) }}" class="btn btn-sm btn-default">{{ $pay->device_id }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('pays.show', $pay->id) }}" class="btn btn-sm btn-default">{{ $pay->created_at }}</a>
                                        </td>
                                        <td>
                                            {{ $pay->collection_status }}
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    {{ $pays->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection