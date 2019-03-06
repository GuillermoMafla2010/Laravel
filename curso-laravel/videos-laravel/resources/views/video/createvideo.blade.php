

@extends("layouts.app")
@section('content')
<h2>Crear un nuevo video</h2>

<div clas="container">
<div class="row">
	<form action="{{url('/guardar')}}" method="post" enctype="multipart/form-data" class="col-lg-7">
		{!!csrf_field()!!}

		@if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>


		</div>



		@endif
		<div class="form-group"> 
			<label for="title">Titulo</label>
			<input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
		</div>

<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<input type="text" value="{{old('descripcion')}}" name="descripcion" id="descripcion" class="form-control">
		</div>


<div class="form-group">
			<label for="miniatura">Miniatura</label>
			<input type="file" value="{{old('miniatura')}}" name="miniatura" id="miniatura" class="form-control">
		</div>

		<div class="form-group">
			<label for="videofile">Archivo de Video</label>
			<input type="file" name="videofile" id="videofile" class="form-control">
		</div>

<button type="submit" class="btn btn-success">Subir Video</button>


	</form>
</div>
	</div>
@endsection