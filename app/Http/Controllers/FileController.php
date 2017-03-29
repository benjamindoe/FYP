<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ClassCloudResource;
use Storage;

class FileController extends Controller
{
	public function getFile($classForm, $subject, $id)
	{
		$ccr = ClassCloudResource::whereHas('classes', function($query) use ($classForm) {
			$query->where('class_form', $classForm)->current();
		})->whereHas('subject', function ($query) use ($subject) {
			$query->where('name', $subject);
		})->where('id', $id)->firstOrFail();
		return response(Storage::get($ccr->path))->header('Content-Type', Storage::mimetype($ccr->path));
	}
}
