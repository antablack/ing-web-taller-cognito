<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
	public function saludar($nombre)
	
	{
		//envia el valor de la variable a la variable del array
		$data['nombre']= $nombre;
		$data['mensaje']='Si lo lees estas ok';
		return view('saludar',$data);// llama a la vista
	}
	//--------------------------------------------------------------------

}
