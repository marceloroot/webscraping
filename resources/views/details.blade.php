<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Detalhes') }}
      </h2>
  </x-slot>

<form class="m-3" action="{{ route('update',['id'=>$detail->id]) }}" method="post">
   
    @method('PUT')
    @csrf
   
    <div class="card" style="width: 80rem;">
       
        <div class="card-body">
          
          
             <div class="mb-3">
               
                <label for="texto" class="form-label">Texto</label>
                <input type="text" class="form-control" id="texto" name="texto" value="{{$detail->texto}}">
                @if($errors->has('texto'))
                  <div class="error">{{ $errors->first('texto') }}</div>
                @endif
              </div>
              <div class="mb-3">
                <label for="texto" class="form-label">autor</label>
                <input type="text" class="form-control" name="autor" id="autor" value="{{$detail->autor}}">
                @if($errors->has('autor'))
                <div class="error">{{ $errors->first('autor') }}</div>
                @endif
              </div>
              <div class="mb-3">
                <label for="tags" class="form-label">tags</label>
                <input type="text" class="form-control" name="tag" id="tag" value="{{$detail->tag}}">
                @if($errors->has('tag'))
                <div class="error">{{ $errors->first('tag') }}</div>
                @endif
              </div>

              <button class="btn btn-danger" style="display:inline"  type="submit">Atualizar</button>
              
        </div>
      </div>
    </form>
</form>

</x-app-layout>