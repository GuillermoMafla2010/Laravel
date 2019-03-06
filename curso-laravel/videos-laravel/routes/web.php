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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/crear',array(

'middleware'=>"auth",
'uses'=>'VideoController@CreaVideo'

));


Route::post('/guardar',array(

'middleware'=>"auth",
'uses'=>'VideoController@saveVideo'

));


Route::post('/actualizar/{id}',array(
"as"=>"updatedvideo",
'middleware'=>'auth',
'uses'=>'VideoController@update'

));



Route::get("/home","VideoController@home");
Route::get("/miniatura/{filename}","VideoController@getImage");
Route::get("/video/{video_id}",array(
	"as"=>"detailVideo",
	"uses"=>"VideoController@DetalleVideo"

));

Route::get("/video-file/{filename}",array(

	"as"=>"fileVideo",
	"uses"=>"VideoController@getVideo"
));

Route::post('/comment',array(
	"as"=>"comment",
	"middleware"=>"auth",
	"uses"=>"CommentController@store"

));

Route::get("/deletecomment/{comment_id}","CommentController@delete");

Route::get("/deletevideo/{video_id}",array(

"as"=>"borrar",
"middleware"=>"auth",
"uses"=>"VideoController@delete"

));

Route::get('/buscar/{search?}',array(
	"as"=>"videosearch",
	"uses"=>"VideoController@search"

));


Route::get("/editar-video/{video_id}",array(
"as"=> "edit",
"middleware"=>"auth",
"uses"=>"VideoController@edit"

));






