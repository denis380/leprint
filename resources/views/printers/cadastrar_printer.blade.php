@extends('base')

@section('cabecalho')
    <h1>Novo Equipamento</h1>
@endsection

@section('central')
    <form role="form" action="\store_printer" method="POST" id="formPrinter" name="formPrinter">
        {{ csrf_field() }}
        <input type="hidden" id="edtIdPrinter" name="edtIdPrinter" value="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="edtSerial">Serial</label>
                <input class="form-control" id="edtSerial" name="edtSerial" type="text" placeholder="Ex: S40637C66008TT ">
            </div>
            <div class="form-group col-md-6">
                <label for="edtIp">IP</label>
                <input type="text" class="form-control" id="edtIp" name="edtIp" placeholder="Ex: 172.20.150.123">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="edtGalpao">Galpão</label>
                <input class="form-control" id="edtGalpao" name="edtGalpao" type="number" placeholder="Somente o número do galpão">
            </div>
            <div class="form-group col-md-6">
                <label for="edtColuna">Coluna</label>
                <input type="text" class="form-control" id="edtColuna" name="edtColuna" placeholder="Ex: 26P">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="edtArea">Área</label>
                <input class="form-control" id="edtArea" name="edtArea" type="text" placeholder="Ex: Logistica... Suspensão... CDC...">
            </div>
            <div class="form-group col-md-6">
                <label for="edtResponsavel">Responsável</label>
                <input type="text" class="form-control" id="edtResponsavel" name="edtResponsavel" placeholder="Se possível cadastrar com contato do responsável!">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="edtContador">Contador</label>
                <input class="form-control" id="edtContador" name="edtContador" type="number" placeholder="00000000000">
            </div>
            <div class="form-group col-md-6">
                <label for="edtModelo">Modelo</label>
                <input type="text" class="form-control" id="edtModelo" name="edtModelo" placeholder="Ex: T654, MS811, C950 ...">
            </div>
        </div>
        <div class="box-body">
        
        

        <div class="box-footer">
        <button class="btn btn-primary" type="submit" id="btnSalvar" name="btnSalvar">Salvar</button>
        </div>
        </div>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection

@section('adminlte_js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('/js/printer.js') }}"></script>

@endsection