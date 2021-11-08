
<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Histórico') }}
      </h2>
  </x-slot>


  @push('styles')
  <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
  @endpush

<div class="d-xl-flex">
    <a  href=" {{ route('search') }}" class="btn btn-dark m-auto" >Buscar</a>

 <form class="m-3" action="{{ route('deleteallhistorico') }}" method="get">
    @csrf 
 <input type="submit" class="btn btn-danger mt-4 mb-4" value="Delete all"/>
 </form>
</div>

<h3>Historico</h3>
<div class="row mt-3">
<table class="table" id="minhaTabela">
    <thead>
      <tr>
        <th>Codigo</th>
        <th>Texto</th>
        <th>Autor</th>
        <th>Tags</th>
        <th>Data</th>
        <th>Nome</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
        @foreach( $historico as $item)
        
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->texto}}</td>
            <td>{{$item->autor}}</td>
            <td>{{$item->tag}}</td>
            <td>{{$item->usuario->name}}</td>
            <td>{{ date( 'd/m/Y' , strtotime($item->dataCadastro))}}</td>
            <td>
                <div class="d-flex">
                <form style="margin-right:1rem;" action="{{ route('store', ['id' => $item->id])}}" method="post">
                    @csrf 
                   <button class="btn btn-success"  style="display:inline"  type="submit"> <i class="fas fa-save"></i></button>
               </form>
               <form  action="{{ route('delete', ['id' => $item->id])}}" method="post">
                 @csrf 
                 <button class="btn btn-danger" style="display:inline"  type="submit"> <i class="fas fa-trash"></i></button>
               </form>
            </div>
            </td> 
          </tr>
        
        @endforeach
     
     
    </tbody>
  </table>
            
</div>
  @section('scripts')

 
  <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function(){
        $('#minhaTabela').DataTable({
              "language": {
                  "lengthMenu": "Mostrando _MENU_ registros por página",
                  "zeroRecords": "Nada encontrado",
                  "info": "Mostrando página _PAGE_ de _PAGES_",
                  "infoEmpty": "Nenhum registro disponível",
                  "infoFiltered": "(filtrado de _MAX_ registros no total)"
              }
          });
    });
    </script>

@stop

</x-app-layout>