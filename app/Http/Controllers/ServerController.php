<?php namespace App\Http\Controllers;

use App\Models\Server;
class ServerController extends Controller {

	public function index()
	{
		return view('servers', ['servers' => Server::all()]);
	}

}
