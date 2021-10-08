@extends('layouts.app')

@section('content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         {{-- <div class="col-md-12">
            @include('backend.layouts.notification')
         </div> --}}
     </div>
    {{-- <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">posts</h6>
      <a href="{{route('post.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add plat"><i class="fas fa-plus"></i> Add post</a>
    </div> --}}
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="plat-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>publisher</th>
              <th>Title</th>
              <th>slug</th>
              <th>body</th>
              <th>image</th>
              <th>categorie</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>publisher</th>
              <th>Title</th>
              <th>slug</th>
              <th>body</th>
              <th>image</th>
              <th>categorie</th>
              <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($posts as $post)   
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$post->publisher->userName}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->slug}}</td>
                    <td>{{$post->body}}</td>
                    <td>
                      @if($post->image)
                          <img src="{{asset($post->image)}}" class="img-fluid rounded-circle" style="max-width:50px" alt="{{$post->image}}">
                     @endif
                    </td>
                    <td>{{$post->categorie->name}}</td>
                    
                    <td>
                      <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                      <form method="POST" action="{{route('posts.destroy',[$post->id])}}">
                        @csrf                          
                        @method('delete')
                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$post->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                      </form>

                      @if ($post->approved==0)
                        <form method="POST" action="{{route('approvePost')}}">
                          @csrf                          
                          <input type="hidden" value="{{$post->id}}" name="idPost">
                          <button value="approve" data-id={{$post->id}} data-toggle="tooltip" data-placement="bottom" title="approve"><i class="fas fa-trash-alt"></i>approve</button>
                        </form>

                     
                      @endif

                      
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#plat-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Êtes-vous sûr?",
                    text: "Une fois supprimées, vous ne pourrez plus récupérer ces données!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Vos données sont en sécurité! ");
                    }
                });
          })
      })
  </script>
@endpush