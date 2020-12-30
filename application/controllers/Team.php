<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends API_Controller {

    public function index_get($id = "4328")
    {
        $this->response(getApi("lookup_all_teams.php?id=$id"), 200);
    }

    public function detail_get($id = "")
    {
        $this->response(getApi("lookupteam.php?id=$id"), 200);
    }

    public function search_get()
    {
        $this->response(getApi("searchteams.php?t=". $this->get("team")), 200);
    }
}

/* End of file Team.php */
