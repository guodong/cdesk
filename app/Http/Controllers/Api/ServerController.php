<?php namespace App\Http\Controllers\Api;

use App\Models\Server;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
class ServerController extends Controller {

	public function index()
	{
		return Server::orderBy('created_at', 'asc')->get();
	}
	
	public function store()
	{
	    return Server::create(Input::get());
	}

}
