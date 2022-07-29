<?php namespace App\Http\Helpers;
	
	if( ! function_exists('sendResponse') ) {
	function sendResponse($data, $message, $status = 200) 
	    {
	        $response = [
	            'data' => $data,
	            'message' => $message
	        ];
	
	        return response()->json($response, $status);
	    }
    }

	if( ! function_exists('sendError') ) {
		function sendError($errorData, $message, $status = 500)
	    {
	        $response = [];
	        $response['message'] = $message;
	        if (!empty($errorData)) {
	            $response['data'] = $errorData;
	        }
	
	        return response()->json($response, $status);
	    }
    }