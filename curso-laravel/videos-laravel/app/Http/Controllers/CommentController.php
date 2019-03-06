<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\storage;
use Symfony\Component\HttpFoundation\Response;
use App\Controllers\VideoController;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

public function home(){


	return view ("video/detallevideo");
}

	public function store(Request $request){


		$validate=$this->validate($request,[
			'body'=>"required"

		]);

		$comment= new Comment();
		$user= \Auth::user();
		$comment->user_id=$user->id;
		$comment->video_id=$request->input('video_id');
		$comment->body=$request->input('body');
		$comment->save();


		return redirect()->route('detailVideo',['video_id'=>$comment->video_id])->with(array(

			'message'=>"Comentario Guardado"
		));


	}


	public function delete($comment_id){

		$user=\Auth::user();
		$comment=Comment::find($comment_id);
		
		if($user&&($comment->user_id==$user->id || $comment->video->user_id==$user_id)){

			$comment->delete();



		return redirect()->route('detailVideo',['video_id'=>$comment->video_id])->with(array(

			'message'=>"Comentario Eliminado"
		));



		}
	}

	
    //
}
