<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Printer;
use DB;

class PrintersController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function cadastrar()
    {
        return view('printers.cadastrar_printer');
    }


    public function store(Request $request){

        $validatedData = $request->validate([
            'edtSerial'         => 'required',
            'edtGalpao'         => 'required',
            'edtColuna'         => 'required',
            'edtIp'             => 'required',
            'edtArea'           => 'required',
            'edtContador'       => 'required',
            'edtResponsavel'    => 'required',
        ]);
        
        if($request->edtIdPrinter == ""){
            $aPrinter = new Printer;
            $aPrinter->serial = $request->edtSerial;
            $aPrinter->galpao = $request->edtGalpao;
            $aPrinter->coluna = $request->edtColuna;
            $aPrinter->area = $request->edtArea;
            $aPrinter->responsavel = $request->edtResponsavel;
            $aPrinter->ip = $request->edtIp;
            $aPrinter->situacao = $request->edtSituacao;
            $aPrinter->modelo = $request->edtModelo;
            $aPrinter->contador = $request->edtContador;
            $aPrinter->save();
        }
        return redirect('/consultar_printer');
    }


    public function consulta()
    {
        $printers = Printer::all();
        return view ('printers.tabela_printers', compact('printers'));
    }


    public function edit(Request $request, $idPrinter)
    {

        $aPrinter = Printer::findOrFail($idPrinter);

        $aPrinter->serial = $request->edtSerial;
        $aPrinter->galpao = $request->edtGalpao;
        $aPrinter->coluna = $request->edtColuna;
        $aPrinter->area = $request->edtArea;
        $aPrinter->responsavel = $request->edtResponsavel;
        $aPrinter->ip = $request->edtIp;
        $aPrinter->situacao = $request->edtSituacao;
        $aPrinter->modelo = $request->edtModelo;
        $aPrinter->contador = $request->edtContador;
        $aPrinter->save();
        
        return redirect('/consultar_printer');
    }

    public function load(Request $request, $idPrinter)
    {
        $aPrinter = Printer::findOrFail($idPrinter);
        return view('printers.editar_printer', compact('aPrinter'));
    }


    public function destroy($idPrinter)
    {
        $aPrinter = Printer::findOrFail($idPrinter);
        $aPrinter->delete();
        return redirect('/consultar_printer');
    }

    public function buscaRede()
    {
        set_time_limit(0);
        $prefix = "172.20.150.";
        $final = 10;
        $printers = array();
        $printersOff = array();
        $c = 0;
        $target = 199;
        while($final <= $target){
            $a = strval($final);
            $ip = $prefix . $a;
            if($dados = $this->buscaDados($ip)){
                $localidade = $this->buscaConfigs($ip);
                $printer = array(
                'ip' => $ip,
                'galpao'       => $localidade['galpao'],
                'coluna'       => $localidade['coluna'],
                'etiqueta'     => $localidade['etiqueta'], 
                'contador'     => $dados['contador'],
                'serial'       => $dados['serial'], 
                'area'         => "Não informado", 
                'responsavel'  => "Não informado", 
                'modelo'       => "Não informado", 
                'situacao'     => "Não informado",   
            );
            }else{
                $printer = array('ip' => $ip, 'situacao' => 'off');
            }
            if($printer['situacao'] !== 'off'){
                array_push($printers, $printer);
                Printer::firstOrNew($printer);
            }else{
                array_push($printersOff, $printer);
            }
            $final ++;
            $c ++;
        }
        $result = ['online' => $printers, 'offline' => $printersOff];
        return view('printers.printers_online', compact('result'));
    }

    ############# Recebe o ip e retorna um array com contador e serial da impressora ###################################
    public function buscaDados($ip){
        try{
        $ctx = stream_context_create(array( 
        'http' => array( 
        'timeout' => 1 
                ) 
            ) 
        ); 
        $url = 'http://'. $ip .'/cgi-bin/dynamic/printer/config/reports/deviceinfo.html';
        $result = file_get_contents($url, 0, $ctx);
        
        $caracteres = array("</p>", "<p>", "&nbsp", "</td>", "<td>", "margin-left:", "</TR>", "<TR>", ".", ";", " ");
        $espacos = array("", "", "", "", "","","","",""," ","");
        $foo = str_replace($caracteres, $espacos, $result);
        }catch (\Exception $e){
            $contador = null;
            return false;
        }
        
        //=-=-= Busca do contador =-=-=-=//
        $cont1 = strpos($foo, "Conta");
        $cont2 = substr($foo, $cont1+12);
        $cont3= explode("\n", $cont2);
        $contador = intval($cont3[0]);
        //=-=-=- Fim Busca do contador =-//

        //=-=-=-Busca do Serial =-=-=-=-//
        $seri1 = strpos($foo, "merode");
        $seri2 = substr($foo, $seri1+12);
        $seri3= explode("\n", $seri2);
        if(isset ($seri3[0])){
            $serial = $seri3[0];
        }else{
            $serial = 'indefinido';
        }
        //=-=-= Fim Busca do Serial =-=//

        return $dados = array('contador' => $contador, 'serial' => $serial);
    }
    #####################################################################################################################

    ############# Recebe o ip e retorna um array com contador e serial da impressora ###################################
    public function buscaConfigs($ip){
        try{
        $ctx = stream_context_create(array( 
            'http' => array( 
            'timeout' => 1 
                    ) 
                ) 
            );
        $url = 'http://'. $ip .'/cgi-bin/dynamic/printer/config/gen/general.html';
        $result = file_get_contents($url, 0, $ctx);
        
        $caracteres = array("</p>", "<p>", "&nbsp", "</td>", "<td>", "margin-left:", "</TR>", "<TR>", ".", ";", " ");
        $espacos = array("", "", "", "", "","","","",""," ","");
        $foo = str_replace($caracteres, $espacos, $result);
        }catch (\Exception $e){
            $contador = null;
            return false;
        }
        try{
            //=-=-= Busca do Local =-=-=-=//
            $loc1 = strpos($foo, "Local");
            $loc2 = substr($foo, $loc1);
            $loc3 = explode("\n", $loc2);

            if(isset($loc3[0])){
                $loc4 = $loc3[0];
            }else{
                $loc4 = 'indefinida';
            }
            $loc5 = strpos($loc4, "VALUE");                         ### Gambiarra da porra pra pegar a localidade ###
            $loc6 = substr($loc4, $loc5);                           
            $loc7 = explode('"', $loc6);
            if(isset($loc7[1])){
                $loc8 = $loc7[1];
            }else{
                $loc8 = 'indefinida';
            }
            $caracteres1 = array("&#032", "-");
            $espacos1 = array("", " ");
            $loc9 = str_replace($caracteres1, $espacos1, $loc8);
            $loc10 = explode(" ", $loc9);
            if(isset($loc10[0])){
                $loc11 = $loc10[0];
            }else{
                $loc11 = 'indefinida';
            }
            $caracteres2 = array("c", "C");
            $espacos2 = array(" c", " C");
            $loc12 = str_replace($caracteres2, $espacos2, $loc11);
            $loc13 = explode(" ", $loc12);
            $galpao = $loc13[0];
            if(isset($loc13[1])){
                $coluna = $loc13[1];
            }else{
                $coluna = "indefinida";
            }
            //=-=-=-=-=-=-=-/Busca Local-=-=-=-=-=-=-=-//

            //=-=-=-=-=-=-=Busca Etiqueta-=-=-=-=-=-=-//
            $etiq1 = strpos($foo, "Etiqueta");
            $etiq2 = substr($foo, $etiq1);
            $etiq3 = strpos($etiq2, "VALUE=");
            $etiq4 = substr($etiq2, $etiq3);
            $etiq5 = explode('"', $etiq4);
            if($etiq5[1] != ""){
                $etiqueta = $etiq5[1];
            }else{
                $etiqueta = 'Sem etiqueta cadastrada';
            }
            //=-=-=--=-=-=/Busca Etiqueta-=-=-=-=-=-=-//

        }catch(Exception $e){
            echo $e->getMessage();
        }  
        //=-=- Fim Busca do Local =-//
        return $localidade = array('galpao' => $galpao, 'coluna' => $coluna, 'etiqueta' => $etiqueta);
    }
    #####################################################################################################################

    public function salvaNoBanco($request){
        $aPrinter = new Printer;
        $aPrinter->serial = $request['serial'];
        $aPrinter->galpao = $request['galpao'];
        $aPrinter->coluna = $request['coluna'];
        $aPrinter->area = $request['area'];
        $aPrinter->responsavel = $request['responsavel'];
        $aPrinter->ip = $request['ip'];
        $aPrinter->situacao = $request['situacao'];
        $aPrinter->modelo = $request['modelo'];
        $aPrinter->contador = $request['contador'];
        $aPrinter->save();
    }

    public function filtros(){
        return view('printers.filtros');
    }
    
    public function redirecionamento(Request $request){

        if($request['edtBuscaPorIp']){
            $ip = 'http://' . $request['edtBuscaPorIp'];
            echo '<script>window.open("' . $ip . '");</script>';
            echo '<script>history.back();</script>';
            
        }
        if($request['edtBuscaPorSerial']){
            $serial = "%" . $request['edtBuscaPorSerial'] . "%";
            $result = DB::select("SELECT * FROM printers WHERE serial LIKE '$serial'");
            dd($result);
            echo 'serial';
        }
        if($request['edtBuscaPorColuna']){
            echo 'coluna';
        }
        
    }
    

}
