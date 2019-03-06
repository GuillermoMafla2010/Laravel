<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\helper\JwtAuth;
use App\Car;

class CarController extends Controller
{
    //


    public function index(Request $request){



    	$cars=Car::all()->load('user');
    	return response()->json(array(

    		'cars'=>$cars,
    		'status'=>'success'

    	),200);
    	/*$hash=$request->header('Authorization',null);
    	$jwtAuth=new JwtAuth();
    	$checkToken=$jwtAuth->checkToken($hash);

    	if($checkToken){
		echo "Bienvenido";
    	
    	}else{
		echo "Largate mamaverga";
    	
    	}*/	
}

public function show($id){
$cars=Car::find($id)->load('user');
    	return response()->json(array(

    		'cars'=>$cars,
    		'status'=>'success'

    	),200);


}


public function update($id,Request $request){
	$hash=$request->header('Authorization',null);
    	$jwtAuth=new JwtAuth();
    	$checkToken=$jwtAuth->checkToken($hash);

    	if($checkToken){

    		//Recoger datos por post
    		$json=$request->input('json',null);
    		$params=json_decode($json);
    		$params_array=json_decode($json,true); //transforma el json en array
    		//Conseguir usuario identificado
		$user=$jwtAuth->checkToken($hash,true); //Devuelve todos los datos del usuario


		//Validacion
		$validate=\Validator::make($params_array,[		
		
			'title'=>'required|min:5',
			'description'=>'required',
			'price'=>'required',
			'status'=>'required'

		]);
//Actualizar el registro
		unset($params_array['id']);
		unset($params_array['user_id']);
		unset($params_array['created_at']);
		unset($params_array['user']);
		
	$car=Car::where('id',$id)->update($params_array);


$data=array(
			'car'=>$params,
			'status'=>'success',
			'code'=>200


		);


}

		
else{
		$data=array(
			'message'=>'Login incorrecto',
			'status'=>'error',
			'code'=>400


		);

    	}		

return response()->json($data,200);

}


public function destroy($id,Request $request){
$hash=$request->header('Authorization',null);
    	$jwtAuth=new JwtAuth();
    	$checkToken=$jwtAuth->checkToken($hash);

    	if($checkToken){

    		//Recoger datos por post
    		$json=$request->input('json',null);
    		$params=json_decode($json);
    		$params_array=json_decode($json,true); //transforma el json en array
    		//Conseguir usuario identificado
		$user=$jwtAuth->checkToken($hash,true); //Devuelve todos los datos del usuario


		//Validacion
		$validate=\Validator::make($params_array,[		
		
			'title'=>'required|min:5',
			'description'=>'required',
			'price'=>'required',
			'status'=>'required'

		]);
//Borrar el registro

	$car=Car::find($id)->delete();


$data=array(
			'car'=>$car,
			'status'=>'success',
			'code'=>200


		);


}

		
else{
		$data=array(
			'message'=>'Login incorrecto',
			'status'=>'error',
			'code'=>400


		);

    	}		

return response()->json($data,200);

}
public function store(Request $request){
    			$hash=$request->header('Authorization',null);
    	$jwtAuth=new JwtAuth();
    	$checkToken=$jwtAuth->checkToken($hash);

    	if($checkToken){

    		//Recoger datos por post
    		$json=$request->input('json',null);
    		$params=json_decode($json);
    		$params_array=json_decode($json,true); //transforma el json en array
    		//Conseguir usuario identificado
		$user=$jwtAuth->checkToken($hash,true); //Devuelve todos los datos del usuario


		//Validacion
		$validate=\Validator::make($params_array,[		
		
			'title'=>'required|min:5',
			'description'=>'required',
			'price'=>'required',
			'status'=>'required'

		]);

		if($validate->fails()){

			return response()->json($validate->errors(),400);

		}

		

		//Guarda el coche
		
		$car=new Car();
		$car->user_id=$user->sub;
		$car->title=$params->title;
		$car->description=$params->description;
		$car->price=$params->price;
		$car->status=$params->status;
		$car->save();

		$data=array(
			'car'=>$car,
			'status'=>'success',
			'code'=>200


		);


    	}else{
		$data=array(
			'message'=>'Login incorrecto',
			'status'=>'error',
			'code'=>400


		);

    	}

    	return response()->json($data,200);

    	}
    	
    } 

