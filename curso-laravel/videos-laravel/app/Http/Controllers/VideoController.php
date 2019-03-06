<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Collection;

use App\Video;
use App\Comment;

class VideoController extends Controller
{
    //

    public function home(){
    	$videos=Video::orderBy('id','desc')->paginate(3);

        return view('home', array(
                'videos'=>$videos

        ));

    	return view ("home");
    }

    public function CreaVideo(){
    	return view ("video/createvideo");
    }

   

    public function DetalleVideo($id){

    	$video=Video::find($id);

    	return view ("video.detallevideo", array(
    		'video' => $video

    	));
    }


    public function getVideo($filename){

    	$file=Storage::disk("videos")->get($filename);
    	return new Response($file,200);
    }


    public function search($search=null){

    	if(is_null($search)){

    		$search=\Request::get('search');
    	}

    	$videos=Video::where('title','LIKE','%'.$search.'%')->paginate(5);

    	return view ('home',array(
    		'videos'=>$videos,
    		'search'=>$search

    	));



    }

    public function edit($id){
    	$user=\Auth::user();
    	$video=Video::findOrFail($id);
    	if($user && $video->user_id==$user->id){
    	return view ('video.edit',array(
    		'video'=>$video
    	));
    		}

    	
    }

    public function update($video_id,Request $request){

    	$validate=$this->validate($request,[
    		'title'=>'required|min:5',
    		'descripcion'=>'required',
    		'video'=>'mimes:mp4'

    	]);

    	$user=\Auth::user();
    	$video=Video::findOrFail($video_id);
    	$video->user_id=$user->id;
    	$video->title=$request->input("title");
    	$video->description=$request->input("descripcion");

    	//subida de la imagen
    	$image=$request->file("miniatura");
    	if($image){
    		$image_path=time().$image->getClientOriginalName();
    		\Storage::disk('images')->put($image_path,\File::get($image));
    		$video->image=$image_path;
    	}
//subida del video
    	$clip=$request->file("videofile");
    	if($clip){
    		$clip_path=time().$clip->getClientOriginalName();
    		\Storage::disk('videos')->put($clip_path,\File::get($clip));
    		$video->video_path=$clip_path;
    	}

    	$video->update();
    	return redirect()->action("VideoController@home")->with(array(
    		"message"=>"El video se actualizo"));

    }

    public function getImage($filename){


    	$file=Storage::disk('images')->get($filename);
    	return new Response ($file,200);
    }


    public function delete($video_id){
    	$user=\Auth::user();
    	$video=Video::find($video_id);
    	$comments=Comment::where('video_id',$video_id)->get();

    	if($user && $video->user_id==$user->id){

    		//Eliminar COmentarios
    		if($comments && count($comments)>=1){
    			foreach ($comments as $comment) {
    				$comment->delete();
    			}
    		
				}
    		//Eliminar Ficheros
    		Storage::disk('images')->delete($video->image);
    		Storage::disk('videos')->delete($video->video_path);

    		//Eliminar registro 
    		$video->delete();
    	}

    	return redirect()->action("VideoController@home")->with(array(
    		"message"=>"Video Eliminado correctamente"

    	));

    	
    }


    public function saveVideo(Request $request){
    	$validateData=$this->validate($request,array(
    		'title'=>"required|min:5",
    		"descripcion"=>"required",
    		"videofile"=>"mimes:mp4"

    	));

    	$video=new Video();
    	$user=\Auth::user();
    	$video->user_id=$user->id;
    	$video->title=$request->input("title");
    	$video->description=$request->input("descripcion");


//subida de la imagen
    	$image=$request->file("miniatura");
    	if($image){
    		$image_path=time().$image->getClientOriginalName();
    		\Storage::disk('images')->put($image_path,\File::get($image));
    		$video->image=$image_path;
    	}
//subida del video
    	$clip=$request->file("videofile");
    	if($clip){
    		$clip_path=time().$clip->getClientOriginalName();
    		\Storage::disk('videos')->put($clip_path,\File::get($clip));
    		$video->video_path=$clip_path;
    	}

    	$video->save();

    	return redirect()->action("VideoController@home")->with(array(
    		"message"=>"Video subido correctamente"

    	));



    }
}
