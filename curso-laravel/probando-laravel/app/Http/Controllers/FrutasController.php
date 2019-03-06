<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrutasController extends Controller
{

	public function index(){

    	return view ("index")->with('frutas',array("Naranja","Pera"));
    }


    public function naranjas(){

    	return 'Accion de Naranja';
    }

	public function peras(){

		return 'Accion de Peras';
	}    
    //

    public function formulario(Request $request){

    	$data=$request;
    	return $request->input('nombre'); 

    }
}
