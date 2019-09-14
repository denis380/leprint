@php
    use App\Models\Printer;
    $printers = Printer::all();
@endphp
<div class="inner">
        <h3>[{{ count($printers) }}] - Impressoras cadastradas</h3>
        <p>Outsourcing de Impressão</p>
      </div>
      <div class="icon">
        <i class="ion ion-printer"></i>
      </div>
      <a class="small-box-footer" href="/">Lista de impressoras <i class="fa fa-arrow-circle-right"></i></a>
    </div>
<div class="box-body">
        <div class="dataTables_wrapper form-inline dt-bootstrap" id="example2_wrapper"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered table-hover dataTable" id="example2" role="grid" aria-describedby="example2_info">
            <thead>
            <tr role="row">
                <th tabindex="0" class="sorting_asc" aria-controls="example2" aria-label="Rendering engine: activate to sort column descending" aria-sort="ascending" rowspan="1" colspan="1">
                Serial</th>
                <th tabindex="0" class="sorting" aria-controls="example2" aria-label="Browser: activate to sort column ascending" rowspan="1" colspan="1">
                Galpão</th>
                <th tabindex="0" class="sorting" aria-controls="example2" aria-label="Platform(s): activate to sort column ascending" rowspan="1" colspan="1">
                Coluna</th>
                <th tabindex="0" class="sorting" aria-controls="example2" aria-label="Engine version: activate to sort column ascending" rowspan="1" colspan="1">
                IP</th>
                <th tabindex="0" class="sorting" aria-controls="example2" aria-label="CSS grade: activate to sort column ascending" rowspan="1" colspan="1">
                Contador</th>
                <th tabindex="0" class="sorting" aria-controls="example2" aria-label="CSS grade: activate to sort column ascending" rowspan="1" colspan="1">
                Responsável</th>
                <th tabindex="0" class="sorting" aria-controls="example2" aria-label="CSS grade: activate to sort column ascending" rowspan="1" colspan="1">
                Etiqueta</th>
            </tr>
            </thead>
            <tbody>              
                @foreach ($printers as $printer)
                    <tr class="odd" role="row">
                        <th scope="row"><a href="/editar_printer/{{ $printer->id }}">{{ $printer->serial }}</a></th>
                        <th scope="row">{{ $printer->galpao }}</th>
                        <th scope="row">{{ $printer->coluna }}</th>
                        <th scope="row"><a href="http://{{ $printer->ip }}" target="_blank">{{ $printer->ip }}</a></th>
                        <th scope="row">{{ $printer->contador }}</th>
                        <th scope="row">{{ $printer->responsavel }}</th>
                        <th scope="row">{{ $printer->etiqueta }}</th>
                    </tr>            
                @endforeach               
            </tbody>
    </table>
</div>