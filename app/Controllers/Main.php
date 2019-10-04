<?php namespace App\Controllers;

class Main extends BaseController
{
	public function index()
	{
		return view('main');
	}

//--------------------------------------------------------------------
//--------------------------------------------------------------------
public function contato()
{
	return view('contato');
}
}
