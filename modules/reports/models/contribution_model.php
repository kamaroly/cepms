<?php 
/**
* @author Kamaro Lambert
* @package cepms
* @description  Model to generated reports of the contribution from the database
*/
class Contribution_model extends MY_Model
{
	
     public $_contributions_table ="contributions";
     public $_members_table       ="members";
   #method to get the contribution for members
   public function MemberContribution($start_date,$end_date,$id=false){
     
     $this->db->select('*,'.$this->db->dbprefix($this->_contributions_table).'.id as contributionid');
     $this->db->from($this->_contributions_table);
     $this->db->join($this->_members_table, $this->db->dbprefix($this->_contributions_table).'.memberid = '.$this->db->dbprefix($this->_members_table).'.id','LEFT');
     $this->db->where($this->db->dbprefix($this->_contributions_table).'.month >=',$start_date);
     $this->db->where($this->db->dbprefix($this->_contributions_table).'.month <=',$end_date);

     #Only if we are looking for one member
     if($id!=false):
     $this->db->where_in($this->db->dbprefix($this->_members_table).'.id',$id);
     endif;
     $this->db->order_by($this->db->dbprefix($this->_contributions_table).'.month',"asc");

     return $query = $this->db->get()->result();
     
   }
}

 ?>