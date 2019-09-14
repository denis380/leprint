@extends('base')

@section('central')

<button id="btnPrintersOn" name="btnPrintersOn" type="button" class="btn btn-success" style="margin-right: 5%">Impressoras ONLINE</button>
<button id="btnPrintersOff" name="btnPrintersOff" type="button" class="btn btn-secondary">Impressoras OFFLINE</button>



<div class="printers-on">
    <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">Serial</th>
                <th scope="col">Galpão</th>
                <th scope="col">Coluna</th>
                <th scope="col">Modelo</th>
                <th scope="col">IP</th>
                <th scope="col">Contador</th>
                <th scope="col">Etiqueta</th>
            </tr>
            </thead>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <tbody>
            @foreach ($result['online'] as $printer)
            <tr>
                <th scope="row">{{ $printer['serial'] }}</th>
                <th scope="row">{{ $printer['galpao'] }}</th>
                <th scope="row">{{ $printer['coluna'] }}</th>
                <th scope="row">{{ $printer['modelo'] }}</th>
                <th scope="row">{{ $printer['ip'] }}</th>
                <th scope="row">{{ $printer['contador'] }}</th>
                <th scope="row">{{ $printer['etiqueta'] }}</th>
            </tr>            
            @endforeach

            </tbody>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </table>
</div>
{{-- -=-==--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- --}}
{{-- -=-==--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=- --}}
<div class="printers-off">
    <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th scope="col">IP</th>
                <th scope="col">Situação</th>
            </tr>
            </thead>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <tbody>
            @foreach ($result['offline'] as $printer)
            <tr>
                <th scope="row">{{ $printer['ip'] }}</th>
                <th scope="row">{{ $printer['situacao'] }}</th>
            </tr>            
            @endforeach
            </tbody>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </table>
</div>

@endsection

@section('adminlte_js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('/js/lista.js') }}"></script>
@endsection