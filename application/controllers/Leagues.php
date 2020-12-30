<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leagues extends API_Controller {

    public function index_get()
    {
        $api = getApi("all_leagues.php");
        $list = array();
        foreach ($api["leagues"] as $key => $value) {
            if ((preg_match('/\bsoccer\b/', strtolower(@$value->strSport)))) {
                array_push($list, $value);
            }
        }
            
        $this->response(array("leagues" => $list), 200);
    }
}

/* End of file Leagues.php */
