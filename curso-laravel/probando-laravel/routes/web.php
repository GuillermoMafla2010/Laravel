<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola-mundo', function () {
    return ('Cabron de a verga');
});
Route::get('/formulario', function () {
    return view ('contacto');
});

Route::get('/parametro/{nombre?}/{edad?}', function ($nombre="Cristian", $edad=null) {
    return view ('parametro')
    -> with ('nombre',$nombre)
    -> with ('edad',$edad)
    -> with ('frutas' , array("Piña","Naranja","Verga"));

})-> where (["nombre"=>"[A-Za-z]+","edad"=>"[0-9]+"]);



Route::group(['prefix'=>'fruteria'],function(){
Route::get('/index',"FrutasController@index");
Route::get('/naranjas/{admin?}',['middleware' => "IsAdmin",
							'uses'=> "FrutasController@naranjas"]);
Route::get('/peras',"FrutasController@peras");


});


Route::post("/recibe","FrutasController@formulario");
Route::get("/notas","NotesCOntroller@index");
Route::get("/buscar/{cabron}","NotesCOntroller@getNote");
Route::get("/guardar","NotesCOntroller@SaveNote");
Route::get("/editar/{id}","NotesCOntroller@getUpdate");
Route::post("/exito","NotesCOntroller@postNote");
Route::post("/editar/{id}","NotesCOntroller@postUpdate");
Route::get("/eliminar/{id}","NotesCOntroller@borrar");
