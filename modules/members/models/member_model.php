<?php 
class Member_model extends MY_Model{

     public $_table='members';

     public $_loan_table='Loans';
     public $_loan_payments_table = "loan_payments";
     public $primary_key = 'id';
	

  public function ByLevel($serviceName){

  return $result=$this->db->where('level',$serviceName)
                  ->get($this->_table)
                  ->result();		
     
   }


//This method returns the max id incremented one.
public function MaxMemberNumber()
   {
   
   	$start_date = date('Y').'-01-01';
   	$end_date   = date('Y').'-12-31';

   	$last_id = $this->db->select_max('id','max_id')
                        ->where('start_date >=', $start_date)
   	                    ->where('start_date <=', $end_date)
   	                    ->get($this->_table)
   	                    ->result();

   	 return $last_id[0]->max_id;
   }   

  //check if a member exists
   public function exists($id)
   {
     # code...
    $query = $this->db->where('id',$id)
                      ->get($this->_table);
                         
    return ($query->num_rows()==1);
   }

  //Get total member loan
   public function LoanSum($memberid)
   {
     $this->db->select_sum('total_loan_interest');
     $this->db->from($this->_loan_table);
     $this->db->where('member_id',$memberid);
     $dataset=$this->db->get()->result();

     return  ($dataset[0]->total_loan_interest!=null)?$dataset[0]->total_loan_interest:0;
   }

   

  //get total paid sum
   public function LoanPaymentSum($memberid)
   {
     $this->db->select_sum('paid_amount');
     $this->db->from($this->_loan_payments_table);
     $this->db->where('member_id',$memberid);
     $dataset=$this->db->get()->result();

     return  ($dataset[0]->paid_amount)?$dataset[0]->paid_amount:0;
   }


   //get member oustanding amount
   public function OutStandingAmount($memberid)
   {
      $LoanSum = $this->LoanSum($memberid);

      $LoanPaymentSum = $this->LoanPaymentSum($memberid);

      return $LoanSum-$LoanPaymentSum;
   }

  //change member status
  public function ChangeState($memberid=null,$status='active')
  {
   if ($memberid==null) {
     return false;
   }

   return $this->db->update($this->_table, array('status' =>$status),array('id' => $memberid)); 
  }


}
