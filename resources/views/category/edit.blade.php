{{-- @extends('backend.layouts.master') --}}
{{-- @section('main-content') --}}
@extends('layouts.app')

@section('content')
<div class="card">
  {{-- {{dd("hhhh")}} --}}
    <h5 class="card-header">edit category</h5>
    <div class="card-body">
      <form method="post" action="{{route('categories.update',$categorie->id)}}">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="nom" class="col-form-label">name</label>
          <input id="nom" type="text" name="name" placeholder="Enter le nom du categorie"  value="{{$categorie->name}}" class="form-control">
          {{-- @error('nom')
            <span class="text-danger">{{$message}}</span>
          @enderror --}}
        </div>

    
        
        
        <div class="form-group mb-3">
          <a href="javascript:history.back()" class="btn btn-danger" role="button">Annuler</a>
          <button class="btn btn-success" type="submit">Soumis</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('scripts')
  <script src="/public/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
  <script>
      $('#lfm').filemanager('image');
  </script>
@endpush