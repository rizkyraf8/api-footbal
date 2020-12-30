<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends API_Controller {

    public function next_get($id = "4328")
    {
        $this->response(getApi("eventsnextleague.php?id=$id"), 200);
    }

    public function last_get($id = "4328")
    {
        $this->response(getApi("eventspastleague.php?id=$id"), 200);
    }

    public function search_get()
    {
        $this->response(getApi("searchevents.php?e=". $this->get("event")), 200);
    }
}

/* End of file Event.php */
