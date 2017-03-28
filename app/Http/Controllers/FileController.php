<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class FileController extends Controller
{
	public function getFile($filename)
	{
		return response(Storage::get($filename))->header('Content-Type', Storage::mimetype($filename));
	}

	public function uploadFile(Response $response)
	{
		
	}
}
