<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends API_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_auth');
        $this->load->model('Model_profile');
    }
    
    
    public function update_password_post()
    {
        $response = array();
        
        $post = $this->post();
        
        $this->form_validation->set_data($post);
        $this->form_validation->set_rules('oldPassword','oldPassword','required|min_length[6]');
        $this->form_validation->set_rules('newPassword','newPassword','required|min_length[6]');
        
        if ($this->form_validation->run() == TRUE) {
            
            $queryCheckUser = $this->Model_auth->get_user(array(
                "userId" => $this->jwtData->id,
                "userPassword" => md5($post['oldPassword'])
            ));
            
            if($queryCheckUser){
                $arrUpdate = array(
                    'userPassword' 		=> md5($post["newPassword"]),
                );
                
                $queryUpdate = $this->Model_profile->update_user($arrUpdate, $this->jwtData->id);
                
                if ($queryUpdate){
                    $response['status'] = 200;
                    $response['error'] = false;
                    $response['message'] = 'Berhasil update password';
                }else{
                    $response['status'] = 200;
                    $response['error'] = true;
                    $response['message'] = 'Gagal mengupdate password';
                }
                
            }else{
                $response['status'] = 200;
                $response['error'] = true;
                $response['message'] = 'Password lama salah';
            }
            
        }else{
            $message = $this->form_validation->error_array();
            $response['error'] = true;
            $response['status'] = 200;
            $response['message'] = viewErrorValidation($message);
        }
        
        $this->response($response, $response['status']);
    }
    
    public function update_profile_post()
    {
        
    }
}

/* End of file Profile.php */
