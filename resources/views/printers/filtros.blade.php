@extends('base')

@section('content')
    <div class="dataTables_wrapper form-inline dt-bootstrap">
        <table class="table table-bordered table-hover dataTable"role="grid">
        <thead>
            <tr role="row">
                <th>
                    <div class="box-footer">
                        <form method="POST" action="/redirecionamento">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input name="edtBuscaPorIp" id="edtBuscaPorIp" class="form-control" type="text" placeholder="EX: 172.20.150.11 ...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-flat" name="btnBuscaPorIp" id="btnBuscaPorIp">IP</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </th>
                <th>
                    <div class="box-footer">
                        <form method="POST" action="/redirecionamento">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input name="edtBuscaPorColuna" id="edtBuscaPorColuna" class="form-control" type="text" placeholder="Ex: 22BC ...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-flat" id="btnBuscaPorColuna">Coluna</button>
                                </span>
                            </div>
                        </form>
                    </div>                    
                </th>
                <th>
                    <div class="box-footer">
                        <form method="POST" action="/redirecionamento">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input name="edtBuscaPorSerial" id="edtBuscaPorSerial" class="form-control" type="text" placeholder="Ex: 40634C6600F82 ...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-flat" type="submit" id="btnBuscaPorSerial">Serial</button>
                                </span>
                            </div>
                        </form>
                    </div>                    
                </th>
            </tr>
        </thead>
        </table>
    </div>
@endsection

@section('adminlte_js')
    <script src="{{ asset('/js/filtros.js') }}"></script>
@endsection