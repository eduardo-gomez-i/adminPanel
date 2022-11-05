@extends('layouts.main', ['activePage' => 'almacen', 'titlePage' => 'almacen'])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-m2-12">
                        <a class="btn btn-info" href="{{ route('registroAlmacen') }}">Registrar Documento</a>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">Almacen</h4>
                                <p class="card-category">Resultado Encontrado</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="text-center thead-dark">
                                            <th>Folio</th>
                                            <th>Emisor</th>
                                            <th>Estado</th>
                                            <th>Partidas</th>
                                            <th>Cliente</th>
                                            <th>Fecha</th>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td>{{$documento->FOLDIARIO ?? ''}}</td>
                                                <td>{{$documento->emisor ?? ''}}</td>
                                                <td>{{$documento->estado ?? ''}}</td>
                                                <td>{{$documento->partidas ?? ''}}</td>
                                                <td>{{ $documento->CLIENTE ?? ''}}</td>
                                                <td>{{ date_format($documento->created_at, "Y-m-d") ?? ''}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection