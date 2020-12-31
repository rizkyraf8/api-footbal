<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';

class Auth extends REST_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_auth');
        
    }

    public function login_post()
    {
        $response = array();
        
        $post = $this->post();
        
        $this->form_validation->set_data($post);
        $this->form_validation->set_rules('email','email','required');
        $this->form_validation->set_rules('password','password','required|min_length[6]');
        
        if ($this->form_validation->run() == TRUE) {
            
            
            $query = $this->Model_auth->get_user(array(
                "userEmail" => $post['email'],
                "userPassword" => md5($post['password'])
            ));
            
            if($query){
                $token = array(
					'id' 				=> $query["userId"], 
					'email' 			=> $query["userEmail"], 
					'name' 		        => $query["userName"],
					'logged' 			=> TRUE,
					'iat'				=> time(),
					'exp' 				=> time() + 3600000
					// 'exp' => time() + 180
				);

                $jwt_token = JWT::encode($token, secretKey());

                $query["token"] = $jwt_token;
                $query["type"] = "Bearer";

                $response['status'] = 200;
                $response['error'] = false;
                $response['message'] = 'Approved';
                $response['data'] = $query;
            }else{
                $response['status'] = 200;
                $response['error'] = true;
                $response['message'] = 'failed insert';
            }
            
        }else{
            $message = $this->form_validation->error_array();
            $response['error'] = true;
            $response['status'] = 200;
            $response['message'] = viewErrorValidation($message);
        }
        
        $this->response($response, $response['status']);
    }

    public function register_post()
    {
        $response = array();
        
        $post = $this->post();
        
        $this->form_validation->set_data($post);
        $this->form_validation->set_rules('email','Email','trim|required|is_unique[user.userEmail]');
        $this->form_validation->set_rules('password','password','required|min_length[6]');
        $this->form_validation->set_rules('name','name','required');

        $this->form_validation->set_message('is_unique', '{field} Telah Terdaftar');	

        if ($this->form_validation->run() == TRUE) {
            
            $arrSave = array(
                "userEmail" => $post['email'],
                "userPassword" => md5($post['password']),
                "userName" => $post['name'],
                "createdAt" => date('Y-m-d H:i:s')
            );
            
            $query = $this->Model_auth->insert_user($arrSave);
            
            if($query){
                $response['status'] = 201;
                $response['error'] = false;
                $response['message'] = 'data inserted';
            }else{
                $response['status'] = 200;
                $response['error'] = true;
                $response['message'] = 'failed insert';
            }
            
        }else{
            $message = $this->form_validation->error_array();
            $response['error'] = true;
            $response['status'] = 200;
            $response['message'] = viewErrorValidation($message);
        }
        
        $this->response($response, $response['status']);
    }
}