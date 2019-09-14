@extends('base')

@section('central')
<table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">Serial</th>
            <th scope="col">Galpão</th>
            <th scope="col">Coluna</th>
            <th scope="col">Modelo</th>
            <th scope="col">IP</th>
            <th scope="col">Contador</th>
          </tr>
        </thead>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <tbody>
        @foreach ($printers as $printer)
          <tr>
            <th scope="row"><a href="/editar_printer/{{ $printer->id }}">{{ $printer->serial }}</a></th>
            <th scope="row">{{ $printer->galpao }}</th>
            <th scope="row">{{ $printer->coluna }}</th>
            <th scope="row">{{ $printer->modelo }}</th>
            <th scope="row">{{ $printer->ip }}</th>
            <th scope="row">{{ $printer->contador }}</th>
          </tr>            
        @endforeach

        </tbody>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
      </table>
      <div class="loading">
          <img src="/img/loading.gif" alt="Loading">
      </div> 
@endsection

@section('adminlte_js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('/js/lista.js') }}"></script>
@endsection