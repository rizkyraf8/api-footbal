<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_profile extends CI_Model {

    private $table_user = "user";

    function update_user($data, $id){
        $this->db->where("userId", $id);
        $query = $this->db->update($this->table_user,$data);
		if ($query) {
			return true;
		}else{
			return false;
		}
    }


}

/* End of file Model_profile.php */
