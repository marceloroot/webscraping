<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DOMDocument;
use DOMXPath;

class Resultado extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['texto','autor','tag','created_at','user_id'];
    use HasFactory;


        //funçao que busca dados através DOM da Pagina HTML
        public static function  webscsrap(){
            $curl = curl_init('https://quotes.toscrape.com');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
           //OR $conteudo = file_get_contents(filename:'https://quotes.toscrape.com');
            
            $conteudo = curl_exec($curl);
            //tira o erro interno do xmtl
            libxml_use_internal_errors(use_errors:true);
            
            //$conteudo = file_get_contents(filename:'https://quotes.toscrape.com');
            //cria um documento do tipo dom
            $documento = new DOMDocument();
            //carrega o html que esta no conteudo
            $documento->loadHTML($conteudo);
    
            //forma de buscar elemento no dom
            $xPath = new DOMXPath($documento);
            //seleciona uma div que tem class quote
           $domNodeList= $xPath->query(expression:'.//div[@class="quote"]');
      
           $lista = array();
           $i=0;
          
           //** @var DOMNode $elemento */
          foreach($domNodeList as $elemento){
                  
              $dados = explode('by',$elemento->nodeValue . PHP_EOL);
              $dados2 =explode(':',$dados[1]);
              $dados3 =explode('(about)',$dados[1]);
              
              //Coloca em uma lista com regx para arrumar os espacos 
              
              $lista[$i][0]=preg_replace('/\\s\\s+/', ' ',  $dados[0]); //  texto;
              $lista[$i][1]= preg_replace('/\\s\\s+/', ' ', $dados3[0]);  //  by;
              $lista[$i][2]= preg_replace('/\\s\\s+/', ' ', $dados2[1]); //Tags 
          
              $i++;
             
          }
          return $lista;
        }

        static $rules =[
            'texto'=>'required',
            'autor'=>'required',
            'tag'=>'required|',
        ];


        public function usuario(){
            // return $this->hasOne('App\Models\Atividades','i_atividades','id');
             return $this->belongsTo('App\Models\User','user_id');
     
         }
}
