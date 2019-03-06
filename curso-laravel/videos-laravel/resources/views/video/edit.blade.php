@extends('layouts/app')


@section('content')
<h2>Editar video : {{$video->title}}</h2>

<div clas="container">
<div class="row">
	<form action="{{route('updatedvideo',['id'=>$video->id])}}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
			<input type="text" name="title" id="title" class="form-control" value="{{$video->title}}">
		</div>

<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<input type="text" value="{{$video->description}}" name="descripcion" id="descripcion" class="form-control">
		</div>


<div class="form-group">
			<label for="miniatura">Miniatura</label>

			<input type="file" value="{{old('miniatura')}}" name="miniatura" id="miniatura" class="form-control">
			<img class="form-control" style=" max-height: 75%" src="{{url('/miniatura/'.$video->image)}}" >
		</div>

		<div class="form-group">
			<label for="videofile">Archivo de Video</label>
			<input type="file" name="videofile" id="videofile" class="form-control">
			<video controls id= "video-player">
		<source src="{{route('fileVideo',['filename'=>$video->video_path])}}" class="form-control" type="video/mp4"></source>

		</video>

		</div>

<button type="submit" class="btn btn-success">Subir Video</button>


	</form>
</div>
	</div>
@endsection