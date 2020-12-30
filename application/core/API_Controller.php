<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class API_Controller extends REST_Controller {

	public function __construct()
	{
		parent::__construct();

		$token = explode(" ", $this->input->get_request_header('Authorization'));

		$jwtApi = JWT::decode(@$token[1], secretKey(), true);

		if (@$jwtApi->logged AND time() < @$jwtApi->exp) {
			$this->jwtData = $jwtApi;
		}else{
			$responseData = null;
			$responseError = TRUE;
			$responseCode = "XX00";
			$responseDesc = 'Failed to authenticate token, exp';

			$response =  resultJson($responseError, $responseCode, $responseDesc, $responseData);

			$this->response($response, 200);
		}
	}
}

/* End of file API_Controller.php */
/* Location: ./application/core/API_Controller.php */