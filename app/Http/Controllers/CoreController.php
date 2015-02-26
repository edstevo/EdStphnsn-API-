<?php namespace Blog\Http\Controllers;

use Blog\Http\Requests;
use Blog\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Response;

use Config;

class CoreController extends Controller {

	public function getPostTypes()
	{
		$types 			= Config::get('constants.post_types');
		$return_types	= [];

		foreach ($types as $key => $value)
		{
			if (is_numeric($key))
			{
				$type_key 	= $key;
				$type_value	= $value;
			} else {
				$type_key 	= $value;
				$type_value	= $key;
			}
			$return = [
				'value'	=> $type_key,
				'type'	=> ucwords($type_value)
			];
			array_push($return_types, $return);
		}

		return Response::make(['data' => $return_types], 200);
	}

}
