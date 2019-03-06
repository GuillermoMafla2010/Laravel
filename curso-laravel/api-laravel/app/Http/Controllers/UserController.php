<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\helper\JwtAuth;

class UserController extends Controller
{
    //


    public function register(Request $request){
    	//Recoger post

    	$json=$request->input('json',null);
    	$params=json_decode($json);

    	$email=(!is_null($json) && isset($params ->email)) ? $params ->email : null;
    	$name=(!is_null($json) && isset($params->name)) ? $params ->name : null;
    	$surname=(!is_null($json) && isset ($params ->surname)) ? $params ->surname : null;
    	$role='ROLE_USER';
    	$password=(!is_null($json) && isset($params ->password)) ? $params ->password : null;

    if(!is_null($email) && !is_null($password) &&!is_null($name)){

    		$user=new User();
    		$user->email=$email;
    		$user->name=$name;
    		$user->surname=$surname;
    		$user->role=$role;
    		$pwd=hash('sha256',$password);
    		$user->password=$pwd;


//Comprueba usuarios duplicados
    		$isset_user=User::where('email','=',$email)->first();

    		if(count($isset_user)==0){
    			//Guardo el usuario
    				$user->save();


    				$data=array(
    			'status'=>'sucess',
    			'code'=>200,
    			'message'=>"Usuario creado correctamente"
    		);

    		}else{
    			$data=array(
    			'status'=>'error',
    			'code'=>400,
    			'message'=>"Usuario duplicado"
    		);
    		}



    	}else{
    		$data=array(
    			'status'=>'error',
    			'code'=>400,
    			'message'=>"Usuario mal creado"
    		);


    		

    	}

    	return response()->json($data,200);

    }



    public function login(Request $request){
    	
    	$jwtAuth=new JwtAuth();
    	//Recibir datos por post
    	$json =$request->input('json',null);
    	$params=json_decode($json);

    	$email=(!is_null($json) && isset($params ->email)) ? $params ->email : null;
    	$password=(!is_null($json) && isset($params ->password)) ? $params ->password : null;
    	$getToken=(!is_null($json) && isset($params ->gettoken)) ? $params ->gettoken : null;
    

    //Cifrar password
    $pwd=hash('sha256',$password);

    if(!is_null($email)&&!is_null($password)&&($getToken=='false'||$getToken==null)){
    	$signup=$jwtAuth->signup($email,$pwd);
    	}elseif($getToken!=null){
    		$signup=$jwtAuth->signup($email,$pwd,$getToken);
    		return response()->json($signup,200);
    	}else{
    		$signup=array(
    			'status'=>'error',
    				'message'=>'Envia tus datos por post'
    		);
    		
    	}
    


    return response()->json($signup,200);

}

}
