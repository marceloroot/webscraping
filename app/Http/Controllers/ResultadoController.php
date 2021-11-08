<?php

namespace App\Http\Controllers;

use App\Models\Resultado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResultadoController extends Controller
{
    
    public function index(){
       $resultado = Resultado::get();

       return view('resultado',['resultado' => $resultado]);
    }

    public function details($id){
        $detail = Resultado::where('id',$id)->first();
        return view('details',['detail'=>$detail]);
    }

    public function update($id,Request $request){
       
        
        $validator =Validator::make($request->all(),Resultado::$rules);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
          if($id){
             $resultado =Resultado::where('id',$id)->first();

           $resultado->fill($request->all());
           if($resultado->save()){
           
            return redirect()->route('indexresultado');
           }
          }
        
          
    
          return redirect()->route('details',['id'=>$id]);
    }
    
    public function deleteresultado($id){
           
        if($id){
         Resultado::where('id',$id)->delete();
        }
       
     
        return redirect()->route('indexresultado');
     
}


}
