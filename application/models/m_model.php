<?php

class M_model extends CI_Model{
    function get_data($table){
        return $this->db->get($table);
    }
}