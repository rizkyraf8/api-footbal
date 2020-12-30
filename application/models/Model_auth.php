<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_auth extends CI_Model {

    private $table_user = "user";

    public function get_user($arrWhere){
        $this->db->where($arrWhere);
        return $this->db->get($this->table_user)->row_array();
	}
	
    public function insert_user($data){
        $this->db->insert($this->table_user, $data);

		if ($this->db->affected_rows() == 1) {
			return $this->db->insert_id();
		}else{
			return false;
		}
    }

}

/* End of file Model_auth.php */
