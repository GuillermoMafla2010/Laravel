<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotesCOntroller extends Controller
{

	public function index(){


		$notas= DB::table("notas")->get();
		return view("notas",array("notes"=>$notas));
	}


	public function getNote($id){

		$note=DB::table("notas")->where('id',$id)->first();
		return view ('buscar',array('note'=>$note));
	}

	public function postNote(Request $request){

		$note = DB::table('notas')->insert(array(
			'title'=>$request->input('title'),
			'descripcion'=>$request->input('descripcion')));


		return redirect()->action("NotesCOntroller@index");
	}



	public function SaveNote(){

		return view("saveNote");
	}


	public function borrar($id){

		$note=DB::table('notas')->where('id',$id)->delete();
		return redirect()->action("NotesCOntroller@index")->with("status","Nota Borrada");

	}

public function postUpdate($id,Request $request){

		$note = DB::table('notas')->where('id',$id)->update(array(
			'title'=>$request->input('title'),
			'descripcion'=>$request->input('descripcion')));


		return redirect()->action("NotesCOntroller@index")->with("status","Nota Actualizada");
	}

	public function getUpdate($id){

		$note = DB::table('notas')->where('id',$id)->first();


		return view("saveNote",array("note"=>$note));
	}



    //
}
