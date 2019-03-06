
@include('cabecera')

{{$nombre}}

{{$edad}}

@if(!is_null($edad))
	la edad es {{$edad}}
@else
	No existe la edad

@endif

<?php  $numero=4; ?>

@for($i=1 ; $i<=10 ; $i++)<br>
	
   {{($i*2)}}
	@endfor



{{$f=1}}
@while($f < 10)

{{"Hola Mundo" . $f }}
{{$f++}}
<br>
@endwhile


<h2>Listado de Frutas</h2>
@foreach($frutas as $fruta)
{{$fruta}}
<br>
@endforeach