<a href="{{url('/guardar')}}">Crear Nota</a>
@if(session('status'))
<p>{{session('status')}}</p>
@endif
@foreach($notes as $note)

<li>{{$note->title}} <a href="{{url('/buscar/'.$note->id)}}"> Ver</a> <a href="{{url('/eliminar/'.$note->id)}}">Eliminar</a> <a href="{{url('/editar/'.$note->id)}}"> Actualizar</a></li> 
	 

@endforeach