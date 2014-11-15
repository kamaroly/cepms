<?php 
/**
* @author Kamaro Lambert
* @package cepms
* @description  Model to generated reports of the contribution from the database
*/
class Returned_contribution_model extends MY_Model
{
	
     public $_returned_table ="contributions_refund";
     public $_members_table       ="members";
   #method to get the contribution for members
   public function MemberContributionReturned(){
   
     $dataset=$this->db->query("SELECT *
                        FROM ".$this->db->dbprefix($this->_returned_table)." as a
                        LEFT JOIN ".$this->db->dbprefix($this->_members_table)." as b
                        ON a.memberid=b.id 
                        order by  a.created_at asc ");
   
   #return the result

   return $dataset->result();

    
   }
}

 ?>