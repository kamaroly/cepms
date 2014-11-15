<?php 

class Account_model extends MY_Model{

     public $_table='accounts';
     public $primary_key = 'id';
	

  public function balance($account_id){

 $result=$this->db->select_sum('amount')
                  ->where('account_id',$account_id)
                  ->get('postings')
                  ->result();		
   return  $result[0]->amount;
   }

   public function accountsids()
   {
   	
     $this->db->select('id');
     return $this->db->get($this->_table)->result();
   }
}
