<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_favorite extends CI_Model {

    private $table_favorite_match = "favorite_match";
    private $table_favorite_team = "favorite_team";

    public function get_list_team($id = ""){
        return $this->db->where("userId", $id)->get($this->table_favorite_team)->result_array();
    }

    public function insert_team($data){
        $this->db->insert($this->table_favorite_team, $data);

		if ($this->db->affected_rows() == 1) {
			return $this->db->insert_id();
		}else{
			return false;
		}
    }

    public function delete_team($arrWhere)
	{
		$query = $this->db->where($arrWhere);
		$query = $this->db->delete($this->table_favorite_team);

		if ($query) {
			return true;
		}else{
			return false;
		}
	}

    public function get_list_match($id = ""){
        return $this->db->where("userId", $id)->get($this->table_favorite_match)->result_array();
    }

    public function insert_match($data){
        $this->db->insert($this->table_favorite_match, $data);

		if ($this->db->affected_rows() == 1) {
			return $this->db->insert_id();
		}else{
			return false;
		}
    }

    public function delete_match($arrWhere)
	{
		$query = $this->db->where($arrWhere);
		$query = $this->db->delete($this->table_favorite_match);

		if ($query) {
			return true;
		}else{
			return false;
		}
	}

}

/* End of file Model_favorite.php */
