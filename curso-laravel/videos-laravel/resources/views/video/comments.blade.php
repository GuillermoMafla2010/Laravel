
<hr>

	<h2>Comentarios</h2>
</hr>

@if(session('message'))
<div class="alert alert-success">
{{session('message')}}
</div>

@endif

<form class="col-md-4" method="post" action="{{url('/comment')}}">
	{!!  csrf_field() !!}



<input type="text" name="video_id" value="{{$video->id}}" required>
	<p>
		<textarea class="form-control" name="body" required></textarea>

	</p>

	<input type="submit" value="Comentar" class="btn btn-success">

<hr/>
@if(isset($video->comments))

@foreach($video->comments as $comment)



<div class="card border-info mb-3" style="max-width: 98rem;">
  <div class="card-header bg-transparent border-success">  {{\FormatTime::LongTimeFilter($comment->created_at) }}</div>
  <div class="card-body text-success">
    <h5 class="card-title">{{$comment->user->name}}</h5>
    <p class="card-text">{{$comment->body}}</p>
  </div>
  
</div>

@if(Auth::user()->id==$comment->user_id || Auth::user()->id==$video->user_id)
<!-- Botón en HTML (lanza el modal en Bootstrap) -->
<a href="#victorModal{{$comment->id}}" role="button" class="btn btn-large btn-primary" data-toggle="modal">Eliminar</a>
  
<!-- Modal / Ventana / Overlay en HTML -->
<div id="victorModal{{$comment->id}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">¿Estás seguro?</h4>
            </div>
            <div class="modal-body">
                <p>¿Seguro que quieres borrar este elemento?</p>
                <p class="text-warning"><small>Si lo borras, nunca podrás recuperarlo.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <a href="{{url('/deletecomment/'.$comment->id)}}"><button type="button"  class="btn btn-danger">Eliminar</button></a>
            </div>
        </div>
    </div>
</div>
@endif


@endforeach

@endif
</form>