<div class="row card-columns">
  <div class="col-sm-12">
    <div class="card">

       @section('busqueda')
        <div class="container">

        </div>
       @show
@if(count($videos)>=1)
@foreach($videos as $video)

<div class="card-body anchura foto pull-left">
        @if(Storage::disk('images')->has($video->image))
        <img class="foto" style=" max-height: 75%" src="{{url('/miniatura/'.$video->image)}}" >
        @endif
        <h5 class="card-title">{{$video->title}}</h5>
        <p class="card-text">{{$video->description}}</p>
        <a href="{{route('detailVideo',['video_id'=>$video->id])}}" class="btn btn-success">Ver video</a>
        <a href="{{route('edit',['video_id'=>$video->id])}}" class="btn btn-info">Editar video</a>
        <a href="{{route('borrar',['video_id'=>$video->id])}}" class="btn btn-danger" onclick="return confirm ('Lo eliminaras');">Eliminar video</a>
        
      </div>
    </div>
  </div>
  </div>



@endforeach

@else
<div class="alert alert-danger">No existen videos relacionados</div>
@endif


{{$videos->links()}}
      