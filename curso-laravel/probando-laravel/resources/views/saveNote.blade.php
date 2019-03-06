



<form action="{{ !isset($note) ? url('/exito') : url('/editar/'.$note->id) }}" method="post">

@csrf
Titulo<input type="text" name="title" value="{{ isset($note) ? $note->title : '' }}"><br/>
Descripcion<input type="text" name="descripcion" value="{{ isset($note) ? $note->descripcion : ''  }}"><br/>

<input type="submit" value="Guardar">
</form>