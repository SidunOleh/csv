<?php

namespace App\Components;

use App\Exceptions\ViewNotFoundException;

class Response
{
	/**
     * JSON response
     *    
	 * @param bool  $status  
     * @param array $data
	 * @param array $errors
     * 
     * @return string response
     */
	public static function json($status=true, $data=[], $errors=[])
	{
		$response = [
			'status' => $status,
		];

		if (! empty($data)) {
			$response = array_merge($response, $data);
		}

		if (! empty($errors)) {
			$response['errors'] = $errors;
		}

		return json_encode($response);
	}

	/**
     * View response
     *    
	 * @param bool $path  
     * 
     * @return string response
     */
	public static function view($path, $data=[])
	{
		$path = implode('/', explode('.', $path));
		
		if (! file_exists($filename = ROOT . '/views/' . $path . '.php')) {
			throw new ViewNotFoundException('View Not Found.');
		}

		extract($data);
		
		ob_start();
		require $filename;
		$response = ob_get_contents();
		ob_end_clean();
	
		return $response;
	}
}
