
<h1>Listado de Frutas </h1>
@foreach($frutas as $item)

<li>{{$item}}</li>

@endforeach



<a href="{{action ('FrutasController@naranjas')}}" >Ir a Listado de Naranjas</a>
<a href="{{action ('FrutasController@peras')}}" >Ir a Listado de Peras</a>

<a href="{{url('/saveNote')}}">Crear Nota</a>

	<h2>Formulario </h2>
<form action="{{ url('/recibe')}}" method="post" >
	@csrf
<input type="text" name="nombre"><br>
 <input type="text" name="descripcion"><br>
<input type="submit" value="Guardar">
</form>