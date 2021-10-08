{{-- @extends('backend.layouts.master') --}}
{{-- @section('main-content') --}}
@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">Ajouter une categorie</h5>
    <div class="card-body">
      <form method="post" action="{{route('categories.store')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="nom" class="col-form-label">Title</label>
          <input id="nom" type="text" name="name" placeholder="Enter le nom du categorie"  value="{{old('title')}}" class="form-control">
          @error('nom')
            <span class="text-danger">{{$message}}</span>
          @enderror
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