<?php

class Welcome_Model extends CI_Model{
  
    public function select_all_places(){
       
        $this->db->select("*");
        $this->db->from('mosq_mosques');
     
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    
    }
}

?>