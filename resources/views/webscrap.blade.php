<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('web scraping') }}
      </h2>
  </x-slot>
<form action="{{ route('search') }}" method="get">
   @csrf
<input type="submit" class="btn btn-dark mt-4 mb-4" value="Buscar"/>
</form>


   
  <table class="table table-dark">
   <thead>
     <tr>
      
       <th scope="col">Texto</th>
       <th scope="col">Autor</th>
       <th scope="col">Tags</th>
       <th scope="col">Save</th>
     </tr>
   </thead>
   <tbody>
     
     @foreach($dados as $item)
     <form action="{{ route('store', ['id' => $item->id])}}" method="post">
     
      {{ csrf_field() }}
     <tr>
      
       <td>{{$item->texto}}</td>
       <td>{{$item->autor}}</td>
       <td>{{$item->tag}}</td>  
       <td>
       
           
       <button class="btn btn-danger"  type="submit"> <i class="fas fa-save"></i></button>
        
       </td> 
     </tr>
   </form>
     @endforeach
   </tbody>
 </table>


</x-app-layout>
