<?php 
class Contributions_archive_model extends MY_Model{

     public $_table='contributions_archives';
     public $primary_key = 'id';


       //check if a member exists
   public function exists($memberid)
   {
     # code...
    $query = $this->db->where('memberid',$memberid)
                      ->get($this->_table);
                         
    return ($query->num_rows()>0);
   }
}