<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use App\Models\Resultado;
use Carbon\Carbon;


class HistoricoController extends Controller
{
   
    

    
    public function __construct()
    {
       
           
       
    }
    public function index(){
        $lista = array();
       
        return view('webscrap',['dados'=> $lista]);
    }

    public function search()
    {
        
        $lista = Resultado::webscsrap();
        $cont =0;
        $dataatual = Carbon::now();
         $dados = array();
        foreach($lista as $item){
            $dados[$cont] = Historico::create([
                'texto' => $item[0],
                'autor' =>$item[1],
                'tag' => $item[2],
                'dataCadastro' => $dataatual,
                'user_id' => auth()->user()->id,
            ]);
            $cont++;
        }
   
        
          return view('webscrap',['dados'=> $dados]);
    }

    public function store($id){  
         
        $dado = Historico::where('id',$id)->first();
        //dd($dado->tag);
      
            Resultado::create([
                'texto' => $dado->texto,
                'autor' =>$dado->autor,
                'tag' => $dado->tag,
                'user_id' => auth()->user()->id,
            ]);
                    
            return redirect()->route('indexresultado');
     
    }

   

    public function show(){
        
        
        $historicos = Historico::where('user_id',auth()->user()->id)->with('usuario')->get();
        return view('historico',['historico'=>$historicos]);

   }

   public function delete($id){
           
            if($id){
             Historico::where('id',$id)->delete();
            }
           
         
            return redirect()->route('showhistorico');
         
   }


public function deleteall(){
    Historico::query()->delete();
    return redirect()->route('showhistorico');
}

   
}
