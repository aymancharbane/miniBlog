{{-- @extends('backend.layouts.master') --}}
{{-- @section('main-content') --}}
@extends('layouts.app')

@section('content')
<div class="card">
    <h5 class="card-header">add post</h5>
    <div class="card-body">
      <form method="post" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-data">
        @csrf 
        @method('PATCH')

        <div class="form-group">
          <label for="nom" class="col-form-label">Title</label>
          <input id="nom" type="text" name="title" placeholder="Enter le nom du categorie"  value="{{$post->title}}" class="form-control">
          @error('nom')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="nom" class="col-form-label">Body</label>
          <textarea id="nom" type="text" name="body" class="form-control">{{$post->body}}</textarea>
          @error('nom')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <span data-default='Choose file' style="
                border-radius: 8px;">Choose image</span>
                <input class="ml-0_5" name="image" id="image" type="file" accept="image/png, image/jpeg"/>
          @error('nom')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="category">Category</label>
          <select class="form-control" id="categorie" name="idCategory" value="{{$post->idCategory}}">
            <option>choose category</option>
            {{-- @if(auth()->user()->hasRole('admin')) --}}
              @foreach ($categories as $categorie)
                  <option value = {{$categorie->id}} >{{$categorie->name}}</option>
              @endforeach
            {{-- @else
              {{-- <option value = {{$categorie->id}} selected="selected">{{$categorie->nom}}</option> 
            @endif --}}
          </select>
          @error('categorie')
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