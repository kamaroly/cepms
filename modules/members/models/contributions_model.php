<?php 
class Contributions_model extends MY_Model{

     public $_table='contributions';
     public $_contribution_archive ='contributions_archives';
     public $primary_key = 'id';


  /**
  *@author Kamaro Lambert
  *@method to get the total contribution
  *@param boolen $cep TRUE if we need CEP contribution
  *@param numeric $memberid if we need contribution for a specific member
  */
  public function GetTotalContributions($cep=TRUE,$memberid=null)
  {
  	#Check if we are looking for cep contribution 
  	if ($cep==TRUE) {
       $this->db->select_sum('cep_contribution');
  	}
  	else{
  	  $this->db->select_sum('social_fund');
  	}

    
    $this->db->from($this->_table);
     
    //Do we need to select sum for a specific user?
    if ($memberid!=null && is_numeric($memberid)) {
      $this->db->where('memberid',$memberid);
    }

    $dataset=$this->db->get();
  	  	#Check if we are looking for cep contribution 
  	if ($cep==TRUE) {

     $total_amount=   $dataset->result()[0]->cep_contribution;
  	}
  	else{
  	   $total_amount=   $dataset->result()[0]->social_fund;
  	}
                     
  #if total amount  is null then return 0
  return ($total_amount!=null)?$total_amount:0;
  }  	

  //method to archive contributions
  public function archive($memberid=null)
  {
   if ($memberid==null) {
     return false;
   }
   return $this->db->query("INSERT INTO ".$this->db->dbprefix($this->_contribution_archive)." (SELECT * FROM "
                      .$this->db->dbprefix($this->_table)." as a WHERE a.memberid=$memberid)" );
  }

  //set to 0 all the CEP contribution of a given member
  public function SetCepToZero($memberid=null)
  {
   if ($memberid==null) {
     return false;
   }

   return $this->db->update($this->_table, array('cep_contribution' =>0),array('memberid' => $memberid)); 
  }

   

}