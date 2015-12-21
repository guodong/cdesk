<?php namespace App\Http\Controllers;

use App\Models\Vm;
use App\Models\Server;
class VmController extends Controller {

	public function index()
	{
		return Vm::all();
	}

}
